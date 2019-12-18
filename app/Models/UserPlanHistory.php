<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPlanHistory extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
