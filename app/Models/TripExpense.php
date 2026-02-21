<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripExpense extends Model
{
    protected $fillable = [
        'trip_id',
        'distance',
        'fuel_expense',
        'misc_expense',
        'status'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
