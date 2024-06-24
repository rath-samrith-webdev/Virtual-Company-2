<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'user_id',
        'hospital_id',
        'appointment_date'
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function hospital():BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
}
