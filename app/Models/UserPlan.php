<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    protected $fillable = ['renew_date'];
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
        if ($plan) {
            $plan->renew_date = '';
            if ($this->attributes['renew_date'] != null) {
                $plan->renew_date = Carbon::parse($this->attributes['renew_date'])->format('d F Y');
            }
            $plan->order_id = $this->attributes['order_id'] ?? '';
            $plan->defaultFeatures = PlanFeature::select('id','title')->where('for', $plan->type)->get();
            $plan->extraFeatures = PlanFeature::select('id','title')->whereIn('id', explode(',', $plan->features))->get();
        }
        return $plan;
    }
}
