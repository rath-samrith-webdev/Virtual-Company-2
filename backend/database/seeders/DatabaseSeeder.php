<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Rate;
use App\Models\RateReply;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AdminSeeder::class);
        \App\Models\Post::factory(17)->create();
        Category::create([
            'name'=>'Dental'
        ]);
        Hospital::create([
            'user_id'=>3,
            'category_id'=>1,
            'name'=>'Angkor Thom',
            'latitude'=>'11.566859422611982',
            'longitude'=>'104.89597919278232'
        ]);
        Department::create([
            'hospital_id'=>1,
            'name'=>"Dentist"
        ]);
        Doctor::create([
            'hospital_id'=>1,
            'name'=>'Radit THY',
            'email'=>'radithy@gmail.com',
            'phone'=>'0123456789',
        ]);
        Appointment::create([
            'title'=>'Appointment',
            'hospital_id'=>1,
            'doctor_id'=>1,
            'user_id'=>2,
            'appointment_date'=>'2022-01-01',
        ]);
        Rate::create([
            'hospital_id'=>1,
            'user_id'=>2,
            'content'=>'The service is pretty good'
        ]);
        RateReply::create([
            'rate_id'=>1,
            'user_id'=>2,
            'content'=>'Could not disagree'
        ]);

        $this->call(MailsettingSeeder::class);
    }
}
