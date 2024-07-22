<?php

namespace App\Listeners;

use App\Events\AppointmentPlaced;
use App\Models\AppointmentNotifications;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyToHospital implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AppointmentPlaced $event): void
    {
        $appointment=$event->appointment;
        $compare=AppointmentNotifications::where('appointment_id',$appointment->id)->first();
        $compare2=AppointmentNotifications::where('appointment_id',$appointment->id)->first();
        if(!$compare){
            AppointmentNotifications::create([
                'user_id'=>$appointment->hospital->user_id,
                'appointment_id'=>$appointment->id,
                'type'=>'New Appointment Added',
                'message'=>'Added new appointment',
                'from'=>$appointment->user_id
            ]);
        }
        if(!$compare2){
            AppointmentNotifications::create([
                'user_id'=>$appointment->doctor->user_id,
                'appointment_id'=>$appointment->id,
                'type'=>'New Appointment Added',
                'message'=>'You have received an appointment request',
                'from'=>$appointment->user_id
            ]);
        }
    }
}
