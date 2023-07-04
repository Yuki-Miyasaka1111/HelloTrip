<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedHotelFacility extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'published_hotel_facilities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'published_hotel_id',
        'facility_id',
    ];

    /**
     * Get the hotel that owns the facility.
     */
    public function publishedHotel()
    {
        return $this->belongsTo(PublishedHotel::class, 'published_hotel_id');
    }

    /**
     * Get the facility that the hotel has.
     */
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}