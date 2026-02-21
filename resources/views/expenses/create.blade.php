@extends('layouts.app')

@section('content')

<h3 class="fw-bold mb-4">Add Expense</h3>

<form method="POST" action="{{ route('expenses.store') }}">
    @csrf

    <div class="mb-3">
        <label>Trip</label>
        <select name="trip_id" class="form-control">
            @foreach($trips as $trip)
                <option value="{{ $trip->id }}">
                    Trip #{{ $trip->id }} - {{ $trip->driver->name ?? 'N/A' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Distance (km)</label>
        <input type="number" name="distance" class="form-control">
    </div>

    <div class="mb-3">
        <label>Fuel Expense (₹)</label>
        <input type="number" name="fuel_expense" class="form-control">
    </div>

    <div class="mb-3">
        <label>Misc Expense (₹)</label>
        <input type="number" name="misc_expense" class="form-control">
    </div>

    <button class="btn btn-dark">Save</button>

</form>

@endsection