<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bus;
use App\Models\Route;
class Schedule extends Model
{
    protected $fillable = [
        'bus_id',
        'route_id',
        'travel_date',
        'departure_time',
        'arrival_time',
        'admin_id'
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
