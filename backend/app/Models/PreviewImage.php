<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreviewImage extends Model
{
    use HasFactory;
    protected $fillable=[
        'hospital_id',
        'image_name'
    ];
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
}
