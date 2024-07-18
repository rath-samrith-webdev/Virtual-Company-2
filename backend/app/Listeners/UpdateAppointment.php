<?php

namespace App\Listeners;

use App\Events\AppointmentPlaced;
use App\Models\AppointmentNotifications;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateAppointment implements ShouldQueue
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
        AppointmentNotifications::create([
            'user_id'=>$appointment->user_id,
            'appointment_id'=>$appointment->id,
            'type'=>'Appointment Added',
            'message'=>'Added a new appointment',
            'from'=>$appointment->hospital->user_id
        ]);
        AppointmentNotifications::create([
            'user_id'=>$appointment->user_id,
            'appointment_id'=>$appointment->id,
            'type'=>'Appointment Added',
            'message'=>'Added a new appointment',
            'from'=>$appointment->doctor->user_id
        ]);
    }
}
