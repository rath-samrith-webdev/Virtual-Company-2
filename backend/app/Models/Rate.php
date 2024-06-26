<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rate extends Model
{
    use HasFactory;
    protected $fillable=[
        'hospital_id',
        'user_id',
        'content'
    ];
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function RateReply():HasMany
    {
        return $this->hasMany(RateReply::class);
    }
}
