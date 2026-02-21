<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'cargo_weight',
        'origin',
        'destination',
        'status',
        'start_odometer',
        'end_odometer',
        'revenue',
    ];

    // ==============================
    // STATUS CONSTANTS (Important)
    // ==============================
    const STATUS_DRAFT = 'draft';

    const STATUS_DISPATCHED = 'dispatched';

    const STATUS_COMPLETED = 'completed';

    const STATUS_CANCELLED = 'cancelled';

    // ==============================
    // RELATIONSHIPS
    // ==============================

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // ==============================
    // HELPER METHODS
    // ==============================

    public function isDraft()
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isDispatched()
    {
        return $this->status === self::STATUS_DISPATCHED;
    }

    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isCancelled()
    {
        return $this->status === self::STATUS_CANCELLED;
    }
}
