<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RateReply extends Model
{
    use HasFactory;
    protected $fillable=[
        'rate_id',
        'user_id',
        'content'
    ];
    public function rate(): BelongsTo
    {
        return $this->belongsTo(Rate::class);
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
