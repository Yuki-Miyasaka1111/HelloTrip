<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedTemporaryHoliday extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
    ];

    public function publishedHotel()
    {
        return $this->belongsTo(PublishedHotel::class);
    }
}
