<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $table = 'travels_company';
    protected $fillable = [
        'name',
        'description',
        'profile_photo_path',
    ];

    public function trips()
    {
        return $this->hasMany(TravelTrip::class);
    }
}
