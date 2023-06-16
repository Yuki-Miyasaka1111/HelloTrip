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
        'immediate_publication_set',
        'end_publication_set',
        'publication_date',
        'publication_time',
        'end_publication_date',
        'end_publication_time',
        'publish_status',
        'campaign_start_date',
        'campaign_end_date',
        'description',
        'content',       
    ];

    protected $dates = ['publication_date', 'end_publication_date', 'campaign_start_date', 'campaign_end_date'];

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'campaign_hotel', 'campaign_id', 'hotel_id');
    }
    public function images()
    {
        return $this->hasMany(CampaignImage::class);
    }
}
