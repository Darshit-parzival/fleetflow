@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Top Bar -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <h3 class="fw-bold mb-0">Fleet Dashboard</h3>

            <div class="d-flex gap-2">
                <button class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> New Trip
                </button>
                <button class="btn btn-outline-dark">
                    <i class="bi bi-truck"></i> New Vehicle
                </button>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="row g-3 mb-4">

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <p class="text-muted small mb-1">Active Fleet</p>
                        <h4 class="fw-bold text-success mb-0">
                            {{ $activeFleet }}
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <p class="text-muted small mb-1">Maintenance Alerts</p>
                        <h4 class="fw-bold text-danger mb-0">{{ $maintenanceAlerts }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <p class="text-muted small mb-1">Pending Cargo</p>
                        <h4 class="fw-bold text-warning mb-0">{{ $pendingCargo }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <p class="text-muted small mb-1">Utilization Rate</p>
                        <h4 class="fw-bold text-primary mb-0">{{ $utilizationRate }}</h4>
                    </div>
                </div>
            </div>

        </div>

        <!-- Search & Filters -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row g-2">

                    <div class="col-12 col-md-4">
                        <input type="text" class="form-control" placeholder="Search vehicle or driver...">
                    </div>

                    <div class="col-6 col-md-3">
                        <select class="form-select">
                            <option>All Types</option>
                            <option>Truck</option>
                            <option>Van</option>
                            <option>Bike</option>
                        </select>
                    </div>

                    <div class="col-6 col-md-3">
                        <select class="form-select">
                            <option>Status</option>
                            <option>Available</option>
                            <option>On Trip</option>
                            <option>In Shop</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-2">
                        <button class="btn btn-dark w-100">Filter</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Active Trips Table -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-semibold">
                Active Trips
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Vehicle</th>
                            <th>Driver</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activeTrips as $trip)
                            <tr>
                                <td>{{ $trip->id }}</td>
                                <td>{{ $trip->vehicle->name ?? 'N/A' }}</td>
                                <td>{{ $trip->driver->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        {{ ucfirst($trip->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No active trips
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
