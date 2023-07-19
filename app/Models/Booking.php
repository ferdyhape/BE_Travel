<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'travel_trip_id',
        'user_id',
        'total_passengers',
        'total_price',
        'payment_proof',
        'status'
    ];

    public function travelTrip()
    {
        return $this->belongsTo(TravelTrip::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function passengers()
    {
        return $this->hasMany(Passengers::class);
    }
}
