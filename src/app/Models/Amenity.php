<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_amenities');
    }
    public function publishedHotel()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_amenities', 'amenity_id', 'hotel_id');
    }
}
