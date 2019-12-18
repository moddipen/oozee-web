<?php

namespace App\Models;

use App\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminUser extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes;

    protected $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }


    /**
     * Store procedures
     */

    public function getAdminUserById($id)
    {
        return $this->hydrate(
            DB::select(
                'call select_admin_user_by_id('.$id.')'
            )
        )->first();
    }

    public function getAdminUsersExceptCurrent($id)
    {
        return $this->hydrate(
            DB::select(
                'call select_admin_users_except_current('.$id.')'
            )
        );
    }

    public function getAdminUsers()
    {
        return $this->hydrate(
            DB::select(
                'call select_admin_users()'
            )
        );
    }

    public function getRoleById($id)
    {
        return $this->hydrate(
            DB::select(
                'call select_role_by_id('.$id.')'
            )
        )->first();
    }

    public function getRoles()
    {
        return $this->hydrate(
            DB::select(
                'call select_roles()'
            )
        );
    }

    public function getPermissionById($id)
    {
        return $this->hydrate(
            DB::select(
                'call select_permission_by_id('.$id.')'
            )
        )->first();
    }

    public function getPermissions()
    {
        return $this->hydrate(
            DB::select(
                'call select_permissions()'
            )
        );
    }
}
