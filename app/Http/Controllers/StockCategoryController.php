<?php

namespace App\Http\Controllers;

use App\Models\StockCategory;
use Illuminate\Http\Request;

class StockCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalData = StockCategory::latest()->get();
        return view('admin.stock_category.index',compact('totalData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stock_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        StockCategory::create($requestData);
        return redirect()->route('stock_category.index');
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
        $edit = StockCategory::find($id);
        return view('admin.stock_category.update',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $edit = StockCategory::find($id);
        $edit->update($requestData);
        return redirect()->route('stock_category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stockCategory = StockCategory::find($id);
        $stockCategory->delete();
        return redirect()->route('stock_category.index');
    }
}
