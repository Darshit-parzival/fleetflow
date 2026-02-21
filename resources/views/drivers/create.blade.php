@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Add New Driver</h3>

        <form method="POST" action="{{ route('drivers.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Driver Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">License Number</label>
                <input type="text" name="license_number" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">License Type</label>
                <select name="license_type_id" class="form-select" required>
                    <option value="">Select License Type</option>
                    @foreach ($licenseTypes as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">License Expiry</label>
                <input type="date" name="license_expiry" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="driver_status_id" class="form-select" required>
                    <option value="">Select Status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">
                            {{ ucfirst($status->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Save Driver</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
@endsection
