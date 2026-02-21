<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Trip;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with(['vehicle', 'driver'])->latest()->get();

        $vehicles = Vehicle::where('status', 'available')->get();

        $drivers = Driver::where('status', 'on_duty')
            ->where(function ($q) {
                $q->whereNull('license_expiry')
                    ->orWhereDate('license_expiry', '>=', now());
            })
            ->get();

        return view('trips.index', compact('trips', 'vehicles', 'drivers'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('status', 'available')->get();
        $drivers = Driver::where('status', 'on_duty')
            ->whereDate('license_expiry', '>=', now())
            ->get();

        return view('trips.create', compact('vehicles', 'drivers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => ['required', 'exists:vehicles,id'],
            'driver_id' => ['required', 'exists:drivers,id'],
            'cargo_weight' => ['required', 'integer', 'min:1'],
            'estimated_fuel_cost' => ['nullable', 'numeric', 'min:0'],
            'origin' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
        ]);

        $vehicle = Vehicle::where('id', $validated['vehicle_id'])
            ->where('status', 'available')
            ->firstOrFail();

        $driver = Driver::where('id', $validated['driver_id'])
            ->where('status', 'on_duty')
            ->firstOrFail();

        if ($validated['cargo_weight'] > (int) $vehicle->max_capacity) {
            return back()
                ->withInput()
                ->withErrors([
                    'cargo_weight' => "Cargo exceeds vehicle capacity of {$vehicle->max_capacity} kg.",
                ]);
        }

        DB::transaction(function () use ($validated, $vehicle, $driver) {

            Trip::create([
                'vehicle_id' => $vehicle->id,
                'driver_id' => $driver->id,
                'cargo_weight' => $validated['cargo_weight'],
                'estimated_fuel_cost' => $validated['estimated_fuel_cost'] ?? 0,
                'origin' => $validated['origin'],
                'destination' => $validated['destination'],
                'status' => Trip::STATUS_DISPATCHED,
            ]);

            $vehicle->update(['status' => 'on_trip']);
            $driver->update(['status' => 'on_trip']);
        });

        return redirect()
            ->route('trips.index')
            ->with('success', 'Trip dispatched successfully.');
    }
}
