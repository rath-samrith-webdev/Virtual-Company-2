<?php

namespace App\Models;

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
        'from'
    ];
}
