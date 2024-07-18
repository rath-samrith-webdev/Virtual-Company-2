<?php

namespace App\Models;

use App\Events\NotificationNotifier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'created'=>NotificationNotifier::class,
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function sendFrom():BelongsTo
    {
        return $this->belongsTo(User::class,'from');
    }
}
