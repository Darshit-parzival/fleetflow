@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <!-- Top Bar -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <h3 class="fw-bold mb-0">Fleet Dashboard</h3>

            <div class="d-flex gap-2">
                <a href="{{ route('trips.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> New Trip
                </a>
                <a href="{{ route('vehicles.create') }}" class="btn btn-outline-dark">
                    <i class="bi bi-truck"></i> New Vehicle
                </a>
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
                <form method="GET" action="{{ route('dashboard') }}">
                    <div class="row g-2">

                        <div class="col-12 col-md-4">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="Search vehicle or driver...">
                        </div>

                        <div class="col-6 col-md-3">
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                <option value="Truck" {{ request('type') == 'Truck' ? 'selected' : '' }}>Truck</option>
                                <option value="Van" {{ request('type') == 'Van' ? 'selected' : '' }}>Van</option>
                                <option value="Bike" {{ request('type') == 'Bike' ? 'selected' : '' }}>Bike</option>
                            </select>
                        </div>

                        <div class="col-6 col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>
                                    Available</option>
                                <option value="on_trip" {{ request('status') == 'on_trip' ? 'selected' : '' }}>On Trip
                                </option>
                                <option value="in_shop" {{ request('status') == 'in_shop' ? 'selected' : '' }}>In Shop
                                </option>
                            </select>
                        </div>

                        <div class="col-6 col-md-1">
                            <button type="submit" class="btn btn-dark w-100">
                                Filter
                            </button>
                        </div>

                        <div class="col-6 col-md-1">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100">
                                Reset
                            </a>
                        </div>

                    </div>
                </form>
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
                                    @php
                                        $badgeClass = match ($trip->status) {
                                            'dispatched' => 'bg-warning text-dark',
                                            'completed' => 'bg-success',
                                            'cancelled' => 'bg-danger',
                                            default => 'bg-secondary',
                                        };
                                    @endphp

                                    <span class="badge {{ $badgeClass }}">
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
