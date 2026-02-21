<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\DriverStatus;
use App\Models\LicenseType;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::with('trips')->get();
        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $licenseTypes = LicenseType::all();
        $statuses = DriverStatus::all();

        return view('drivers.create', compact('licenseTypes', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'license_number' => ['required', 'string', 'max:100', 'unique:drivers,license_number'],
            'license_type_id' => ['required', 'exists:license_types,id'],
            'license_expiry' => ['required', 'date', 'after:today'],
            'driver_status_id' => ['required', 'exists:driver_statuses,id'],
        ]);

        Driver::create($validated);

        return redirect()
            ->route('drivers.index')
            ->with('success', 'Driver created successfully');
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
    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        return view('drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'license_expiry' => 'required|date',
            'complaints' => 'required|integer|min:0',
            'safety_score' => 'required|numeric|min:0|max:100'
        ]);

        $driver->update([
            'name' => $request->name,
            'license_number' => $request->license_number,
            'license_expiry' => $request->license_expiry,
            'complaints' => $request->complaints,
            'safety_score' => $request->safety_score,
        ]);

        return redirect()->route('drivers.index')
            ->with('success', 'Driver updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
