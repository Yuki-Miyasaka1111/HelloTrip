<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedMonthlyHoliday extends Model
{
    use HasFactory;

    protected $fillable = [
        'week',
        'day',
    ];

    public function publishedHotel()
    {
        return $this->belongsTo(PublishedHotel::class);
    }
}
