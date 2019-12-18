<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockedContact extends Model
{
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
