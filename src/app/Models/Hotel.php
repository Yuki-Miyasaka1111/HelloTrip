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
        'phone_number',
        'prefecture_id',
        'area_id',
        'url',
        'client_id',
        'user_id',
        'facility_scale',
        'prefecture',
        'catch_copy',
        'minimum_price',
        'postal_code',
        'address_1',
        'address_2',
        'address_3',
        'access',
        'check_in',
        'check_out',
        'parking_information',
        'monthly_holiday',
        'temporary_holiday',
        'other_information',
        'other_facility_information',
        'other_equipment_information',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class, 'prefecture_id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
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
