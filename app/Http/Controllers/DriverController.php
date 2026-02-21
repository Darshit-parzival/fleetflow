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
        $drivers = Driver::latest()->get();

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
