<?php

namespace App\Models;

use App\Events\ConfirmAppointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'doctor_id',
        'user_id',
        'hospital_id',
        'appointment_date',
        'appointment_time',
        'status',
        'hospital_status',
        'doctor_status'
    ];
    protected $dispatchesEvents = [
        'updated'=>ConfirmAppointment::class
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function hospital():BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
    public function doctor():BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
    public function room():BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
