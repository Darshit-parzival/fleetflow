@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Driver Profiles</h3>
            <a href="{{ route('drivers.create') }}" class="btn btn-primary">
                + Add Driver
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>License</th>
                            <th>Expiry</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($drivers as $driver)
                            <tr>
                                <td>{{ $driver->name }}</td>
                                <td>{{ $driver->license_number }}</td>
                                <td>{{ $driver->license_expiry }}</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ ucfirst(str_replace('_', ' ', $driver->status)) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
