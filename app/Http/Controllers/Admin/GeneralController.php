<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\This;

class GeneralController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function dashboard()
    {
        $data = $this->model->getStatistic();
//        echo '<pre>'; print_r($data); exit;
        return view('admin.home', compact('data'));
    }

    public function getUsersByLocation(Request $request)
    {
        $users = $this->model->getLocationUsers($request->latitude, $request->longitude, 40);
        $data = [];
        $count = 0;
        foreach($users as $user) {
            $count++;
            $data[] = [
                "type" => "Feature",
                "geometry" => [
                    "type" => "Point",
                  "coordinates" => [
                      $user->login_long,
                      $user->login_lat
                    ]
                ]
            ];
        }
        return ['users' => $data, 'count' => $count];
    }
}
