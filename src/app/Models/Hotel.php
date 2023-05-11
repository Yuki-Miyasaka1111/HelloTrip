<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'price',
        'category_id',
        'region_id',
        'address',
        'description',
        'url',
        'phone_number',
        'client_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_hotel', 'hotel_id', 'campaign_id');
    }
    public function images()
    {
        return $this->hasMany(HotelImage::class);
    }
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'hotel_facilities');
    }
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'hotel_amenities');
    }
}
