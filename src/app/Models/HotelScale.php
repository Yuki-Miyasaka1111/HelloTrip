<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelScale extends Model
{
    use HasFactory;

    protected $primaryKey = 'facility_scale';

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
    public function publishedHotels()
    {
        return $this->hasMany(PublishedHotel::class);
    }
}
