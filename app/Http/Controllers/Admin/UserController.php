<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AppUserAction;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $auth;
    protected $model;

    /**
     * AdminUserController constructor.
     */
    public function __construct()
    {
        $this->auth = Auth::guard('admin')->user();
        $this->model = new User();
    }

    /**
     * @return mixed
     * @throws \Exception
     * Fetch all app users for datatable
     */
    public function getUsers()
    {
        $arrStart = explode("/", Input::get('start_date'));
        $arrEnd = explode("/", Input::get('end_date'));
        $start = Carbon::create($arrStart[2], $arrStart[0], $arrStart[1], 0, 0, 0);
        $end = Carbon::create($arrEnd[2], $arrEnd[0], $arrEnd[1], 23, 59, 59);
        $users = User::select('users.id', 'users.created_at', 'users.status', 'users.phone_number_id', 'user_profiles.first_name', 'user_profiles.last_name', 'user_profiles.email', 'phone_numbers.number', 'phone_numbers.id as number_id')
            ->join('user_profiles', 'user_profiles.user_id','=','users.id')
            ->join('phone_numbers', 'phone_numbers.id','=','users.phone_number_id')->between($start, $end);
        
        return DataTables::of($users)
            ->addColumn('name', function ($user) {
                return $user->first_name.' '.$user->last_name;
            })
            ->addColumn('email', function ($user) {
                return $user->profile->email;
            })
            ->addColumn('number', function ($user) {
                return $user->number;
            })
            ->addColumn('status', function ($user) {
                if (Auth::guard('admin')->user()->hasAnyPermission(['user-suspend'])) {
                    if ($user->status) {
                        $html = '<input type="checkbox" checked value="1" class="my-checkbox" data-on-color="success"
                               data-on-text="Active" data-off-text="Suspended" data-off-color="danger" onchange="confirmAction('.$user->id.')"></form>';
                    } else {
                        $html = '<input type="checkbox" value="1" class="my-checkbox" data-on-color="success"
                               data-on-text="Active" data-off-text="Suspended" data-off-color="danger" onchange="confirmAction('.$user->id.')"></form>';
                    }
                } else {
                    if ($user->status) {
                        $html = '<span class="badge badge-success">Active</span>';
                    } else {
                        $html = '<span class="badge badge-danger">Suspended</span>';
                    }
                }
                $html .= '<script>$(".my-checkbox").bootstrapSwitch();</script>';
                return $html;
            })
            ->addColumn('action', function ($user) {
                $html = "";

                if (Auth::guard('admin')->user()->hasAnyPermission(['user-details'])) {
                    $html .= '<form class="form-inline" id="form'.$user->id.'" action="'.route('admin.users.destroy', $user->id).'"  method="post">
                    <a href="#" onclick="showDetails('.$user->id.')" class = "btn btn-info" ><i class="fa fa-eye"></i></a>';
                } else {
                $html .= '<form class="form-inline" id="form'.$user->id.'" action="'.route('admin.users.destroy', $user->id).'"  method="post">';
                }
                if (Auth::guard('admin')->user()->hasAnyPermission(['user-edit'])) {
                    $html .= '<a href="'.route('admin.users.edit',$this->encrypt($user->id)).'" class = "btn btn-primary" ><i class="fa fa-edit"></i></a>';
                } else {
                    $html .= '';
                }

                if (Auth::guard('admin')->user()->hasAnyPermission(['user-delete'])) {
                    $html .= ''.method_field("delete").csrf_field().'<button class="btn btn-danger" onclick="confirmDelete('.$user->id.')" type="button"><i class = "fa fa-trash "></i></button></form><script></script>';
                } else {
                    $html .= '</form>';
                }

                return $html;
            })
            ->filterColumn('name', function($query, $keyword) {
                $sql = "CONCAT(user_profiles.first_name,' ',user_profiles.last_name)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('email', function($query, $keyword) {
                $sql = "user_profiles.email  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('number', function($query, $keyword) {
                $sql = "phone_numbers.number  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('status', function($query, $keyword) {
                $sql = '';
                if (stripos('ACTIVE', strtoupper($keyword)) !== FALSE) {
                    $sql = "users.status = 1";
                } else if (stripos('SUSPENDED', strtoupper($keyword)) !== FALSE) {
                    $sql = "users.status <> 1";
                }
                if ($sql != '') {
                    $query->whereRaw($sql);
                }
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|unique:users',
            'gender' => 'required',
            'number' => 'required|unique:users',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->number = $request->number;
        $user->about = $request->about ?? '';
        $user->address = $request->address ?? '';
        $user->website = $request->website ?? '';
        $user->industry = $request->industry ?? '';
        $user->company_name = $request->company_name ?? '';
        $user->website = $request->website ?? '';
        $user->password = bcrypt($request->password);
        if ($user->save()) {
            Session::put('success', 'User created successfully !');
        } else {
            Session::put('error', 'Unable to create user !');
        }
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = $this->decrypt($id);
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = $this->decrypt($id);
        $user = User::with('profile', 'number')->find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'nick_name' => 'max:30',
            'email' => 'required|email',
            'gender' => 'required',
            'about' => 'max:50',
            'address' => 'max:50',
            'company_name' => 'max:30',
            'industry' => 'max:30',
            'company_address' => 'max:50'
        ]);

        $user = UserProfile::where('user_id', $id)->first();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->nick_name = $request->nick_name ?? '';
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->about = $request->about ?? '';
        $user->address = $request->address ?? '';
        $user->website = $request->website ?? '';
        $user->industry = $request->industry ?? '';
        $user->company_name = $request->company_name ?? '';
        $user->company_address = $request->company_address ?? '';
        $user->website = $request->website ?? '';
        if ($user->save()) {
            Session::put('success', 'User updated successfully !');
        } else {
            Session::put('error', 'Unable to update user !');
        }
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::with('profile')->find($id);
        $email = $user->profile->email;
        if (!$user) {
            Session::put('success', 'User deleted successfully !');
            return redirect('admin/users');
        }
        if ($user->delete()) {
            $data = [
                'subject' => 'Account deleted',
                'message' => 'Your account has been deleted.'
            ];
            $this->sendMail($email, $data);
            Session::put('success', 'User deleted successfully !');
        } else {
            Session::put('error', 'Unable to delete user !');
        }
        return redirect('admin/users');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function suspend(Request $request)
    {
        $user = User::with('profile')->find($request->id);
        $status = $user->status;
        $user->status = $user->status ? 0 : 1;
        if ($user->save()) {
            if (!$status) {
                $data = [
                    'subject' => 'Account activated',
                    'message' => 'Your account is now activated.'
                ];
                $this->sendMail($user->profile->email, $data);
                return ['success' => 'User activated !'];
            } else {
                $data = [
                    'subject' => 'Account suspended',
                    'message' => 'Your account is temporary suspended.'
                ];
                $this->sendMail($user->profile->email, $data);
                return ['success' => 'User suspended!'];
            }
        } else {
            return ['error' => 'Failed your action !'];
        }
    }

    /**
     * @param $email
     * @param $data
     * @return mixed
     */
    public function sendMail($email, $data)
    {
        return Mail::to($email)->send(new AppUserAction($data));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getUserDetails(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ]);
        $userDetails = $this->model->getUserDetailsById($request->user_id);

        $html = '<div class="form-group">
                        <label>First Name: </label>
                        '.$userDetails->first_name.'
                    </div>
                    <div class="form-group">
                        <label for="">Last Name: </label>
                        '.$userDetails->last_name.'
                    </div>';
        $html .= $userDetails->nick_name ? '<div class="form-group">
                        <label for="">Nick Name: </label>
                        '.$userDetails->nick_name.'
                    </div>' : '';
        $html .= $userDetails->about ? '<div class="form-group">
                        <label for="">About: </label>
                        '.$userDetails->about.'
                    </div>' : '';
        $html .= $userDetails->gender ? '<div class="form-group">
                        <label for="">Gender: </label>
                        '.$userDetails->gender.'
                    </div>' : '';
        $html .= $userDetails->email ? '<div class="form-group">
                        <label for="">Email: </label>
                        '.$userDetails->email.'
                    </div>' : '';
        $html .= $userDetails->number ? '<div class="form-group">
                        <label for="">Mobile number: </label>
                        '.$userDetails->number.'
                    </div>' : '';
        $html .= $userDetails->address ? '<div class="form-group">
                        <label for="">Address: </label>
                        '.$userDetails->address.'
                    </div>' : '';
        $html .= $userDetails->website ? '<div class="form-group">
                        <label for="">Website: </label>
                        '.$userDetails->website.'
                    </div>' : '';
        $html .= $userDetails->company_name ? '<div class="form-group">
                        <label for="">Company Name: </label>
                        '.$userDetails->company_name.'
                    </div>' : '';
        $html .= $userDetails->company_address ? '<div class="form-group">
                        <label for="">Company Address: </label>
                        '.$userDetails->company_address.'
                    </div>' : '';
        $html .= $userDetails->device_imei ? '<div class="form-group">
                        <label for="">Device IMEI: </label>
                        '.$userDetails->device_imei.'
                    </div>' : '';
        $html .= $userDetails->contacts ? '<div class="form-group">
                        <label for="">Total Contacts: </label>
                        '.$userDetails->contacts.'
                    </div>' : '';
        $html .= $userDetails->created_at ? '<div class="form-group">
                        <label for="">Registered On: </label>
                        '.$userDetails->created_at.'
                    </div>' : '';
        return ['html' => $html];
    }
}
