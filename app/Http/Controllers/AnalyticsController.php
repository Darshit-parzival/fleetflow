<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Maintenance;
use App\Models\Trip;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $totalFuelCost = Expense::sum('fuel_cost');

        $totalRevenue = Trip::where('status', 'completed')
            ->sum('revenue');

        $totalMaintenance = Maintenance::sum('cost');

        $totalCost = $totalFuelCost + $totalMaintenance;

        $fleetROI = $totalCost > 0
            ? round((($totalRevenue - $totalCost) / $totalCost) * 100, 2)
            : 0;

        $activeVehicles = Vehicle::where('status', 'on_trip')->count();
        $totalVehicles = Vehicle::count();

        $utilizationRate = $totalVehicles > 0
            ? round(($activeVehicles / $totalVehicles) * 100)
            : 0;

        $fuelTrend = Expense::selectRaw(
            'MONTH(created_at) as month, SUM(fuel_cost) as total'
        )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $costliestVehicles = Expense::select(
            'vehicle_id',
            DB::raw('SUM(fuel_cost) as total_cost')
        )
            ->groupBy('vehicle_id')
            ->orderByDesc('total_cost')
            ->with('vehicle')
            ->take(5)
            ->get();

        $monthlySummary = Trip::selectRaw(
            'MONTH(created_at) as month,
                 SUM(revenue) as revenue'
        )
            ->groupBy('month')
            ->get();

        return view('analytics.index', compact(
            'totalFuelCost',
            'fleetROI',
            'utilizationRate',
            'fuelTrend',
            'costliestVehicles',
            'monthlySummary',
            'totalMaintenance'
        ));
    }
}
