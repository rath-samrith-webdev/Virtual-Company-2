<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\AppointmentNotifications;
use App\Models\Category;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Favourite;
use App\Models\Hospital;
use App\Models\Rate;
use App\Models\RateReply;
use App\Models\Room;
use App\Models\SubscribePlan;
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
        $category=Category::create([
            'name'=>'Community',
            'description'=>"In-patient care provided does not require the highly technical specialist support of an acute hospital. In-patient care provided under the supervision of GP's, specialist doctors or nurses, may include a minor injury service and elderly mentally ill beds. Where care is provided by consultants this is usually for elderly patients. Other services such as out-patient clinics, diagnostic and therapy services and day care may also be provided. Would not receive major acute emergency admissions. Would not be expected to undertake in-patient general surgery requiring general anaesthesia"
        ]);
        $category=Category::create([
            'name'=>'Psychiatric',
            'description'=>"Psychiatric hospitals, also known as mental hospitals, are hospitals specializing in the treatment of serious mental disorders. This industry includes establishments licensed to provide diagnostic, medical treatment, and monitoring services for inpatients who suffer from mental illness or substance abuse disorders."
        ]);
        $category=Category::create([
            'name'=>'Federal',
            'description'=>'Federal hospitals are run and funded by the federal government include mostly Veterans’ Administration hospitals and clinics.'
        ]);
        Hospital::create([
            'user_id'=>3,
            'category_id'=>1,
            'name'=>'Angkor Thom Polyclinic & Maternity',
            'street_address'=>'Str. 128',
            'phone_number'=>'023 992 268',
            'province'=>'Phnom Penh',
            'open_time'=>'05:00',
            'close_time'=>'06:00',
            'latitude'=>'11.566859422611982',
            'longitude'=>'104.89597919278232'
        ]);
        Room::create([
            'name'=>'Room 1',
            'hospital_id'=>1,
            'number_of_bed'=>2,
        ]);
        Department::create([
            'hospital_id'=>1,
            'name'=>"Dentist"
        ]);
        $dataDoct=Doctor::create([
            'user_id'=>4,
            'hospital_id'=>1,
        ]);
        SubscribePlan::create([
           'name'=>'Free plan',
           'price'=>0,
           'currency'=>'USD',
           'duration'=>7
        ]);
        Appointment::create([
            'title'=>'Appointment',
            'hospital_id'=>1,
            'doctor_id'=>1,
            'user_id'=>2,
            'appointment_date'=>'2022-01-01',
            'room_id'=>1,
            'appointment_time'=>'09:00',
        ]);
        Rate::create([
            'hospital_id'=>1,
            'user_id'=>2,
            'content'=>'The service is pretty good'
        ]);
        RateReply::create([
            'rate_id'=>1,
            'hospital_id'=>1,
            'content'=>'Thank you for this comment'
        ]);
        $user_favourite = Favourite::create([
            'user_id'=>2,
            'hospital_id'=>1,
        ]);
        $this->call(MailsettingSeeder::class);
    }
}
