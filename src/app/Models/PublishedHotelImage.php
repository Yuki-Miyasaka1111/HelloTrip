<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedHotelImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'published_hotel_id',
        'filename',
        'path'
    ];

    public function publishedHotel()
    {
        return $this->belongsTo(PublishedHotel::class);
    }
}
