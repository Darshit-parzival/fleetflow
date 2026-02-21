@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Vehicle Registry</h3>
            <small class="text-muted">Manage fleet assets and status</small>
        </div>

        <a href="{{route('vehicles.create')}}" class="btn btn-dark rounded-3">
            + Add Vehicle
        </a>
    </div>

    <!-- Filter Bar -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-4">
                    <input type="text" class="form-control rounded-3" placeholder="Search by model or plate">
                </div>

                <div class="col-md-3">
                    <select class="form-select rounded-3">
                        <option>All Status</option>
                        <option>Available</option>
                        <option>On Trip</option>
                        <option>In Shop</option>
                        <option>Retired</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-select rounded-3">
                        <option>All Vehicle Types</option>
                        <option>Truck</option>
                        <option>Van</option>
                        <option>Bike</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-outline-dark w-100 rounded-3">
                        Filter
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Vehicle Table -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Model</th>
                        <th>License Plate</th>
                        <th>Type</th>
                        <th>Max Capacity (kg)</th>
                        <th>Odometer</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->id }}</td>
                        <td>{{ $vehicle->name }}</td>
                        <td>{{ $vehicle->license_plate }}</td>
                        <td>{{ $vehicle->type }}</td>
                        <td>{{ $vehicle->max_capacity }} kg</td>
                        <td>{{ $vehicle->odometer }} km</td>
                        <td>
                            <span class="badge 
                    {{ $vehicle->status == 'available' ? 'bg-success' : '' }}
                    {{ $vehicle->status == 'on_trip' ? 'bg-primary' : '' }}
                    {{ $vehicle->status == 'in_shop' ? 'bg-warning text-dark' : '' }}
                    {{ $vehicle->status == 'retired' ? 'bg-secondary' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                                class="btn btn-sm btn-outline-primary rounded-3">
                                Edit
                            </a>

                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}"
                                method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-sm btn-outline-danger rounded-3">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            No vehicles found.
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection