<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function number()
    {
        return $this->belongsTo(PhoneNumber::class, 'phone_number_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        return $this->hasOne(UserLocation::class, 'user_id');
    }

    /**
     * @param $query
     * @param Carbon $from
     * @param Carbon $to
     */
    public function scopeBetween($query, Carbon $from, Carbon $to)
    {
        $query->whereBetween('users.created_at', [$from, $to]);
    }

    /**
     * @param $userData
     * @return mixed
     *
     * Login or register user
     */
    public function loginOrRegister($userData)
    {
        DB::statement(
            DB::raw('CALL user_register_or_login(' .$userData->phone_number . ',' . $userData->country_id . ',' ."'". $userData->first_name ."'". ',' ."'". $userData->last_name ."'". ',' ."'". $userData->email ."'".  ',' ."'". $userData->type ."'".',' ."'". $userData->gender ."'".',' ."'". $userData->device_type ."'".',' ."'". $userData->device_token ."'".',' ."'". $userData->device_imei ."'".',' ."'". $userData->birthdate ."'".',' ."'". $userData->photo ."'".', @Out_UserID)')
        );
        $result = DB::select(
            'SELECT @Out_UserID as user_id'
        )[0]->user_id;
        return $result;
    }

    /**
     * @param $id
     * @return mixed
     *
     * Get user profile by id
     */
    public function getProfileById($id)
    {
        return $this->hydrate(
            DB::select(
                'call get_user_by_id(' . $id . ')'
            )
        )->first();
    }

    /**
     * @param $userData
     * @return mixed
     */
    public function searchContact($userData)
    {
        DB::statement(
            DB::raw('CALL search_contact_new('.$userData['user_id'].',' .$userData['phone'] . ',' . $userData['cid'] .', @firstName, @lastName, @OutEmail, @address, @photo, @gender, @user_id, @OutSpam, @ServiceProvider, @Subscribed, @Website, @Business)')
        );
        $result = DB::select(
            'SELECT @firstName as first_name, @lastName as last_name, @OutEmail as email, @address as address, @photo as photo, @gender as gender, @user_id as user_id, @OutSpam as spam, @Subscribed as subscribed, @Website as website, @Business as business, @ServiceProvider as service_provider'
        )[0];
        if ($result->user_id != 0) {
            $result->locations = $this->hydrate(
                DB::select(
                    'call get_user_locations('.$result->user_id.')'
                )
            )->toArray();

            DB::statement(
                DB::raw('CALL check_gender_show('.$result->user_id.', @outShow)')
            );
            $checkGenderEnable = DB::select(
                'SELECT @outShow as shows'
            )[0];
            if ($checkGenderEnable->shows != 1) {
                $result->gender = '';
            }

        } else {
            $result->locations = [];
        }
        $result->tags = $this->hydrate(
            DB::select(
                'call get_number_tags(' .$userData['phone'] . ',' . $userData['cid'] .',' . $userData['user_id'] .')'
            )
        )->toArray();
        return $result;
    }

    /**
     * @param $userData
     * @return mixed
     */
    public function getContactDetails($userData)
    {
        DB::statement(
            DB::raw('CALL get_number_details_new(' .$userData['phone_number'] . ',' . $userData['country_id'] .',' . $userData['user_id'] .', @firstName, @lastName, @OutEmail, @OutUserID, @OutNumberID, @OutContactID, @address, @ServiceProvider, @photo, @gender, @OutSpam, @OutBlock)')
        );
        $result = DB::select(
            'SELECT @firstName as first_name, @lastName as last_name, @OutEmail as email, @OutUserID as user_id, @OutNumberID as number_id, @OutContactID as contact_id, @address as address, @ServiceProvider as service_provider, @photo as photo, @OutSpam as spam, @OutBlock as isblock, @gender as gender'
        )[0];

        if ($result->user_id != 0) {
            $result->mutual_list = [];
            $result->mutual_list = $this->hydrate(
                DB::select(
                    'call get_mutual_contacts('.$userData['user_id'].', '.$result->user_id.')'
                )
            )->toArray();

            DB::statement(
                DB::raw('CALL check_gender_show('.$result->user_id.', @outShow)')
            );
            $checkGenderEnable = DB::select(
                'SELECT @outShow as shows'
            )[0];
            if ($checkGenderEnable->shows != 1) {
                $result->gender = '';
            }
        } else {
            $result->mutual_list = [];
        }

        if ($result->user_id != 0) {
            $mutual = $this->hydrate(
                DB::select(
                    'call get_mutual_contacts_count('.$userData['user_id'].', '.$result->user_id.')'
                )
            )->toArray();
            $result->mutual = $mutual[0]['mutual'];
        } else {
            $result->mutual = 0;
        }

        if ($result->user_id != 0) {
            $result->locations = $this->hydrate(
                DB::select(
                    'call get_user_locations('.$result->user_id.')'
                )
            )->toArray();
        } else {
            $result->locations = [];
        }
        $result->tags = $this->hydrate(
            DB::select(
                'call get_number_tags(' .$userData['phone_number'] . ',' . $userData['country_id'] .',' . $userData['user_id'] .')'
            )
        )->toArray();
        return $result;
    }

    /**
     * @param $userData
     * @return mixed
     */
    public function getWebContactDetails($userData)
    {
        DB::statement(
            DB::raw('CALL get_number_details_new(' .$userData['phone_number'] . ',' . $userData['country_id'] .',' . $userData['user_id'] .', @firstName, @lastName, @OutEmail, @OutUserID, @OutNumberID, @OutContactID, @address, @ServiceProvider, @photo, @gender, @OutSpam, @OutBlock)')
        );
        $result = DB::select(
            'SELECT @firstName as first_name, @lastName as last_name, @OutEmail as email, @OutUserID as user_id, @OutNumberID as number_id, @OutContactID as contact_id, @address as address, @ServiceProvider as service_provider, @photo as photo, @OutSpam as spam, @OutBlock as isblock, @gender as gender'
        )[0];
        return $result;
    }

    /**
     * @param $data
     * @return bool
     */
    public function syncContact($data)
    {
        $firstName = $this->removeQuote($data->first_name);
        $lastName = $this->removeQuote($data->last_name);
        $location = $this->removeQuote($data->location);
        return DB::statement(
            DB::raw('CALL sync_contacts(' .$data->phone_number . ',' . $data->country_id. ',' . $data->user_id . ',"'. $firstName .'","'. $lastName .'","'. $data->email .'","'. $data->photo .'","'. $data->gender .'","'. $data->service_provider .'","'. $data->state_circle .'","'. $location .'","'. $data->active_date .'")')
        );
    }

    /**
     * @param $string
     * @return mixed
     */
    public function removeQuote($string)
    {
        $string = str_replace('"', '', $string);
        return str_replace("'", '', $string);
    }

    /**
     * @param $lat
     * @param $long
     * @return mixed
     */
    public function getLocationUsers($lat, $long, $miles)
    {
        return $this->hydrate(
            DB::select(
                'call get_location_users('."'". $lat ."'". ',' ."'". $long ."'".',' .$miles.')'
            )
        );
    }

    /**
     * @return mixed
     */
    public function getStatistic()
    {
        DB::statement(
            DB::raw('CALL get_statistics(@OutFreeUsers, @OutPaidUsers, @OutAndroidUsers, @OutIOSUsers)')
        );
        $result = DB::select(
            'SELECT @OutFreeUsers as free, @OutPaidUsers as paid, @OutAndroidUsers as android, @OutIOSUsers as ios'
        )[0];
        return $result;
    }

    /**
     * @return mixed
     */
    public function getContacts()
    {
        return $this->hydrate(
            DB::select(
                'call get_contact_lists()'
            )
        );
    }

    /**
     * @return mixed
     */
    public function getTempContacts()
    {
        return $this->hydrate(
            DB::select(
                'call get_temp_contact_lists(5000)'
            )
        );
    }

    /**
     * @param $data
     * @return bool
     */
    public function statusUpdate($data)
    {
        DB::statement(
            DB::raw('call user_status_update('.$data->user_id. ',' ."'". $data->status."'".')')
        );
        return true;
    }

    /**
     * @param $lat
     * @param $long
     * @return mixed
     */
    public function getContactUsers($uid)
    {
        return $this->hydrate(
            DB::select(
                'call get_contact_users('.$uid.')'
            )
        );
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function getContactUserWithStatus($uid)
    {
        $array = [];
        $users =  $this->hydrate(
            DB::select(
                'call get_contact_users_with_status_new('.$uid.')'
            )
        );
        foreach ($users as $user) {
            $gender = $user->gender;
            if ($user->plan_id == 2) {
                DB::statement(
                    DB::raw('CALL check_gender_show('.$user->id.', @outShow)')
                );
                $checkGenderEnable = DB::select(
                    'SELECT @outShow as shows'
                )[0];
                if ($checkGenderEnable->shows != 1) {
                    $gender = '';
                }
            }

            $array[] = [
                "number" => $user->number,
                "status" => $user->status,
                "photo" => $user->photo,
                "gender" => $gender,
            ];
        }
        return $array;
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function getUserDetailsById($uid)
    {
        return $this->hydrate(
            DB::select(
                'call get_user_details_by_id('.$uid.')'
            )
        )->first();
    }

    /**
     * @param $userData
     * @return mixed
     */
    public function getUserDetailsByNumber($userData)
    {
        DB::statement(
            DB::raw('CALL get_users_details_by_number('.$userData['phone'] . ',' . $userData['cid'] .', @firstName, @lastName, @OutEmail, @user_id, @OutDOB, @gender, @photo, @nickName, @about, @address, @website, @industry, @companyName, @companyAddress)')
        );
        $result = DB::select(
            'SELECT @firstName as first_name, @lastName as last_name, @OutEmail as email, @gender as gender, @user_id as user_id, @gender as gender, @OutDOB as dob, @photo as photo, @nickName as nick_name, @about as about, @address as address, @website as website, @industry as industry, @companyName as company_name, @companyAddress as company_address'
        )[0];
        return $result;
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function getChatUsers($uid)
    {
        return $this->hydrate(
            DB::select(
                'call get_contact_users_for_chat_new('.$uid.')'
            )
        );
    }

    /**
     * @return mixed
     */
    public function removeTempContacts()
    {
        $days = 3;
        return $this->hydrate(
            DB::statement(
                DB::raw(
                    'DELETE FROM temp_new_contacts WHERE created_at < NOW() - INTERVAL '.$days.' DAY'
                )
            )
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function removeSelectedTempContacts($id)
    {
        return DB::statement(
            DB::raw(
                'DELETE FROM temp_contacts WHERE id <='.$id
            )
        );
    }

    /**
     * @return mixed
     */
    public function getUserTempContacts()
    {
        return $this->hydrate(
            DB::select(
                'call get_user_temp_contact_lists(5000)'
            )
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function removeSelectedUserTempContacts($id)
    {
        return DB::statement(
            DB::raw(
                'DELETE FROM temp_new_contacts WHERE id <='.$id
            )
        );
    }

    /**
     * @return mixed
     */
    public function getSheetTempContacts()
    {
        return $this->hydrate(
            DB::select(
                'call get_temp_contact_lists(5000)'
            )
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function removeSelectedSheetTempContacts($id)
    {
        return DB::statement(
            DB::raw(
                'DELETE FROM temp_contacts WHERE id <='.$id
            )
        );
    }

    /**
     * @param $uid
     * @param $phone
     * @return bool
     */
    public function removeTagsFromNumberByUser($uid, $phone)
    {
        return DB::statement(
            DB::raw(
                'DELETE FROM tag_to_numbers WHERE user_id='.$uid.' AND phone_number='.$phone
            )
        );
    }

    /**
     * @param $data
     * @return bool
     */
    public function addTagToNumberByUser($data)
    {
        return DB::statement(
            DB::raw('call add_tag_to_number('.$data['number']. ', '. $data['cid'].', '. $data['user_id'].', '. $data['tag_id'].')')
        );
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getNumberTagsByUser($data)
    {
        return $this->hydrate(
            DB::select(
                'call get_number_tags(' .$data['number'] . ',' . $data['cid'] .',' . $data['user_id'] .')'
            )
        )->toArray();
    }
}
