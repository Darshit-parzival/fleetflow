<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::latest()->get();

        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|unique:vehicles',
            'name' => 'required',
            'type' => 'required',
            'max_capacity' => 'required|integer',
            'odometer' => 'required|integer|min:0',
        ]);

        Vehicle::create([
            'license_plate' => $request->license_plate,
            'name' => $request->name,
            'type' => $request->type,
            'max_capacity' => $request->max_capacity,
            'odometer' => $request->odometer,
            'status' => 'available', // default state
        ]);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle registered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
