@extends('layouts.app')

@section('content')

<h3 class="fw-bold mb-4">Create Maintenance</h3>

<form method="POST" action="{{ route('maintenance.store') }}">
    @csrf

    <div class="mb-3">
        <label>Vehicle</label>
        <select name="vehicle_id" class="form-control">
            @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}">
                    {{ $vehicle->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Issue / Service</label>
        <input type="text" name="issue" class="form-control">
    </div>

    <div class="mb-3">
        <label>Date</label>
        <input type="date" name="service_date" class="form-control">
    </div>

    <div class="mb-3">
        <label>Cost</label>
        <input type="number" name="cost" class="form-control">
    </div>

    <button class="btn btn-dark">Save</button>

</form>

@endsection