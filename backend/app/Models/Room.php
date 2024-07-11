<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
