<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelTrip extends Model
{
    use HasFactory;

    protected $table = 'travel_trips';
    protected $fillable = [
        'departure_time',
        'arrival_time',
        'departure_city',
        'destination_city',
        'price',
        'travel_company_id',
    ];

    public function travel()
    {
        return $this->belongsTo(Travel::class, 'travel_company_id', 'id');
    }
}
