<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'from_location',
        'to_location',
        'fare',
        'admin_id'
    ];

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}
