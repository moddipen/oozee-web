<?php

namespace App\Models;

use Carbon\Carbon;
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

    /**
     * @return mixed
     */
    public function removeChatMedia()
    {
        $days = 30;
        $tempMedia = TempMedia::where('message', 1)->where('created_at', '<=', Carbon::now()->subDays($days)->toDateTimeString())->get();

        foreach ($tempMedia as $temp) {
            $temp->delete();
        }
    }
}
