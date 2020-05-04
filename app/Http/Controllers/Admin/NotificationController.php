<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Kawankoding\Fcm\Fcm;

class NotificationController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Notification();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $types = [
            'new',
            'subscription',
            'call',
            'sms'
        ];

        return view('admin.notifications.create', compact('types'));
    }

    /**
     * @param Request $request
     */
    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|max:15',
            'body' => 'required|max:100',
            'type' => 'required',
            'to' => 'required'
        ]);

        if ($request->to == '1') {
            $users = $this->model->getUsers();
        } else if ($request->to == '2') {
            $users = $this->model->getPaidUsers();
        } else {
            $users = $this->model->getFreeUsers();
        }

        $tokens = [];
        foreach ($users as $user) {
            if (in_array($user->id, [49, 59, 89, 254])) {
                $tokens[] = $user->device_token;
                $this->model->storeNotifications($user->id, $request);
            }
        }

        $data = [
            'title' => $request->title,
            'body' => $request->body,
            'timestamp' => time(),
        ];

        $this->sendPushNotification($tokens, $request->title, $request->body, $data);

        Session::put('success', 'Notification sent successfully !');
        return redirect('/admin/notification-create');
    }
}
