<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockCategory;
use App\Models\StockSubCategory;
use App\Models\StockUnit;
use Carbon\Carbon;
use App\Models\Assets;
use App\Models\AssetsUsed;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    
    public function index()
    {
        $totalData = Assets::latest()->get();
        return view('admin.assets_sep.index',compact('totalData'));
    }
 
  

  public function create()
  {
    return view('admin.assets_sep.create');
  }
  
  public function store(Request $request)
{
    Assets::create($request->all());
    return redirect()->route('assets.index')
                     ->with('success', 'Asset added successfully!');
}
  
  public function destroy($id)
{

    $asset = Assets::findOrFail($id);


    $asset->delete();

    // Redirect back with success message
    return redirect()->route('assets.index')
                     ->with('success', 'Asset deleted successfully!');
}
  
  public function createUsedAssets(){
    
    $assets = Assets::all();
    return view('admin.assets_sep.assets_used', compact('assets'));
    
  }
  
public function storeUsedAssets(Request $request)
{
    // Find asset
    $asset = Assets::find($request->assets_id);


    // Save into assets_used table
    AssetsUsed::create([
        'assets_id' => $request->assets_id,
        'qty'       => $request->qty,
        'used_date' => $request->used_date,
    ]);

    // Update assets table qty (subtract used qty)
    if ($asset) {
        $asset->qty = $asset->qty - $request->qty;
        $asset->save();
    }

    return redirect()->back()->with('success', 'Asset usage recorded successfully.');
}
  
  public function reportUsedAssets(Request $request){
    
    $startDate = $request->query('started_date');
    $endDate   = $request->query('ended_date');
    
        if ($startDate && $endDate) {
          
          $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate   = Carbon::parse($endDate)->endOfDay();

$totalData = AssetsUsed::with('assets')
    ->whereDate('used_date', '>=', $startDate)
    ->whereDate('used_date', '<=', $endDate)
    ->latest()
    ->get();


        return view('admin.assets_sep.assets_used_report', compact('totalData'));
          
        }
    else{
      
      return view('admin.assets_sep.assets_used_report');
    }
    


    
  }
  
  public function ReportPrint(Request $request)
{
    $startDate = $request->query('started_date');
    $endDate   = $request->query('ended_date');

    if ($startDate && $endDate) {
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate   = Carbon::parse($endDate)->endOfDay();

        // Fetch from assets_used table with relation to assets
     $totalData = AssetsUsed::with('assets')
    ->whereDate('used_date', '>=', $startDate)
    ->whereDate('used_date', '<=', $endDate)
    ->latest()
    ->get();

        return view('admin.assets_sep.assets_used_report_print', compact('totalData'));
    } else {
        return "<script>window.close();</script>";
    }
  }


  
  
  
}
