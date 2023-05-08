<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',       
        'hotels',
    ];

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'campaign_hotel', 'campaign_id', 'hotel_id');
    }
}
