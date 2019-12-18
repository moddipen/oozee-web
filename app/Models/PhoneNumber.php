<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
