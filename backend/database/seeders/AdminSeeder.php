<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\SystemRequest;
use App\Models\SystemRequestCategory;
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
        ]);

        $user = User::create([
            'first_name'=>"James",
            'last_name'=>"Thomas",
            'name'=>'@james_thomas',
            'email'=>'jamesthomas@gmail.com',
            'password'=>bcrypt('j')
        ]);
        $hospital=User::create([
            'first_name'=>"Richard",
            'last_name'=>"Anderson",
            'name'=>'@richard_anderson',
            'email'=>'richardanderson.angkor@gmail.com',
            'password'=>bcrypt('password'),
        ]);
        $hospital=User::create([
            'first_name'=>"James",
            'last_name'=>"Christ",
            'name'=>'@james_christ',
            'email'=>'jameschirst.hospital@gmail.com',
            'password'=>bcrypt('password'),
        ]);
        $doctor=User::create([
            'first_name'=>"Lucas",
            'last_name'=>"Trauman",
            'name'=>'@lucas_trauman',
            'email'=>'doctor@gmail.com',
            'password'=>bcrypt('password'),
        ]);
        $admin_role = Role::create(['name' => 'admin']);
        $user_role = Role::create(['name' => 'user']);
        $hospital_role = Role::create(['name' => 'hospital']);
        $doctor_role = Role::create(['name' => 'doctor']);

        $feature=SystemRequestCategory::create([
            'name'=>'Feature',
        ]);
        $feature=SystemRequestCategory::create([
            'name'=>'Error',
        ]);
        $feature=SystemRequestCategory::create([
            'name'=>'Other',
        ]);
        $request=SystemRequest::create([
            'user_id'=>2,
            'category_id'=>1,
            'request_details'=>fake()->sentence()
        ]);
        $request=SystemRequest::create([
            'user_id'=>2,
            'category_id'=>1,
            'request_details'=>fake()->sentence()
        ]);
        $request=SystemRequest::create([
            'user_id'=>3,
            'category_id'=>3,
            'request_details'=>fake()->sentence()
        ]);
        $permission = Permission::create(['name' => 'Role access' ,'front_name'=>'role_access']);
        $permission = Permission::create(['name' => 'Role edit' ,'front_name'=>'role_edit']);
        $permission = Permission::create(['name' => 'Role create' ,'front_name'=>'role_create']);
        $permission = Permission::create(['name' => 'Role delete','front_name'=>'role_delete']);

        $permission = Permission::create(['name' => 'Room access' ,'front_name'=>'room_access']);
        $permission = Permission::create(['name' => 'Room edit' ,'front_name'=>'room_edit']);
        $permission = Permission::create(['name' => 'Room create' ,'front_name'=>'room_create']);
        $permission = Permission::create(['name' => 'Room delete','front_name'=>'room_delete']);



        $permission = Permission::create(['name' => 'System-Request access' ,'front_name'=>'system_request_access']);
        $permission = Permission::create(['name' => 'System-Request edit' ,'front_name'=>'system_request_edit']);
        $permission = Permission::create(['name' => 'System-Request create' ,'front_name'=>'system_request_create']);
        $permission = Permission::create(['name' => 'System-Request delete','front_name'=>'system_request_delete']);

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

        $permission = Permission::create(['name' => 'Doctor access','front_name'=>'doctor_access']);
        $permission = Permission::create(['name' => 'Doctor edit','front_name'=>'doctor_edit']);
        $permission = Permission::create(['name' => 'Doctor create','front_name'=>'doctor_create']);
        $permission = Permission::create(['name' => 'Doctor delete','front_name'=>'doctor_delete']);

        $permission = Permission::create(['name' => 'Rate access','front_name'=>'rate_access']);
        $permission = Permission::create(['name' => 'Rate edit' ,'front_name'=>'rate_edit']);
        $permission = Permission::create(['name' => 'Rate create' ,'front_name'=>'rate_create']);
        $permission = Permission::create(['name' => 'Rate delete' ,'front_name'=>'rate_delete']);

        $permission = Permission::create(['name' => 'RateReply access','front_name'=>'rate_reply_access']);
        $permission = Permission::create(['name' => 'RateReply edit' ,'front_name'=>'rate_reply_edit']);
        $permission = Permission::create(['name' => 'RateReply create' ,'front_name'=>'rate_reply_create']);
        $permission = Permission::create(['name' => 'RateReply delete' ,'front_name'=>'rate_reply_delete']);

        $permission = Permission::create(['name' => 'Subscribe-plan access','front_name'=>'subscribe-plan_access']);
        $permission = Permission::create(['name' => 'Subscribe-plan edit' ,'front_name'=>'subscribe-plan_edit']);
        $permission = Permission::create(['name' => 'Subscribe-plan create' ,'front_name'=>'subscribe-plan_create']);
        $permission = Permission::create(['name' => 'Subscribe-plan delete' ,'front_name'=>'subscribe-plan_delete']);

        $admin->assignRole($admin_role);
        $user->assignRole($user_role);
        $hospital->assignRole($hospital_role);
        $doctor->assignRole($doctor_role);

        $admin_role->givePermissionTo(Permission::all());
    }
}
