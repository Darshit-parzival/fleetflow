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
                <input type="text" name="license_type" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">License Expiry</label>
                <input type="date" name="license_expiry" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="on_duty">On Duty</option>
                    <option value="off_duty">Off Duty</option>
                    <option value="suspended">Suspended</option>
                </select>
            </div>

            <button class="btn btn-primary">Save Driver</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
@endsection
