<?php

namespace App\Models;

use App\Events\NotificationNotifier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentNotifications extends Model
{
    use HasFactory;
    protected $fillable=[
        'appointment_id',
        'user_id',
        'type',
        'message',
        'from',
        'is_read'
    ];
    protected $dispatchesEvents=[
        'created'=>NotificationNotifier::class
    ];
}
