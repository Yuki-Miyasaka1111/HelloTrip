<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedHotel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'concept',
        'phone_number',
        'prefecture_id',
        'area_id',
        'category_id',
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
        'is_public',
        'last_updated'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id', 'id');
    }

    public function images()
    {
        return $this->hasMany(PublishedHotelImage::class);
    }
}