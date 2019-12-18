<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->hydrate(
            DB::select(
                'call get_notification_users()'
            )
        );
    }

    /**
     * @return mixed
     */
    public function getFreeUsers()
    {
        return $this->hydrate(
            DB::select(
                'call get_notification_free_users()'
            )
        );
    }

    /**
     * @return mixed
     */
    public function getPaidUsers()
    {
        return $this->hydrate(
            DB::select(
                'call get_notification_paid_users()'
            )
        );
    }

    /**
     * @param $lat
     * @param $long
     * @return mixed
     */
    public function storeNotifications($uid, $data)
    {
        $title = $this->removeQuote($data->title);
        $body = $this->removeQuote($data->body);
        DB::statement(
            DB::raw('call store_notifications('.$uid. ',' ."'". $title."'". ',' ."'". $body ."'".',' ."'". $data->type ."'".')')
        );
        return true;
    }

    /**
     * @param $string
     * @return mixed
     */
    public function removeQuote($string)
    {
        $string = str_replace('"', '', $string);
        return str_replace("'", '', $string);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getNotifications($id)
    {
        return $this->hydrate(
            DB::select(
                'call get_notifications('.$id.')'
            )
        );
    }
}
