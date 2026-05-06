<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Ledger;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalData = Customer::latest()->get();
        return view('admin.customers.index',compact('totalData'));
    }

    public function GetLedger($id)
    {
        $customer = Customer::find($id);
        return view('admin.customers.ledger.index',compact('customer'));
    }

    public function LedgerAdd(Request $request, $id)
    {
        Ledger::create([
            "amount" => $request->amount,
            "transaction_type" => $request->transaction_type,
            "customer_id" => $id,
            "detail" => "cash payment"
        ]);
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $customer = Customer::create($requestData);
        return redirect()->route('customers.index');
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
        $edit = Customer::find($id);
        return view('admin.customers.update',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $edit = Customer::find($id);
        $edit->update($requestData);
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customers.index');
    }

    
    public function save(Request $request)
    {
        $requestData = $request->all();
        $customer = Customer::create($requestData);
        return response()->json([
            'success' => true,
            'customer' => $customer,
        ]);
    }
}
