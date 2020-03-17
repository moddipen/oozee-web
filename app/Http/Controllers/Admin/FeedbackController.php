<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.feedback.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     * Fetch all admin users for datatable
     */
    public function getFeedback()
    {
        //$feedback = Feedback::with('creator')->get();

        $feedback = Feedback::select('feedback.id', 'feedback.created_at', 'feedback.title', 'feedback.description', 'user_profiles.first_name', 'user_profiles.last_name','users.device_type','users.device_imei','phone_numbers.number')
        ->join('user_profiles', 'user_profiles.user_id','=','feedback.user_id')
        ->join('users', 'users.id','=','feedback.user_id')
        ->join('phone_numbers', 'phone_numbers.id','=','users.phone_number_id')
        ;        
       
        return DataTables::of($feedback)
        ->addColumn('creator', function ($feedback) {
            return $feedback->first_name.' '.$feedback->last_name;
        })
        ->addColumn('id', function ($feedback) {
            return $feedback->id;
        })
        ->addColumn('title', function ($feedback) {
            return $feedback->title;
        })
        ->addColumn('description', function ($feedback) {
            return $feedback->description;
        })
        ->addColumn('created', function ($feedback) {
            return $feedback->created_at;
        })   
        ->addColumn('device_type', function ($feedback) {
            return $feedback->device_type;
        })   
        ->addColumn('device_imei', function ($feedback) {
            return $feedback->device_imei;
        })
        ->addColumn('number', function ($feedback) {
            return $feedback->number;
        })

        ->filterColumn('creator', function($query, $keyword) {
            $sql = "CONCAT(user_profiles.first_name,' ',user_profiles.last_name)  like ?";
            $query->whereRaw($sql, ["%{$keyword}%"]);
        })
        ->filterColumn('title', function($query, $keyword) {
            $sql = "feedback.title  like ?";
            $query->whereRaw($sql, ["%{$keyword}%"]);
        })
        ->filterColumn('description', function($query, $keyword) {
            $sql = "feedback.description  like ?";
            $query->whereRaw($sql, ["%{$keyword}%"]);
        })
        ->filterColumn('created', function($query, $keyword) {
            $sql = "feedback.created_at  like ?";
            $query->whereRaw($sql, ["%{$keyword}%"]);
        })
        ->filterColumn('device_type', function($query, $keyword) {
            $sql = "feedback.device_type  like ?";
            $query->whereRaw($sql, ["%{$keyword}%"]);
        })
        ->filterColumn('device_imei', function($query, $keyword) {
            $sql = "feedback.device_imei  like ?";
            $query->whereRaw($sql, ["%{$keyword}%"]);
        })  
        ->filterColumn('number', function($query, $keyword) {
            $sql = "feedback.number  like ?";
            $query->whereRaw($sql, ["%{$keyword}%"]);
        })       
        ->make(true);
    

    }

    
   
}
