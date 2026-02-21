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
        // dd($request->all());
        $request->validate([
            'vehicle_id' => 'required',
            'driver_id' => 'required',
            'cargo_weight' => 'required|integer',
            'origin' => 'required',
            'destination' => 'required',
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        if ($request->cargo_weight > $vehicle->max_capacity) {
            return back()->withErrors([
                'cargo_weight' => 'Cargo exceeds vehicle capacity.',
            ]);
        }

        $trip = Trip::create([
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'cargo_weight' => $request->cargo_weight,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'status' => Trip::STATUS_DISPATCHED,
        ]);

        // Update states
        $vehicle->update(['status' => 'on_trip']);
        $trip->driver->update(['status' => 'on_trip']);

        return redirect()->route('dashboard')
            ->with('success', 'Trip dispatched successfully');
    }
}
