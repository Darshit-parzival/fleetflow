<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::latest()->get();
        return view('vehicle.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicle.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'license_plate' => 'required|unique:vehicles',
            'type' => 'required',
            'max_capacity' => 'required|integer',
        ]);

        Vehicle::create([
            'name' => $request->name,
            'license_plate' => $request->license_plate,
            'type' => $request->type,
            'max_capacity' => $request->max_capacity,
            'odometer' => 0,
            'status' => 'available',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Vehicle created successfully');
    }
}
