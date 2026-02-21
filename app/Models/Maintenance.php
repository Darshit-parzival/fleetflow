<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class maintenance extends Model
{
    protected $fillable = [
        'vehicle_id',
        'issue',
        'service_date',
        'cost',
        'status'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
