<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HospitalPromotions extends Model
{
    use HasFactory;
    protected $fillable=[
        'hospital_id',
        'title',
        'description',
        'start_date',
        'end_date'
    ];
    public function hospital():BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
}
