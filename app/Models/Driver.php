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
        'complaints',
        'safety_score'
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function completionRate()
    {
        $total = $this->trips()->count();
        $completed = $this->trips()->where('status', 'completed')->count();

        if ($total == 0) return 0;

        return round(($completed / $total) * 100, 2);
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
