@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">New Vehicle Registration</h3>

        <form method="POST" action="{{ route('vehicles.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">License Plate</label>
                <input type="text" name="license_plate" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Model / Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Type</label>
                <input type="text" name="type" class="form-control" placeholder="Truck / Van / Bike" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Max Payload (kg)</label>
                <input type="number" name="max_capacity" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Initial Odometer (km)</label>
                <input type="number" name="odometer" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">
                Save
            </button>

            <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary">
                Cancel
            </a>
        </form>
    </div>
@endsection
