<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable=[
        'cover_image',
        'name',
        'category_id',
        'user_id',
        'street_address',
        'village',
        'commune',
        'district',
        'province',
        'latitude',
        'longitude',
        'open_time',
        'close_time',
        'mission',
        'vision'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
    public function previewImage():HasMany
    {
        return $this->hasMany(PreviewImage::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }
    public function favourites():HasMany
    {
        return $this->hasMany(Favourite::class);
    }
    public function rooms():HasMany
    {
        return $this->hasMany(Room::class);
    }
    public function promotions():HasMany
    {
        return $this->hasMany(HospitalPromotions::class);
    }
}
