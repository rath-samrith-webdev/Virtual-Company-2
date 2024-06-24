<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'first_name'=>"Admin",
            'last_name'=>"User",
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('password'),
            'user_type'=>'admin',
            'profile' => 'user.avif'
        ]);

        $user = User::create([
            'first_name'=>"Test",
            'last_name'=>"User",
            'name'=>'User',
            'email'=>'user@gmail.com',
            'password'=>bcrypt('password')
        ]);
        $hospital=User::create([
            'first_name'=>"Hospital",
            'last_name'=>"User",
            'name'=>'Hospital',
            'email'=>'hospital@gmail.com',
            'password'=>bcrypt('password')
        ]);



        $admin_role = Role::create(['name' => 'admin']);
        $user_role = Role::create(['name' => 'user']);
        $hospital_role = Role::create(['name' => 'hospital']);

        $permission = Permission::create(['name' => 'Post access','front_name'=>'post_access']);
        $permission = Permission::create(['name' => 'Post edit' ,'front_name'=>'post_edit']);
        $permission = Permission::create(['name' => 'Post create' ,'front_name'=>'post_create']);
        $permission = Permission::create(['name' => 'Post delete' ,'front_name'=>'post_delete']);

        $permission = Permission::create(['name' => 'Role access' ,'front_name'=>'role_access']);
        $permission = Permission::create(['name' => 'Role edit' ,'front_name'=>'role_edit']);
        $permission = Permission::create(['name' => 'Role create' ,'front_name'=>'role_create']);
        $permission = Permission::create(['name' => 'Role delete','front_name'=>'role_delete']);

        $permission = Permission::create(['name' => 'User access','front_name'=>'user_access']);
        $permission = Permission::create(['name' => 'User edit','front_name'=>'user_edit']);
        $permission = Permission::create(['name' => 'User create','front_name'=>'user_create']);
        $permission = Permission::create(['name' => 'User delete','front_name'=>'user_delete']);

        $permission = Permission::create(['name' => 'Permission access','front_name'=>'permission_access']);
        $permission = Permission::create(['name' => 'Permission edit','front_name'=>'permission_edit']);
        $permission = Permission::create(['name' => 'Permission create','front_name'=>'permission_create']);
        $permission = Permission::create(['name' => 'Permission delete','front_name'=>'permission_delete']);

        $permission = Permission::create(['name' => 'Mail access','front_name'=>'mail_access']);
        $permission = Permission::create(['name' => 'Mail edit','front_name'=>'mail_edit']);

        $permission = Permission::create(['name' => 'Hospital access','front_name'=>'hospital_access']);
        $permission = Permission::create(['name' => 'Hospital edit' ,'front_name'=>'hospital_edit']);
        $permission = Permission::create(['name' => 'Hospital create' ,'front_name'=>'hospital_create']);
        $permission = Permission::create(['name' => 'Hospital delete' ,'front_name'=>'hospital_delete']);

        $permission = Permission::create(['name' => 'Category access','front_name'=>'category_access']);
        $permission = Permission::create(['name' => 'Category edit' ,'front_name'=>'category_edit']);
        $permission = Permission::create(['name' => 'Category create' ,'front_name'=>'category_create']);
        $permission = Permission::create(['name' => 'Category delete' ,'front_name'=>'category_delete']);

        $permission = Permission::create(['name' => 'Appointment access','front_name'=>'appointment_access']);
        $permission = Permission::create(['name' => 'Appointment edit' ,'front_name'=>'appointment_edit']);
        $permission = Permission::create(['name' => 'Appointment create' ,'front_name'=>'appointment_create']);
        $permission = Permission::create(['name' => 'Appointment delete' ,'front_name'=>'appointment_delete']);

        $permission = Permission::create(['name' => 'Department access','front_name'=>'department_access']);
        $permission = Permission::create(['name' => 'Department edit' ,'front_name'=>'department_edit']);
        $permission = Permission::create(['name' => 'Department create' ,'front_name'=>'department_create']);
        $permission = Permission::create(['name' => 'Department delete' ,'front_name'=>'department_delete']);

        $permission = Permission::create(['name' => 'Rate access','front_name'=>'rate_access']);
        $permission = Permission::create(['name' => 'Rate edit' ,'front_name'=>'rate_edit']);
        $permission = Permission::create(['name' => 'Rate create' ,'front_name'=>'rate_create']);
        $permission = Permission::create(['name' => 'Rate delete' ,'front_name'=>'rate_delete']);

        $permission = Permission::create(['name' => 'RateReply access','front_name'=>'rate_reply_access']);
        $permission = Permission::create(['name' => 'RateReply edit' ,'front_name'=>'rate_reply_edit']);
        $permission = Permission::create(['name' => 'RateReply create' ,'front_name'=>'rate_reply_create']);
        $permission = Permission::create(['name' => 'RateReply delete' ,'front_name'=>'rate_reply_delete']);

        $admin->assignRole($admin_role);
        $user->assignRole($user_role);
        $hospital->assignRole($hospital_role);

        $admin_role->givePermissionTo(Permission::all());
    }
}
