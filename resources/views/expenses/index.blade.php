@extends('layouts.app')

@section('content')

<h3 class="fw-bold mb-4">Trip Expenses</h3>

<a href="{{ route('expenses.create') }}"
    class="btn btn-dark mb-3">
    + Add Expense
</a>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">

        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Trip ID</th>
                    <th>Driver</th>
                    <th>Distance (km)</th>
                    <th>Fuel (₹)</th>
                    <th>Misc (₹)</th>
                    <th>Total (₹)</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($expenses as $expense)
                <tr>
                    <td>#{{ $expense->trip->id }}</td>
                    <td>{{ $expense->trip->driver->name ?? 'N/A' }}</td>
                    <td>{{ $expense->distance }}</td>
                    <td class="text-danger">₹{{ $expense->fuel_expense }}</td>
                    <td class="text-danger">₹{{ $expense->misc_expense }}</td>
                    <td class="fw-semibold">
                        ₹{{ $expense->fuel_expense + $expense->misc_expense }}
                    </td>
                    <td>
                        <span class="badge 
                                {{ $expense->status == 'pending' ? 'bg-warning text-dark' : 'bg-success' }}">
                            {{ ucfirst($expense->status) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('expenses.edit', $expense->id) }}"
                            class="btn btn-sm btn-outline-primary">
                            Update
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4">
                        No expenses found.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection