<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyHoliday extends Model
{
    use HasFactory;

    protected $fillable = [
        'week',
        'day',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
