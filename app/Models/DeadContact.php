<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeadContact extends Model
{
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
