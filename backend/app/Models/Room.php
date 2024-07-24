<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'hospital_id',
        'name',
    ];
    public function hospital():BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
    public function apppointments():HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
