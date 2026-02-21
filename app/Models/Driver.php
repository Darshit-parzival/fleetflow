<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'license_number',
        'license_type',
        'license_expiry',
        'status',
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function licenseType()
    {
        return $this->belongsTo(LicenseType::class);
    }

    public function status()
    {
        return $this->belongsTo(DriverStatus::class, 'driver_status_id');
    }
}
