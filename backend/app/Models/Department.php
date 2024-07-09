<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'hospital_id',
        'name',
        'details',
        'image'
    ];
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
}
