<?php

namespace App\Providers;

use App\Events\AppointmentNotification;
use App\Events\AppointmentNotifier;
use App\Events\ConfirmAppointment;
use App\Listeners\AppointmentNotificationListener;
use App\Listeners\AppointmentNotifierListener;
use App\Listeners\ConfirmAppointmentListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ConfirmAppointment::class=>[
            ConfirmAppointmentListener::class,
        ],
        AppointmentNotifier::class=>[
            AppointmentNotifierListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    public function shouldDiscoverEvents()
    {
        return true;
    }
}
