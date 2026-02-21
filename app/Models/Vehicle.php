<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'name',
        'license_plate',
        'type',
        'max_capacity',
        'odometer',
        'status',
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
