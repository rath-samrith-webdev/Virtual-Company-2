<?php

namespace App\Providers;

use App\Events\AppointmentNotification;
use App\Events\AppointmentNotifier;
use App\Events\AppointmentPlaced;
use App\Events\ConfirmAppointment;
use App\Events\NotificationNotifier;
use App\Listeners\AppointmentNotificationListener;
use App\Listeners\AppointmentNotifierListener;
use App\Listeners\ConfirmAppointmentListener;
use App\Listeners\NotificationNotifierListener;
use App\Listeners\UpdateAppointment;
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
        NotificationNotifier::class=>[
            NotificationNotifierListener::class,
        ],
        AppointmentPlaced::class=>[
            UpdateAppointment::class
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
