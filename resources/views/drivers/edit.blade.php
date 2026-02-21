@extends('layouts.app')

@section('content')

<h3 class="fw-bold mb-4">Edit Driver</h3>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body">

        <form method="POST" action="{{ route('drivers.update', $driver->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name</label>
                <input type="text"
                       name="name"
                       value="{{ $driver->name }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>License Number</label>
                <input type="text"
                       name="license_number"
                       value="{{ $driver->license_number }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>License Expiry</label>
                <input type="date"
                       name="license_expiry"
                       value="{{ $driver->license_expiry }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Complaints</label>
                <input type="number"
                       name="complaints"
                       value="{{ $driver->complaints }}"
                       class="form-control"
                       min="0">
            </div>

            <div class="mb-3">
                <label>Safety Score</label>
                <input type="number"
                       name="safety_score"
                       value="{{ $driver->safety_score }}"
                       class="form-control"
                       min="0"
                       max="100">
            </div>

            <button class="btn btn-dark">
                Update Driver
            </button>

        </form>

    </div>
</div>

@endsection