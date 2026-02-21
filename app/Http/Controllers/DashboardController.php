<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    public function index()
    {
        $activeFleet = Vehicle::where('status', 'on_trip')->count();
        $maintenanceAlerts = Vehicle::where('status', 'in_shop')->count();
        $pendingCargo = Trip::where('status', 'draft')->count();

        $totalVehicles = Vehicle::where('status', '!=', 'retired')->count();

        $utilizationRate = $totalVehicles > 0
            ? round(($activeFleet / $totalVehicles) * 100)
            : 0;

        $activeTrips = Trip::with(['vehicle', 'driver'])
            ->where('status', 'dispatched')
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
