<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phone()
    {
        return $this->belongsTo(PhoneNumber::class, 'phone_number_id');
    }
}
