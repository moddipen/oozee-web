<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    /**
     * @return mixed
     */
    public function removeChatMessages()
    {
        $days = 30;
        return DB::statement(
            DB::raw(
                'DELETE FROM messages WHERE created_at < NOW() - INTERVAL '.$days.' DAY'
            )
        );
    }
}
