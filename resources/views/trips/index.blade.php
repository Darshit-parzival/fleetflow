@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Trip Dispatcher</h3>
            <small class="text-muted">Manage and assign fleet trips</small>
        </div>

        <a href="{{ route('trips.create') }}" class="btn btn-dark rounded-3">
            + Create Trip
        </a>
    </div>

    <!-- Trips Table -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Vehicle</th>
                        <th>Driver</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Cargo (kg)</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($trips as $trip)
                        <tr>
                            <td>{{ $trip->id }}</td>
                            <td>{{ $trip->vehicle->name ?? 'N/A' }}</td>
                            <td>{{ $trip->driver->name ?? 'N/A' }}</td>
                            <td>{{ $trip->origin }}</td>
                            <td>{{ $trip->destination }}</td>
                            <td>{{ $trip->cargo_weight }} kg</td>
                            <td>
                                <span class="badge 
                                    {{ $trip->status == 'draft' ? 'bg-secondary' : '' }}
                                    {{ $trip->status == 'dispatched' ? 'bg-primary' : '' }}
                                    {{ $trip->status == 'completed' ? 'bg-success' : '' }}
                                    {{ $trip->status == 'cancelled' ? 'bg-danger' : '' }}">
                                    {{ ucfirst($trip->status) }}
                                </span>
                            </td>
                            <td class="text-end">

                                <a href="{{ route('trips.show', $trip->id) }}" 
                                   class="btn btn-sm btn-outline-secondary rounded-3">
                                    View
                                </a>

                                @if($trip->status == 'dispatched')
                                    <a href="#" 
                                       class="btn btn-sm btn-outline-success rounded-3">
                                        Complete
                                    </a>
                                @endif

                                @if($trip->status != 'completed')
                                    <a href="#" 
                                       class="btn btn-sm btn-outline-danger rounded-3">
                                        Cancel
                                    </a>
                                @endif

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                No trips found.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection