<?php

namespace App\Models;
use App\Models\Route;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'bus_number',
        'seat_capacity',
        'admin_id'
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
