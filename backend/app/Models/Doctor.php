<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'hospital_id',
        'name',
        'email',
        'phone'
    ];
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
}
