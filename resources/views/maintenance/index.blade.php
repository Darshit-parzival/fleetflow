@extends('layouts.app')

@section('content')

<h3 class="fw-bold mb-4">Maintenance Logs</h3>

<a href="{{ route('maintenance.create') }}" 
   class="btn btn-dark mb-3">
    + Create New Service
</a>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">

        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Log ID</th>
                    <th>Vehicle</th>
                    <th>Issue / Service</th>
                    <th>Date</th>
                    <th>Cost (₹)</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($maintenances as $log)
                    <tr>
                        <td>#{{ $log->id }}</td>
                        <td>{{ $log->vehicle->name }}</td>
                        <td>{{ $log->issue }}</td>
                        <td>{{ $log->service_date }}</td>
                        <td class="fw-semibold text-danger">
                            ₹{{ $log->cost }}
                        </td>
                        <td>
                            <span class="badge 
                                {{ $log->status == 'scheduled' ? 'bg-secondary' : '' }}
                                {{ $log->status == 'in_progress' ? 'bg-warning text-dark' : '' }}
                                {{ $log->status == 'completed' ? 'bg-success' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $log->status)) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('maintenance.edit', $log->id) }}" 
                               class="btn btn-sm btn-outline-primary">
                                Update
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            No maintenance records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection