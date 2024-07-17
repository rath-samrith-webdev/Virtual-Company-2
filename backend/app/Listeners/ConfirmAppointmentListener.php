<?php

namespace App\Listeners;

use App\Events\ConfirmAppointment;
use App\Models\Appointment;
use App\Models\Notifications;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ConfirmAppointmentListener implements ShouldQueue
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
    public function handle(ConfirmAppointment $event): void{
        $appointment = $event->appointment;
        if ($appointment->hospital_status=="Confirmed" && $appointment->doctor_status=="Confirmed") {
            $appointment->update(['status'=>'Confirmed']);
        }
    }
}
