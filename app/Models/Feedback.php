<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ["user_id", "title", "description"];

    // public function creator()
    // {
    //     return $this->belongsTo(UserProfile::class)->withTrashed();
    // }
}
