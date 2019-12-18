<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
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
        //
    }

    /**
     * @return mixed
     * @throws \Exception
     * Fetch all admin users for datatable
     */
    public function getRoles()
    {
        $roles = Role::all();

        return Datatables::of($roles)
            ->addColumn('action', function ($role) {
                $html = "";

                if (Auth::guard('admin')->user()->hasAnyPermission(['role-edit'])) {
                    $html .= '<form id="form' . $role->id . '" action="' . route('admin.roles.destroy', $this->encrypt($role->id)) . '"  method="post" >
                        <a href="' . route('admin.roles.edit', $this->encrypt($role->id)) . '" class = "btn btn-primary" ><i class="fa fa-edit"></i></a>';
                } else {
                    $html .= '<form id="form' . $role->id . '" action="' . route('admin.roles.destroy', $this->encrypt($role->id)) . '"  method="post" >';
                }

                if (Auth::guard('admin')->user()->hasAnyPermission(['role-delete'])) {
                    $html .= '' . method_field("delete") . csrf_field() . '<button class="btn btn-danger" onclick="confirmDelete(' . $role->id . ')"  type="button"><i class="fa fa-trash"></i></button>
                    </form> 
                    <script> </script>';
                } else {
                    $html .= '</form>';
                }

                return $html;
            })->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get()
            ->groupBy('module')->map(function ($group) {
                return $group->map(function ($value) {
                    return $value;
                });
            });
        return view('admin.roles.create', compact('permissions'));
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
            'name' => 'required|max:30|unique:roles',
            'permissions' => 'present|array',
        ]);

        $role = new Role;
        $role->name = $request->name;
        if ($role->save()) {
            foreach ($request->permissions as $val) {
                $permission = Permission::findById($val);
                $role->givePermissionTo($permission);
            }
            Session::put('success', 'Role Added successfully !');
        } else {
            Session::put('error', 'Unable to add role !');
        }
        return redirect('admin/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $role = Role::findById($id);
        $permissions = Permission::get()
            ->groupBy('module')->map(function ($group) {
                return $group->map(function ($value) {
                    return $value;
                });
            });
        if ($role) {
            return view('admin.roles.edit',compact('role','permissions'));
        } else {
            return abort(404);
        }
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
            'name' => [
                'required', Rule::unique('roles')->ignore($id)],
            'permissions' => 'present|array'
        ]);

        $role = Role::find($id);
        $input = $request->except(['permissions']);
        $role->fill($input)->save();
        $permissions = Permission::all();

        foreach($permissions as $permission) {
            $role->revokePermissionTo($permission);
        }

        foreach($request->permissions as $val) {
            $role->givePermissionTo(Permission::findById($val));
        }

        return redirect('admin/roles')->with('success', 'Role Updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = $this->decrypt($id);
        $role = Role::find($id);

        if (!$role) {
            Session::put('success', 'Role deleted successfully !');
            return redirect('admin/roles');
        }

        $users = $role->users;
        if (count($users)) {
            Session::put('error','Unable to delete, Users has assigned this role !');
            return redirect('admin/roles');
        }
        if ($role->delete()) {
            Session::put('success', 'Role deleted successfully !');
        } else {
            Session::put('error','Unable to delete Role !');
        }

        return redirect('admin/roles');
    }
}
