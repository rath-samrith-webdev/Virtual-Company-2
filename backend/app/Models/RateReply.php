<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateReply extends Model
{
    use HasFactory;
    protected $fillable=[
        'rate_id',
        'user_id',
        'context'
    ];
}
