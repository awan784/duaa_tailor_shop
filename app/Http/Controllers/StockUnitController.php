<?php

namespace App\Http\Controllers;

use App\Models\StockUnit;
use Illuminate\Http\Request;

class StockUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalData = StockUnit::latest()->get();
        return view('admin.stock_unit.index',compact('totalData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stock_unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        StockUnit::create($requestData);
        return redirect()->route('stock_unit.index');
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
        $edit = StockUnit::find($id);
        return view('admin.stock_unit.update',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $edit = StockUnit::find($id);
        $edit->update($requestData);
        return redirect()->route('stock_unit.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stockCategory = StockUnit::find($id);
        $stockCategory->delete();
        return redirect()->route('stock_unit.index');
    }
}
