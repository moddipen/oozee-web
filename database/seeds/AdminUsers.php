<?php

use Illuminate\Database\Seeder;
use App\Models\AdminUser;

class AdminUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new AdminUser();
        $admin->name = 'Admin';
        $admin->email = 'admin1@yopmail.com';
        $admin->username = 'admin123';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->assignRole(['Super Admin']);

        $admin = new AdminUser();
        $admin->name = 'Admin2';
        $admin->email = 'admin2@yopmail.com';
        $admin->username = 'admin1234';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->assignRole(['Super Admin']);
    }
}
