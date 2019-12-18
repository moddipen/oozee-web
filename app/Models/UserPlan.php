<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function planWithFeatures()
    {
        $plan = Plan::find($this->attributes['plan_id']);
        $plan->defaultFeatures = PlanFeature::select('id','title')->where('for', $plan->type)->get();
        $plan->extraFeatures = PlanFeature::select('id','title')->whereIn('id', explode(',', $plan->features))->get();
        return $plan;
    }
}
