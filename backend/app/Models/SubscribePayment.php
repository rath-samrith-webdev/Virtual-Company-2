<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribePayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'payment_id',
        'payment_type',
        'user_id',
        'payer_email',
        'amount'
    ];
}
