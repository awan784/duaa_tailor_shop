<?php

namespace App\Http\Controllers;

use App\Models\StockSubCategory;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\StockCategory;
use App\Models\StockUnit;
use Carbon\Carbon;


class StockSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalData = StockSubCategory::latest()->get();
        return view('admin.stock_sub_category.index',compact('totalData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stockCategories = StockCategory::all(); // or use `->pluck('name', 'id')` if you need key-value pairs
        return view('admin.stock_sub_category.create', compact('stockCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        StockSubCategory::create($requestData);
        return redirect()->route('stock_sub_category.index');
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
        return view('admin.stock_sub_category.update',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $edit = StockSubCategory::find($id);
        $edit->update($requestData);
        return redirect()->route('stock_sub_category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stockCategory = StockSubCategory::find($id);
        $stockCategory->delete();
        return redirect()->route('stock_sub_category.index');
    }
}
