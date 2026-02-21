<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripExpense;
use App\Models\Trip;

class TripExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = TripExpense::with('trip.driver')
            ->latest()
            ->get();

        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trips = Trip::with('driver')->get();
        return view('expenses.create', compact('trips'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'distance' => 'required|numeric|min:0',
            'fuel_expense' => 'required|numeric|min:0',
            'misc_expense' => 'required|numeric|min:0',
        ]);

        TripExpense::create([
            'trip_id' => $request->trip_id,
            'distance' => $request->distance,
            'fuel_expense' => $request->fuel_expense,
            'misc_expense' => $request->misc_expense,
            'status' => 'pending'
        ]);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = TripExpense::findOrFail($id);
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $expense = TripExpense::findOrFail($id);

        $expense->update([
            'status' => $request->status
        ]);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
