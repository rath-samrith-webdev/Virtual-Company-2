<?php

namespace App\Listeners;

use App\Events\ConfirmAppointment;
use App\Models\Notifications;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AppointmentNotificationListener implements ShouldQueue
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
        $appointment = $event->appointment;
        if($appointment->status=='Confirmed'){
            Notifications::create([
                'type'=>'Appointment Confirmed',
                'message'=>'Your appointment has been confirmed',
                'user_id'=>$appointment->user_id
            ]);
        }
    }

}
