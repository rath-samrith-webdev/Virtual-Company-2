<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscribePayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'payment_id',
        'payment_type',
        'user_id',
        'payer_email',
        'amount',
        'subscribe_plan_id'
    ];
    public function subscribePlan():BelongsTo
    {
        return $this->belongsTo(SubscribePlan::class);
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
