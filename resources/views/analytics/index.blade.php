@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h3 class="mb-4">Operational Analytics & Financial Reports</h3>

        {{-- KPI CARDS --}}
        <div class="row g-3 mb-4">

            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h6>Total Fuel Cost</h6>
                        <h4 class="text-success">₹ {{ number_format($totalFuelCost, 2) }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h6>Fleet ROI</h6>
                        <h4 class="text-primary">{{ $fleetROI }}%</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h6>Utilization Rate</h6>
                        <h4 class="text-warning">{{ $utilizationRate }}%</h4>
                    </div>
                </div>
            </div>

        </div>

        {{-- TOP COSTLIEST VEHICLES --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">
                Top 5 Costliest Vehicles
            </div>

            <div class="card-body">
                <ul class="list-group">
                    @foreach ($costliestVehicles as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $item->vehicle->name ?? 'Unknown' }}
                            <span>₹ {{ number_format($item->total_cost, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- MONTHLY FINANCIAL SUMMARY --}}
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">
                Financial Summary of Month
            </div>

            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Month</th>
                            <th>Revenue</th>
                            <th>Fuel Cost</th>
                            <th>Maintenance</th>
                            <th>Net Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monthlySummary as $month)
                            <tr>
                                <td>{{ $month->month }}</td>
                                <td>₹ {{ number_format($month->revenue, 2) }}</td>
                                <td>₹ {{ number_format($totalFuelCost, 2) }}</td>
                                <td>₹ {{ number_format($totalMaintenance, 2) }}</td>
                                <td>
                                    ₹
                                    {{ number_format($month->revenue - ($totalFuelCost + $totalMaintenance), 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
