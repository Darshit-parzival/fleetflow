@extends('layouts.app')

@section('content')


<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0">Driver Performance</h3>

    <a href="{{ route('drivers.create') }}"
        class="btn btn-dark rounded-3">
        + Add Driver
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">

        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>License</th>
                    <th>Expiry</th>
                    <th>Completion Rate</th>
                    <th>Safety Score</th>
                    <th>Complaints</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($drivers as $driver)
                <tr>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->license_number }}</td>

                    <td>
                        @if($driver->license_expiry && $driver->license_expiry < now())
                            <span class="badge bg-danger">
                            Expired
                            </span>
                            @else
                            {{ $driver->license_expiry }}
                            @endif
                    </td>

                    <td>
                        <span class="fw-semibold">
                            {{ $driver->completionRate() }}%
                        </span>
                    </td>

                    <td>
                        <span class="badge 
                                {{ $driver->safety_score >= 80 ? 'bg-success' : '' }}
                                {{ $driver->safety_score >= 60 && $driver->safety_score < 80 ? 'bg-warning text-dark' : '' }}
                                {{ $driver->safety_score < 60 ? 'bg-danger' : '' }}">
                            {{ $driver->safety_score }}
                        </span>
                    </td>

                    <td>
                        <span class="badge 
                                {{ $driver->complaints == 0 ? 'bg-success' : 'bg-danger' }}">
                            {{ $driver->complaints }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('drivers.edit', $driver->id) }}"
                            class="btn btn-sm btn-outline-primary">
                            Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">
                        No drivers found.
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>
</div>

@endsection