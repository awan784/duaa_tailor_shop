<?php

namespace App\Http\Controllers;

use App\Models\Tailor;
use App\Models\Ledger;
use Illuminate\Http\Request;

class TailorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalData = Tailor::latest()->get();
        return view('admin.tailors.index',compact('totalData'));
    }

    public function GetLedger($id)
    {
        $tailor = Tailor::find($id);
        return view('admin.tailors.ledger.index',compact('tailor'));
    }

    public function LedgerAdd(Request $request, $id)
    {
        Ledger::create([
            "amount" => $request->amount,
            "transaction_type" => $request->transaction_type,
            "customer_id" => $id,
            "customer_type" => 'Tailor',
            "detail" => "cash payment"
        ]);
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tailors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        Tailor::create($requestData);
        return redirect()->route('tailors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Tailor::find($id);
        return view('admin.tailors.update',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $edit = Tailor::find($id);
        $edit->update($requestData);
        return redirect()->route('tailors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tailor = Tailor::find($id);
        $tailor->delete();
        return redirect()->route('tailors.index');
    }

    public function save(Request $request)
    {
        $requestData = $request->all();
        $tailor = Tailor::create($requestData);
        return response()->json([
            'success' => true,
            'tailor' => $tailor,
        ]);
    }
}
