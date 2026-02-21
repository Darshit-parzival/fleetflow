@extends('layouts.app')

@section('content')

<h3 class="fw-bold mb-4">Update Expense</h3>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body">

        <form method="POST" action="{{ route('expenses.update', $expense->id) }}">
            @csrf
            @method('PUT')

            <!-- Trip Info (Read Only) -->
            <div class="mb-3">
                <label class="fw-semibold">Trip</label>
                <input type="text" 
                       class="form-control" 
                       value="Trip #{{ $expense->trip->id }} - {{ $expense->trip->driver->name ?? 'N/A' }}"
                       readonly>
            </div>

            <!-- Distance -->
            <div class="mb-3">
                <label>Distance (km)</label>
                <input type="number"
                       name="distance"
                       class="form-control"
                       value="{{ $expense->distance }}"
                       readonly>
            </div>

            <!-- Fuel Expense -->
            <div class="mb-3">
                <label>Fuel Expense (₹)</label>
                <input type="number"
                       name="fuel_expense"
                       class="form-control"
                       value="{{ $expense->fuel_expense }}"
                       readonly>
            </div>

            <!-- Misc Expense -->
            <div class="mb-3">
                <label>Misc Expense (₹)</label>
                <input type="number"
                       name="misc_expense"
                       class="form-control"
                       value="{{ $expense->misc_expense }}"
                       readonly>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="pending" 
                        {{ $expense->status == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="approved" 
                        {{ $expense->status == 'approved' ? 'selected' : '' }}>
                        Approved
                    </option>
                </select>
            </div>

            <!-- Total -->
            <div class="mb-3">
                <label class="fw-semibold">Total Expense</label>
                <input type="text"
                       class="form-control fw-bold"
                       value="₹{{ $expense->fuel_expense + $expense->misc_expense }}"
                       readonly>
            </div>

            <button class="btn btn-dark">
                Update Expense
            </button>

        </form>

    </div>
</div>

@endsection