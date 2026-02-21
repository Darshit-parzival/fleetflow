<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Vehicle;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with('vehicle')
            ->latest()
            ->get();

        return view('maintenance.index', compact('maintenances'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        return view('maintenance.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'issue' => 'required',
            'service_date' => 'required|date',
            'cost' => 'required|numeric|min:0'
        ]);

        Maintenance::create([
            'vehicle_id' => $request->vehicle_id,
            'issue' => $request->issue,
            'service_date' => $request->service_date,
            'cost' => $request->cost,
            'status' => 'scheduled'
        ]);

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance record created.');
    }

    public function edit($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $vehicles = Vehicle::all();

        return view('maintenance.edit', compact('maintenance', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        $maintenance->update([
            'status' => $request->status
        ]);

        // 🔥 Auto Vehicle Status Logic
        if ($request->status == 'in_progress') {
            $maintenance->vehicle->update([
                'status' => 'in_shop'
            ]);
        }

        if ($request->status == 'completed') {
            $maintenance->vehicle->update([
                'status' => 'available'
            ]);
        }

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance updated.');
    }

    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete();

        return back()->with('success', 'Maintenance record deleted.');
    }
}
