<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockCategory;
use App\Models\StockSubCategory;
use App\Models\StockUnit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalData = Stock::with(['category'])->where('expense', 0)->latest()->get();

        // Load subcategories for all stocks to avoid N+1 queries
        $subCategoryIds = $totalData->pluck('sub_category')->filter(function ($value) {
            return $value !== null && $value !== '';
        })->unique()->values();

        if ($subCategoryIds->isNotEmpty()) {
            $subCategories = StockSubCategory::whereIn('id', $subCategoryIds)->get()->keyBy('id');

            // Add subcategory name directly to each stock
            $totalData->each(function ($stock) use ($subCategories) {
                if ($stock->sub_category) {
                    $subCategoryId = is_numeric($stock->sub_category) ? (int)$stock->sub_category : $stock->sub_category;
                    if (isset($subCategories[$subCategoryId])) {
                        $stock->subcategory_name = $subCategories[$subCategoryId]->name;
                        $stock->subcategory = $subCategories[$subCategoryId];
                    }
                }
            });
        }

        return view('admin.stocks.index', compact('totalData'));
    }

    public function expense()
    {
        $totalData = Stock::where('expense', 1)->latest()->get();
        return view('admin.expense.index', compact('totalData'));
    }

    public function expenseCreate()
    {
        $categories = StockCategory::latest()->get();
        $units = StockUnit::latest()->get();
        $last = Stock::withTrashed()->latest()->first();
        if ($last) {
            // echo "sadasd";
            preg_match('/\d+/', $last->sku, $matches);
            $sku = "DC-" . ($matches[0] + 1);
        } else {
            $sku = "DC-1";
        }

        return view('admin.expense.create', compact('categories', 'units', 'sku'));
    }


    public function Report(Request $request)
    {
        $categories = StockCategory::latest()->get();
        $startDate  = $request->query('started_date');
        $endDate    = $request->query('ended_date');

        if (!($startDate && $endDate)) {
            return view('admin.report.stock', compact('categories'));
        }

        [$totalData, $totalPurchasePrice] = $this->buildStockReport($request);
        return view('admin.report.stock', compact('totalData', 'categories', 'totalPurchasePrice'));
    }

    private function buildStockReport(Request $request): array
    {
        $startDate = Carbon::parse($request->query('started_date'))->startOfDay();
        $endDate   = Carbon::parse($request->query('ended_date'))->endOfDay();
        $category  = $request->query('category');

        $query = Stock::with(['category', 'unit'])->whereBetween('created_at', [$startDate, $endDate]);
        if (!empty($category)) {
            $query->where('category_id', $category);
        }

        $totalData = $query->latest()->get();

        $totalPurchasePrice = $totalData->sum(function ($item) {
            $remaining = (float) $item->remaining_quantity();
            return $remaining * (float) $item->purchase_price;
        });

        return [$totalData, $totalPurchasePrice];
    }



    public function ReportPrint(Request $request)
    {
        $startDate = $request->query('started_date');
        $endDate   = $request->query('ended_date');

        if (!($startDate && $endDate)) {
            return "<script>window.close();</script>";
        }

        [$totalData, $totalPurchasePrice] = $this->buildStockReport($request);
        return view('admin.report.stock_report', compact('totalData', 'totalPurchasePrice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = StockCategory::latest()->get();
        $units = StockUnit::latest()->get();
        $last = Stock::withTrashed()->latest()->first();
        if ($last) {
            // echo "sadasd";
            preg_match('/\d+/', $last->sku, $matches);
            $sku = "DC-" . ($matches[0] + 1);
        } else {
            $sku = "DC-1";
        }
        return view('admin.stocks.create', compact('categories', 'units', 'sku'));
    }

    public function getSubCategories($categoryId)
    {
        $subcategories = StockSubCategory::where('cat_id', $categoryId)->get();
        return response()->json($subcategories);
    }


    public function getProducts($categoryId, $subCategoryId)
    {
        $products = Stock::where('category_id', $categoryId)
            ->where('sub_category', $subCategoryId)
            ->where('quantity', '>', 0) // optional: only show stock with quantity
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'sale_price' => $product->sale_price,
                    'remaining_quantity' => $product->remaining_quantity(),
                    'purchase_price' => $product->purchase_price,
                    'sku' => $product->sku
                ];
            });

        return response()->json($products);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'sku' => 'required|unique:stocks',
        ]);

        $requestData = $request->all();
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/images'), $filename); // Save directly to /public/uploads/images
                $images[] = 'uploads/images/' . $filename; // Save relative path
            }
        }
        $requestData['images'] = count($images) ? json_encode($images) : '';
        Stock::create($requestData);
        return back();

        // return redirect()->route('stocks.index');

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
        $edit = Stock::find($id);
        $categories = StockCategory::latest()->get();
        $units = StockUnit::latest()->get();
        $subcategories = StockSubCategory::where('cat_id', $edit->category_id)->get();

        return view('admin.stocks.update', compact('edit', 'categories', 'units', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $this->validate($request, [
            'sku' => 'required|unique:stocks,sku,' . $id,
        ]);
        $images = $request->input('already_images') ? json_decode($request->input('already_images')) : [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('uploads/images', 'public');
                $images[] = $path;
            }
        }
        $requestData['images'] = count($images) ? json_encode($images) : '';
        $edit = Stock::find($id);
        $edit->update($requestData);
        return redirect()->route('stocks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stocks = Stock::find($id);
        $stocks->delete();
        return redirect()->route('stocks.index');
    }
}
