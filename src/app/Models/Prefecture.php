<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
    public function publishedHotels()
    {
        return $this->hasMany(PublishedHotel::class);
    }
    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
