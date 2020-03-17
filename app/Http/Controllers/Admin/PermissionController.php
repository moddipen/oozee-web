<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $model, $modules, $types;

    /**
     * AdminUserController constructor.
     */
    public function __construct()
    {
        $this->model = new AdminUser();
        $this->modules = [
            'Admin user',
            'Application user',
            'Role management',
            'Permission management',
            'Blog',
            'CMS',
            'News',
            'Subscription plan',
            'Contacts',
            'Feedback',
        ];
        $this->types = [
            'Create',
            'Update',
            'Delete',
            'View',
            'Enable/Disable',
            'Import',
            'Notification',
            'Details',
        ];
    }

    /**
     * @return mixed
     * @throws \Exception
     * Fetch all admin users for datatable
     */
    public function getPermissions()
    {
        $permissions = $this->model->getPermissions();
        $index = 1;
        return Datatables::of($permissions)
            ->addColumn('index', function () use(&$index) {
                return $index++;
            })
            ->addColumn('action', function ($permission) {
                $html = "";
                if (Auth::guard('admin')->user()->hasAnyPermission(['permission-edit'])) {
                    $html .= '<form id="form'.$permission->id.'" action="'.route('admin.permissions.destroy', $this->encrypt($permission->id)).'"  method="post">
                            <a href="'.route('admin.permissions.edit', $this->encrypt($permission->id)).'" class = "btn btn-primary" ><i class="fa fa-edit"></i></a>';
                } else {
                    $html .= '<form id="form'.$permission->id.'" action="'.route('admin.permissions.destroy', $this->encrypt($permission->id)).'"  method="post">';
                }
                if (Auth::guard('admin')->user()->hasAnyPermission(['permission-delete'])) {
                    $html .= ''.method_field("delete").csrf_field().' 
                        <button class="btn btn-danger" onclick="confirmDelete('.$permission->id.')" type="button"><i class="fa fa-trash"></i></button>
                        </form><script> </script>';
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
        return view('admin.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = $this->modules;
        $types = $this->types;
        return view('admin.permissions.create', compact('modules', 'types'));
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
        ]);

        $permission = Permission::create(['name' => $request->name, 'module' => $request->module, 'type' => $request->type ]);
        if ($permission) {
            Session::put('success', 'Permission added successfully !');
        } else {
            Session::put('error','Unable to Add Permission !');
        }
        return redirect('admin/permissions');
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
        $permission = $this->model->getPermissionById($id);
        $modules = $this->modules;
        $types = $this->types;
        if ($permission) {
            return view('admin.permissions.edit',compact('permission', 'modules', 'types'));
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
                'required', Rule::unique('permissions')->ignore($id)],
        ]);

        $permission = Permission::find($id);
        $input = $request->all();
        $permission->fill($input)->save();
        return redirect('admin/permissions')
            ->with('success', 'Permission Updated successfully.');
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
        $permission  = Permission::find($id);

        if ($permission->delete()) {
            Session::put('success', 'Permission deleted successfully !');
        } else {
            Session::put('error','Unable to delete Permission !');
        }

        return redirect('admin/permissions');
    }
}
