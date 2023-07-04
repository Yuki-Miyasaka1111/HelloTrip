<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_facilities');
    }
    public function publishedHotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_facilities', 'facility_id', 'hotel_id');
    }
}
