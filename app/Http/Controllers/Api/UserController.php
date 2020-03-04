<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Models\User;
use App\Models\UserLocation;
use App\Models\UserPlan;
use App\Models\UserPlanHistory;
use App\Models\UserProfile;
use App\Traits\PassportToken;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    use PassportToken;
    protected $model;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * @param Request $request
     * @return array
     * Get auth user details
     */
    public function getAuthUserDetails(Request $request)
    {
        $user = $request->user();
        $user->profile = $request->user()->profile;
        $user->number = $request->user()->number;
        $user->location = $request->user()->location;
        $user->number->country = $request->user()->number->country;
        return $this->makeResponse('', ['user' => $user], 200);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required',
            'country_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'type' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'device_type' => 'required',
            'device_token' => 'required',
//            'device_imei' => 'required'
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $userId = $this->model->loginOrRegister($request);
        $user = User::find($userId);
        if (!$user) {
            return $this->makeError('Something went wrong.', [], 410);
        }
        if ($user->status) {
            $userLocation  = UserLocation::where('user_id', $user->id)->first();
            if (!$userLocation) {
                $userLocation = new UserLocation();
                $userLocation->user_id = $user->id;
            }
            $userLocation->login_lat = $latitude;
            $userLocation->login_long = $longitude;
            $userLocation->save();

            /**
             * Add subscription plan
             */
            $userPlan  = UserPlan::where('user_id', $user->id)->first();

            if (!$userPlan || $userPlan->plan_id == 0) {
                $userPlan = new UserPlan();
                $userPlan->user_id = $user->id;
                $userPlan->plan_id = 1;
                $userPlan->save();

                $userPlanHistory = new UserPlanHistory();
                $userPlanHistory->user_id = $user->id;
                $userPlanHistory->plan_id = 1;
                $userPlanHistory->save();
            }
            
            $response = $this->getBearerTokenByUser($user, 1, false);
            $data = ['access_token' => $response['access_token'], 'refresh_token' => $response['refresh_token'], 'user_id' => $userId, 'current_plan' => $userPlan->planWithFeatures()];
            $data['mutualEnable'] = true;
            $data['statusEnable'] = true;
            $data['genderEnable'] = true;
            $mutual = Setting::where('user_id', $user->id)->where('name', 'mutual')->first();
            if ($mutual) {
                $data['mutualEnable'] = $mutual->value == 0 ? false : true;
            }
            $status = Setting::where('user_id', $user->id)->where('name', 'status')->first();
            if ($status) {
                $data['statusEnable'] = $status->value == 0 ? false : true;
            }
            $gender = Setting::where('user_id', $user->id)->where('name', 'gender')->first();
            if ($gender) {
                $data['genderEnable'] = $gender->value == 0 ? false : true;
            }
            return $this->makeResponse('Authentication successfully.', $data, 200);
        } else {
            return $this->makeError('Your account is suspended.', [], 410);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function refreshToken(Request $request)
    {
        $this->validate($request, [
            'refresh_token' => 'required'
        ]);
        $response = $this->refreshAccessToken($request->refresh_token);
        return $response;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);
        $id = $request->user_id;
        $user = User::find($id);
        if ($user) {
            UserProfile::where('user_id', $id)->update($request->all());
            return $this->makeResponse('User details updated successfully.', [], 200);
        } else {
            return $this->makeError('User not found with this user id.', [], 410);
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateLocation(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        $id = $request->user_id;
        $userLocation  = UserLocation::where('user_id', $id)->first();
        if ($userLocation) {
            $userLocation->latitude = $request->latitude;
            $userLocation->longitude = $request->longitude;
            if ($userLocation->save()) {
                return $this->makeResponse('User location updated successfully.', [], 200);
            } else {
                return $this->makeError('Something went wrong.', [], 410);
            }
        } else {
            return $this->makeError('User location not found with this user id.', [], 410);
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateSettings(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required',
            'value' => 'required'
        ]);
        $id = $request->user_id;
        $setting = Setting::where(['user_id' => $id, 'name' => $request->name])->first();
        if (!$setting) {
            $setting = new Setting();
            $setting->user_id = $id;
            $setting->name = $request->name;
        }
        $setting->value = $request->value;
        if ($setting->save()) {
            $settings = Setting::where(['user_id' => $id])->pluck('value', 'name');
            return $this->makeResponse('Setting updated.', ['settings' => $settings], 200);
        } else {
            return $this->makeError('Unable to update settings.', [], 410);
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function getSettings(Request $request)
    {
        $settings = Setting::where(['user_id' => $request->user_id])->pluck('value', 'name');
        return $this->makeResponse('Setting updated.', ['settings' => $settings], 200);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'status' => 'required',
            'phone_number' => 'required'
        ]);

        $this->model->statusUpdate($request);

        $users = $this->model->getContactUsers($request->user_id);

        $tokens = [];

        foreach ($users as $user) {
            $tokens[] = $user->device_token;
        }

        $phone = $request->phone_number;
        if ($phone[0] == '+') {
            try {
                $phone = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $request->phone_number);
                $parseNumber = PhoneNumber::parse('+' . $phone);
                $number = $parseNumber->getNationalNumber();
            } catch (PhoneNumberException $e) {
                $number = $request->phone_number;
            }
        } else {
            $number = $request->phone_number;
        }

        $data = [
            'status' => $request->status,
            'phone_number' => $number
        ];

//        $this->sendPushNotification($tokens, $request->status, $request->status, $data);

        return $this->makeResponse('Status updated.', [], 200);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getContactUserStatus(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $request->status = strtotime(Carbon::now());
        $this->model->statusUpdate($request);

        $users = $this->model->getContactUserWithStatus($request->user_id);

        return $this->makeResponse('', ['contacts' => $users], 200);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getChatUsers(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);
        $users = $this->model->getChatUsers($request->user_id);

        return $this->makeResponse('', ['users' => $users], 200);
    }
}