<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\LoginHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AdminUserController extends Controller
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $model;

    /**
     * AdminUserController constructor.
     */
    public function __construct()
    {
        $this->model = new AdminUser();
    }

    /**
     * @return mixed
     * @throws \Exception
     * Fetch all admin users for datatable
     */
    public function getAdminUsers()
    {
        $authId = Auth::guard('admin')->id();
        $adminUsers = $this->model->getAdminUsersExceptCurrent($authId);

        return DataTables::of($adminUsers)
            ->addColumn('roles', function ($user) {
                return implode(',', $user->getRoleNames()->toArray());
            })
            ->addColumn('last_login', function ($user) {
                $history = LoginHistory::where('admin_user_id', $user->id)->first();
                if ($history) {
                    return '(IP : '.$history->ip_address.') '. $history->updated_at;
                } else {
                    return '-';
                }
            })
            ->addColumn('action', function ($user) {
                $html = '<form class="form-inline" id="form'.$user->id.'" action="'.route('admin.admin-users.destroy', $user->id).'"  method="post">';

//                if (Auth::guard('admin')->user()->hasAnyPermission(['admin-user-show'])) {
//                    $html .= '<form class="form-inline" id="form'.$user->id.'" action="'.route('admin.admin-users.destroy', $user->id).'"  method="post">
//                    <a href="'.route('admin.admin-users.show',$this->encrypt($user->id)).'" class = "btn btn-info" ><i class="fa fa-eye"></i></a>';
//                } else {
//                    $html .= '<form class="form-inline" id="form'.$user->id.'" action="'.route('admin.admin-users.destroy', $user->id).'"  method="post">';
//                }
                if (Auth::guard('admin')->user()->hasAnyPermission(['admin-user-edit'])) {
                    $html .= '<a href="'.route('admin.admin-users.edit',$this->encrypt($user->id)).'" class = "btn btn-primary" ><i class="fa fa-edit"></i></a>';
                } else {
                    $html .= '';
                }

                if (Auth::guard('admin')->user()->hasAnyPermission(['admin-user-delete'])) {
                    $html .= ''.method_field("delete").csrf_field().'<button class="btn btn-danger" onclick="confirmDelete('.$user->id.')" type="button"><i class = "fa fa-trash "></i></button></form><script></script>';
                } else {
                    $html .= '</form>';
                }

                return $html;
            })
            ->removeColumn('password')
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin-users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->model->getRoles();
        return view('admin.admin-users.create', compact('roles'));
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
            'email' => 'required|unique:admin_users',
            'username' => 'required|unique:admin_users|max:20|min:6',
            'roles' => 'present|array',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
        ]);

        $adminUser = new AdminUser();
        $adminUser->name = $request->name;
        $adminUser->email = $request->email;
        $adminUser->username = $request->username;
        $adminUser->password = bcrypt($request->password);
        if ($adminUser->save()) {
            foreach ($request->roles as $role) {
                $role = Role::findById($role);
                $adminUser->assignRole($role);
            }
            Session::put('success', 'Admin user created successfully !');
        } else {
            Session::put('error', 'Unable to create admin user !');
        }
        return redirect('admin/admin-users');
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
        $adminUser = $this->model->hydrate(
            DB::select(
                'call select_admin_user_by_id('.$id.')'
            )
        )->first();
        return view('admin.admin-users.show', compact('adminUser'));
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

        $adminUser = $this->model->getAdminUserById($id);
        $roles = Role::all();
        return view('admin.admin-users.edit', compact('adminUser', 'roles'));
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
            'name' => 'required|max:30',
            'email' => [
                'required', Rule::unique('admin_users')->ignore($id),],
            'username' => [
                'required', Rule::unique('admin_users')->ignore($id), 'max:20', 'min:6'],
            'roles' => 'present|array',
        ]);

        $adminUser = AdminUser::find($id);
        $adminUser->name = $request->name;
        $adminUser->email = $request->email;
        $adminUser->username = $request->username;

        if ($adminUser->save()) {
            $roles = Role::all();
            foreach ($roles as $val) {
                $adminUser->removeRole($val);
            }
            foreach ($request->roles as $role) {
                $role = Role::findById($role);
                $adminUser->assignRole($role);
            }
            Session::put('success', 'Admin user updated successfully !');
        } else {
            Session::put('error', 'Unable to update admin user !');
        }
        return redirect('admin/admin-users');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
        ]);

        $adminUser = AdminUser::find($id);
        $adminUser->password = bcrypt($request->password);

        if ($adminUser->save()) {
            Session::put('success', 'Password changed successfully !');
        } else {
            Session::put('error', 'Unable to change password !');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adminUser = AdminUser::find($id);
        if (!$adminUser) {
            Session::put('success', 'Admin user deleted successfully !');
            return redirect('admin/admin-users');
        }
        if ($adminUser->delete()) {
            Session::put('success', 'Admin user deleted successfully !');
        } else {
            Session::put('error', 'Unable to delete admin user !');
        }
        return redirect('admin/admin-users');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $adminUser = Auth::guard('admin')->user();
        return view('admin.profile', compact('adminUser'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $id = Auth::guard('admin')->user()->id;
        $request->validate([
            'name' => 'required|max:30',
            'username' => [
                'required', Rule::unique('admin_users')->ignore($id), 'max:20', 'min:6']
        ]);

        $adminUser = AdminUser::find($id);
        $adminUser->name = $request->name;
        $adminUser->username = $request->username;

        if ($adminUser->save()) {
            Session::put('success', 'Profile updated successfully !');
        } else {
            Session::put('error', 'Unable to update profile !');
        }
        return redirect('admin/home');
    }
}
