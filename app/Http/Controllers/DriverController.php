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
            'name' => 'required|string',
            'license_number' => 'required|unique:drivers',
            'license_type' => 'nullable|string',
            'license_expiry' => 'nullable|date',
            'status' => 'required|in:on_duty,off_duty,suspended',
        ]);

        Driver::create([
            'name' => $request->name,
            'license_number' => $request->license_number,
            'license_type' => $request->license_type,
            'license_expiry' => $request->license_expiry,
            'status' => $request->status,
        ]);

        return redirect()->route('drivers.index')
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
