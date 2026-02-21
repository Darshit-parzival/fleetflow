@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Create New Trip</h3>

        <form method="POST" action="{{ route('trips.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Vehicle</label>
                <select name="vehicle_id" class="form-select" required>
                    <option value="">Select Vehicle</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">
                            {{ $vehicle->name }} ({{ $vehicle->license_plate }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Driver</label>
                <select name="driver_id" class="form-select" required>
                    <option value="">Select Driver</option>
                    @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}">
                            {{ $driver->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Cargo Weight (kg)</label>
                <input type="number" name="cargo_weight" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Origin</label>
                <input type="text" name="origin" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Destination</label>
                <input type="text" name="destination" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">
                Dispatch Trip
            </button>

            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>
    </div>
@endsection
