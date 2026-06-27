<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

        protected $fillable = [
            'name',
            'brand',
            'category',
            'year',
            'description',
            'price',
            'transmission',
            'fuel_type',
            'seats',
            'status',
            'image',
            'video',
            'features'
        ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}