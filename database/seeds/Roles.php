<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'admin-user-create',
            'admin-user-edit',
            'admin-user-delete',
//            'admin-user-show',
            'admin-user-views',
            'role-create',
            'role-edit',
            'role-delete',
            'role-views',
//            'role-show',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'permission-views',
//            'permission-show',
            'user-create',
            'user-edit',
            'user-delete',
            'user-views',
//            'user-show',
            'news-create',
            'news-edit',
            'news-delete',
            'news-views',
//            'news-show',
            'blog-create',
            'blog-edit',
            'blog-delete',
            'blog-views',
//            'blog-show',
            'cms-create',
            'cms-edit',
            'cms-delete',
            'cms-views',
//            'cms-show'
            'plan-edit',
            'plan-views'
        ];

        foreach($permissions as $permission){
            Permission::create(['guard_name' => 'admin', 'name'=>$permission]);
        }

        $role = Role::create(['guard_name' => 'admin', 'name'=>'Super Admin']);
        $role->givePermissionTo(Permission::all());
    }
}
