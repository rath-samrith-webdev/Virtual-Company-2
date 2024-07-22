<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscribePlan extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'price',
        'duration',
        'currency'
    ];
    public function payments():HasMany
    {
        return $this->hasMany(SubscribePayment::class);
    }
}
