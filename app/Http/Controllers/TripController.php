<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::with('contract')->get();
        return view('trips.index', compact('trips'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $contract = Contract::where('id', $request->contract_id)->first();
        if (!$contract) {
            $validated_data = $request->validate([
                'contract_id' => 'required|exists:contracts,id',
            ]);

        } else {
            $validated_data = $request->validate([
                'contract_id' => 'required|exists:contracts,id',
                'trip_date' => 'required|date|after_or_equal:' . $contract->start_date . '|before_or_equal:' . $contract->end_date
            ]);
            if ($contract->trips_done_count < $contract->trips_count) {
                $contract->trips_done_count = $contract->trips_done_count + 1;
                $contract->save();
                Trip::create($validated_data);
                return redirect()->route('trips.index')->with('success', 'Trip created successfully.');

            } else {
                return redirect()->route('trips.index')->with('fail', 'This contract completed');
            }
        }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contracts = Contract::all();
        return view('trips.create', compact('contracts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $trip = Trip::findOrFail($id);
        $contracts = Contract::all();
        return view('trips.edit', compact('trip', 'contracts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $trip = Trip::findOrFail($id);
        $contract = Contract::where('id', $request->contract_id)->first();
        if (!$contract) {
            $validated_data = $request->validate([
                'contract_id' => 'required|exists:contracts,id',
            ]);

        } else {
            $validated_data = $request->validate([
                'contract_id' => 'required|exists:contracts,id',
                'trip_date' => 'required|date|after_or_equal:' . $contract->start_date . '|before_or_equal:' . $contract->end_date
            ]);
            if ($contract->trips_done_count < $contract->trips_count) {
                $contract->trips_done_count = $contract->trips_done_count + 1;
                $contract->save();
                $trip->update($validated_data);
                return redirect()->route('trips.index')->with('success', 'Trip created successfully.');

            } else {
                return redirect()->route('trips.index')->with('fail', 'This contract completed');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trip = Trip::findOrFail($id);
        $contract = Contract::where('id', $trip->contract_id)->first();

        if ($contract->trips_done_count >= 0) {
            $contract->trips_done_count = $contract->trips_done_count - 1;
            $contract->save();
            $trip->delete();
            return redirect()->route('trips.index')->with('success', 'Trip deleted successfully.');
        } else {
            return redirect()->route('trips.index')->with('fail', 'This contract completed');
        }
    }
}
