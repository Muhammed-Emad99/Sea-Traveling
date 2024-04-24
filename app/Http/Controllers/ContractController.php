<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractRequest;
use App\Models\Client;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        {

            $clients = Client::all();
            $query = Contract::query();

            $validated_data = $request->validate([
                'client_id' => 'nullable|exists:clients,id',
                'start_date' => 'nullable|date|before_or_equal:end_date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
            ]);

            if ($request->filled('client_id') && !$request->filled('start_date') && !$request->filled('end_date')) {
                $query->whereHas('client', function ($query) use ($request) {
                    $query->where('id', 'like', '%' . $request->client_id . '%');
                });
            }

            elseif ($request->filled('start_date') && !$request->filled('end_date') && !$request->filled('client_id')){
                $start_date = $request->start_date;
                $query->where('start_date','>=', $start_date);
            }

            elseif ($request->filled('end_date') && !$request->filled('start_date') && !$request->filled('client_id')){
                $end_date = $request->end_date ;
                $query->where('end_date','<=', $end_date);
            }

            elseif ($request->filled('client_id') && $request->filled('start_date') && !$request->filled('end_date')){
                $start_date = $request->start_date ;
                $query->whereHas('client', function ($query) use ($request,$start_date) {
                    $query->where('id', 'like', '%' . $request->client_id . '%')->where('start_date', '>=', $start_date);
                });
            }

            elseif ($request->filled('client_id') && $request->filled('end_date') && !$request->filled('start_date')){
                $end_date = $request->end_date ;
                $query->whereHas('client', function ($query) use ($request,$end_date) {
                    $query->where('id', 'like', '%' . $request->client_id . '%')->where('end_date', '<=',$end_date);
                });
            }

            elseif($request->filled('start_date') && $request->filled('end_date') && !$request->filled('client_id')) {
                $start_date = $request->start_date;
                $end_date = $request->end_date ;
                $query->where('start_date', '>=', $start_date)->where('end_date', '<=', $end_date);
            }
            elseif ($request->filled('client_id') && $request->filled('start_date') && $request->filled('end_date')){
                $start_date = $request->start_date;
                $end_date = $request->end_date ;
                $query->whereHas('client', function ($query) use ($request,$start_date,$end_date) {
                    $query->where('id', 'like', '%' . $request->client_id . '%')->where('start_date', '>=', $start_date)->where('end_date', '<=', $end_date);
                });
            }
            else{
                $contracts = Contract::with('client', 'trips')->get();
            }

            $contracts = $query->with('client', 'trips')->get();

            return view('contracts.index', compact('contracts', 'clients'));

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public
    function store(ContractRequest $request)
    {
        Contract::create($request->all());

        return redirect()->route('contracts.index')->with('success', 'Contract created successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public
    function create()
    {
        $clients = Client::all();
        return view('contracts.create', compact('clients'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(string $id)
    {
        $contract = Contract::findOrFail($id);
        $clients = Client::all();
        return view('contracts.edit', compact('contract', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, string $id)
    {
        $contract = Contract::findOrFail($id);
        $contract->update([
            'client_id' => $request->client_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'trips_count' => $request->trips_count,
        ]);

        return redirect()->route('contracts.index')->with('success', 'Contract updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(string $id)
    {
        $contract = Contract::findOrFail($id);
        $contract->delete();
        return redirect()->route('contracts.index')->with('success', 'Contract deleted successfully.');
    }
}
