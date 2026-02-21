<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\TripExpense;
use App\Models\Maintenance;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // ========================
        // KPIs (Global Stats)
        // ========================

        $activeFleet = Vehicle::where('status', 'on_trip')->count();
        $maintenanceAlerts = Vehicle::where('status', 'in_shop')->count();
        $pendingCargo = Trip::where('status', 'draft')->count();

        $totalVehicles = Vehicle::where('status', '!=', 'retired')->count();

        $utilizationRate = $totalVehicles > 0
            ? round(($activeFleet / $totalVehicles) * 100)
            : 0;

        // ========================
        // Active Trips (Filterable)
        // ========================

        $tripQuery = Trip::with(['vehicle', 'driver'])
            ->where('status', 'dispatched');

        // Filter by vehicle type
        if ($request->type) {
            $tripQuery->whereHas('vehicle', function ($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        // Filter by vehicle status
        if ($request->status) {
            $tripQuery->whereHas('vehicle', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        $activeTrips = $tripQuery
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'activeFleet',
            'maintenanceAlerts',
            'pendingCargo',
            'utilizationRate',
            'activeTrips'
        ));
    }
}
