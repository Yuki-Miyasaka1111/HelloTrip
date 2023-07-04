<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedHotelAmenity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'published_hotel_amenities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'published_hotel_id',
        'amenity_id',
    ];

    /**
     * Get the hotel that owns the amenity.
     */
    public function publishedHotel()
    {
        return $this->belongsTo(PublishedHotel::class, 'published_hotel_id');
    }

    /**
     * Get the amenity that the hotel has.
     */
    public function amenity()
    {
        return $this->belongsTo(Amenity::class);
    }
}