<?php

namespace App\Listeners;

use App\Events\ConfirmAppointment;
use App\Models\AppointmentNotifications;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AppointmentNotifierListener implements ShouldQueue
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
    public function handle(ConfirmAppointment $event): void
    {
        $appointment=$event->appointment;
        if($appointment->status=='Confirmed'){
            AppointmentNotifications::create([
                'user_id'=>$appointment->user_id,
                'appointment_id'=>$appointment->id,
                'type'=>'Appointment Accepted',
                'message'=>'Your appointment has been accepted',
                'from'=>$appointment->hospital->user_id
            ]);
        }
    }
}
