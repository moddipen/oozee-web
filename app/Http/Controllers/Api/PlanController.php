<?php

namespace App\Http\Controllers\Api;

use App\Models\Plan;
use App\Models\PlanFeature;
use App\Models\UserPlan;
use App\Models\UserPlanHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::all();
        foreach ($plans as &$plan) {
            $plan->defaultFeatures = PlanFeature::select('id','title')->where('for', $plan->type)->get();
            $plan->extraFeatures = PlanFeature::select('id','title')->whereIn('id', explode(',', $plan->features))->get();
        }
        return $this->makeResponse('', ['plans' => $plans], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = Plan::find($id);
        $plan->defaultFeatures = PlanFeature::select('id','title')->where('for', $plan->type)->get();
        $plan->extraFeatures = PlanFeature::select('id','title')->whereIn('id', explode(',', $plan->features))->get();
        return $this->makeResponse('', ['plan' => $plan], 200);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateUserPlan(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'plan_id' => 'required'
        ]);


        $userPlan = UserPlan::where(['user_id' => $request->user_id])->first();
        if (!$userPlan) {
            $userPlan = new UserPlan();
            $userPlan->user_id = $request->user_id;
        }
        $userPlan->plan_id = $request->plan_id;
        $userPlan->order_id = $request->order_id ?? '';
        $userPlan->renew_date = $request->duration != 0 ? Carbon::now()->addMonths($request->duration)->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
        if ($userPlan->save()) {
            $history = new UserPlanHistory();
            $history->user_id = $request->user_id;
            $history->plan_id = $request->plan_id;
            $userPlan->order_id = $request->order_id ?? '';
            $userPlan->renew_date = $request->duration != 0 ? Carbon::now()->addMonths($request->duration)->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d H:i:s');
            $history->save();

            $plan = Plan::find($request->plan_id);
            $plan->defaultFeatures = PlanFeature::select('id','title')->where('for', $plan->type)->get();
            $plan->extraFeatures = PlanFeature::select('id','title')->whereIn('id', explode(',', $plan->features))->get();
            return $this->makeResponse('User plan updated successfully.', ['plan' => $plan, 'renew_date' => $request->duration != 0 ? Carbon::parse($userPlan->renew_date)->format('d F Y') : ''], 200);
        } else {
            return $this->makeError('Unable to update plan.', [], 410);
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function userPlanHistory(Request $request)
    {
        $histories = UserPlanHistory::with('plan')->where('user_id', $request->user_id)->get();
        return $this->makeResponse('User plan updated successfully.', ['histories' => $histories], 200);
    }
}
