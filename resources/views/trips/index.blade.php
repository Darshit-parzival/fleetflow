@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h3 class="mb-4">Trip Dispatcher & Management</h3>

        {{-- Trip Table --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">
                Active Trips
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Vehicle</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trips as $trip)
                            <tr>
                                <td>{{ $trip->id }}</td>
                                <td>{{ $trip->vehicle->name }}</td>
                                <td>{{ $trip->origin }}</td>
                                <td>{{ $trip->destination }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        {{ ucfirst($trip->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No trips yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- New Trip Form --}}
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">
                New Trip Form
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('trips.store') }}">
                    @csrf

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Select Vehicle</label>
                            <select name="vehicle_id" class="form-select" required>
                                <option value="">Select Vehicle</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">
                                        {{ $vehicle->name }} ({{ $vehicle->license_plate }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Select Driver</label>
                            <select name="driver_id" class="form-select" required>
                                <option value="">Select Driver</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">
                                        {{ $driver->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Cargo Weight (kg)</label>
                            <input type="number" name="cargo_weight" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Estimated Fuel Cost</label>
                            <input type="number" step="0.01" name="estimated_fuel_cost" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Origin Address</label>
                            <input type="text" name="origin" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Destination</label>
                            <input type="text" name="destination" class="form-control" required>
                        </div>

                    </div>

                    <button class="btn btn-success mt-3">
                        Confirm & Dispatch Trip
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection
