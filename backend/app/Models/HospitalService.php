<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalService extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'image',
        'description',
        'hospital_id'
    ];

}
