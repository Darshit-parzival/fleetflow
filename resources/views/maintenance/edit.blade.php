@extends('layouts.app')

@section('content')

<h3 class="fw-bold mb-4">Update Maintenance</h3>

<form method="POST" action="{{ route('maintenance.update', $maintenance->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="scheduled" {{ $maintenance->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
            <option value="in_progress" {{ $maintenance->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ $maintenance->status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>

    <button class="btn btn-dark">Update</button>

</form>

@endsection