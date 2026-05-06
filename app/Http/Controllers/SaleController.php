<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\Tailor;
use App\Models\Stock;
use App\Models\Ledger;
use App\Models\StockCategory;
use App\Models\StockSubCategory;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalData = Sale::orderBy('id', 'desc')->get();

        // Manually load users if relationship doesn't work
        $userIds = $totalData->pluck('created_by')->filter()->unique();
        $users = \App\Models\User::whereIn('id', $userIds)->get()->keyBy('id');

        // Attach users to sales
        $totalData->each(function ($sale) use ($users) {
            if ($sale->created_by && isset($users[$sale->created_by])) {
                $sale->createdByUser = $users[$sale->created_by];
            }
        });

        return view('admin.sales.index', compact('totalData'));
    }


    public function print($id)
    {
        $sale = Sale::find($id);

        return view('admin.sales.print', compact('sale'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::latest()->get();
        $category = StockCategory::latest()->get();
        $stocks = Stock::where('expense', 0)->latest()->get();
        $expense = Stock::where('expense', 1)->latest()->get();
        $tailors = Tailor::latest()->get();
        $last = Sale::orderBy('id', 'desc')->first();
        if ($last) {
            preg_match('/\d+/', $last->bill_no, $matches);
            $bill_no = "DUAA-" . ($matches[0] + 1);
        } else {
            $bill_no = "DUAA-1000";
        }
        return view('admin.sales.create', compact('customers', 'tailors', 'stocks', 'bill_no', 'expense', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        // Ensure created_by is set to the authenticated user's ID
        $requestData['created_by'] = auth()->id();
        $sale = Sale::create($requestData);

        // Double-check: if created_by wasn't saved, set it explicitly
        if (!$sale->created_by && auth()->check()) {
            $sale->created_by = auth()->id();
            $sale->save();
        }
        // stock quantity - on sale
        $products = json_decode($requestData['products'], true);
        foreach ($products as $product) {
            $productId = $product['product_id'];
            $quantity = $product['quantity'];
            $stock = Stock::find($productId);
            if ($stock) {
                $stock->quantity -= $quantity;
                if ($stock->quantity < 0) {
                    $stock->quantity = 0;
                }
                $stock->save();
            }
        }
        if ($requestData['cash_received'] > 0) {
            Ledger::create([
                "sale_id" => $sale->id,
                "customer_id" => $sale->customer_id,
                "tailor_id" => $sale->tailor_id,
                "total_price" => $sale->net_total,
                "amount" => $requestData['cash_received'],
                "transaction_type" => "debit",
                "detail" => "sale order",
            ]);
        }
        session()->flash('print', true);
        session()->flash('print__link', route('sales.print', $sale->id));
        return redirect()->route('sales.index');
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
        $category = StockCategory::latest()->get();
        $customers = Customer::latest()->get();
        $stocks = Stock::where('expense', 0)->latest()->get();
        $expense = Stock::where('expense', 1)->latest()->get();
        $tailors = Tailor::latest()->get();
        $edit = Sale::find($id);

        return view('admin.sales.update', compact('category', 'customers', 'tailors', 'stocks', 'edit', 'expense'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $requestData = $request->all();

        $sale = Sale::find($id);

        // Decode the new products data from the request
        $newProducts = json_decode($requestData['products'], true);

        // Get existing products associated with the sale
        $existingProducts = $sale->products; // Assuming this is stored as JSON
        $existingProducts = json_decode($existingProducts, true) ?? [];
        $existingProducts = collect($existingProducts);

        // Create arrays for easy comparison
        $existingProductsById = $existingProducts->keyBy('product_id');
        $newProductsById = collect($newProducts)->keyBy('product_id');

        // ✅ Preserve SKU for existing products if not passed from frontend
        foreach ($newProducts as &$newProduct) {
            $productId = $newProduct['product_id'];
            if (isset($existingProductsById[$productId])) {
                if (empty($newProduct['sku'])) {
                    $newProduct['sku'] = $existingProductsById[$productId]['sku'] ?? null;
                }
            }
        }
        unset($newProduct); // good practice to avoid reference issues later

        // Handle existing products that are still in the sale
        foreach ($existingProductsById as $productId => $existingProduct) {
            if (isset($newProductsById[$productId])) {
                // Product exists in both old and new data
                $existingQuantity = $existingProduct['quantity'];
                $newQuantity = $newProductsById[$productId]['quantity'];

                if ($existingQuantity != $newQuantity) {
                    $stock = Stock::find($productId);
                    if ($stock) {
                        $quantityDifference = $newQuantity - $existingQuantity;

                        if ($quantityDifference > 0) {
                            $stock->quantity -= $quantityDifference; // Sale quantity increased
                        } elseif ($quantityDifference < 0) {
                            $stock->quantity += abs($quantityDifference); // Sale quantity decreased
                        }

                        if ($stock->quantity < 0) {
                            $stock->quantity = 0;
                        }

                        $stock->save();
                    }
                }
            } else {
                // Product was removed from the sale, add back to stock
                $stock = Stock::find($productId);
                if ($stock) {
                    $stock->quantity += $existingProduct['quantity'];
                    $stock->save();
                }
            }
        }

        // Handle products that are newly added to the sale
        foreach ($newProductsById as $productId => $newProduct) {
            if (!isset($existingProductsById[$productId])) {
                $stock = Stock::find($productId);
                if ($stock) {
                    $stock->quantity -= $newProduct['quantity'];
                    if ($stock->quantity < 0) {
                        $stock->quantity = 0;
                    }
                    $stock->save();
                }
            }
        }

        // ✅ Save updated products with preserved SKUs
        $requestData['products'] = json_encode($newProducts);

        $sale->update($requestData);

        return redirect()->route('sales.index');
    }

    public function updateOld(Request $request, $id)
    {
        $requestData = $request->all();

        $sale = Sale::find($id);
        // Decode the new products data from the request
        $newProducts = json_decode($requestData['products'], true);

        // Get existing products associated with the sale
        $existingProducts = $sale->products; // Assuming this relationship/method gives you the associated products
        // Decode the JSON data into a PHP array
        $existingProducts = json_decode($existingProducts, true);
        // Convert the array to a Laravel Collection
        $existingProducts = collect($existingProducts);

        // Create arrays for easy comparison
        $existingProductsById = $existingProducts->keyBy('product_id');
        $newProductsById = collect($newProducts)->keyBy('product_id');

        // Handle existing products that are still in the sale
        foreach ($existingProductsById as $productId => $existingProduct) {
            if (isset($newProductsById[$productId])) {
                // Product exists in both old and new data
                $existingQuantity = $existingProduct['quantity'];
                $newQuantity = $newProductsById[$productId]['quantity'];

                if ($existingQuantity != $newQuantity) {
                    // Find the stock record by product ID
                    $stock = Stock::find($productId);

                    if ($stock) {
                        // Calculate the quantity difference
                        $quantityDifference = $newQuantity - $existingQuantity;

                        // Update stock based on the difference
                        if ($quantityDifference > 0) {
                            // Sale quantity increased, reduce stock
                            $stock->quantity -= $quantityDifference;
                        } elseif ($quantityDifference < 0) {
                            // Sale quantity decreased, increase stock
                            $stock->quantity += abs($quantityDifference);
                        }

                        // Ensure stock quantity does not go below zero
                        if ($stock->quantity < 0) {
                            $stock->quantity = 0;
                        }

                        // Save the updated stock record
                        $stock->save();
                    }
                }
            } else {
                // Product was removed from the sale, add back to stock
                $stock = Stock::find($productId);
                if ($stock) {
                    $stock->quantity += $existingProduct['quantity'];
                    $stock->save();
                }
            }
        }

        // Handle products that are newly added to the sale
        foreach ($newProductsById as $productId => $newProduct) {
            if (!isset($existingProductsById[$productId])) {
                // This product is newly added to the sale
                $stock = Stock::find($productId);

                if ($stock) {
                    // Reduce stock by the quantity of the new product
                    $stock->quantity -= $newProduct['quantity'];
                    // Ensure stock quantity does not go below zero
                    if ($stock->quantity < 0) {
                        $stock->quantity = 0;
                    }
                    $stock->save();
                }
            }
        }
        $sale->update($requestData);
        return redirect()->route('sales.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $sale = Sale::findOrFail($id);
            $sale->delete();

            return redirect()->route('sales.index')  // redirect to sales list
                ->with('success', 'Sale deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('sales.index')
                ->with('error', 'Error deleting sale: ' . $e->getMessage());
        }
    }

    public function Get($id)
    {
        $sale = Sale::find($id);
        $sale->ledgerAmount = $sale->ledgerAmount();
        return response()->json([
            'success' => true,
            'data' => $sale,
        ]);
    }
    public function SaleStatusChange(Request $request)
    {
        $sale = Sale::find($request->saleId);
        if ($sale) {
            $sale->update([
                "status" => $request->status ?? "Completed",
            ]);
            // Only create ledger entry if status is being changed to Completed and cash_received is provided
            if ($request->status == 'Completed' && isset($request->cash_received) && $request->cash_received > 0) {
                Ledger::create([
                    "sale_id" => $sale->id,
                    "customer_id" => $sale->customer_id,
                    "total_price" => $sale->net_total,
                    "amount" => $request->cash_received,
                    "transaction_type" => "debit",
                    "detail" => "sale order",
                ]);
            }
        }
        return redirect()->route('sales.index');
    }


    public function uploadImages($id)
    {
        $sale = Sale::findOrFail($id);
        return view('admin.sales.upload', compact('sale'));
    }

    public function storeUploadedImages(Request $request)
    {
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $sale = Sale::findOrFail($request->sale_id);

        // Decode existing images from JSON (if any)
        $existingImages = $sale->images ? json_decode($sale->images, true) : [];
        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Save in public/uploads/images/
                $file->move(public_path('uploads/images'), $filename);

                // Store relative path
                $images[] = 'uploads/images/' . $filename;
            }
        }

        // Merge new images with old ones
        $allImages = array_merge($existingImages, $images);

        // Save to DB as JSON
        $sale->images = json_encode($allImages);
        $sale->save();

        return redirect()->back()->with('success', 'Images uploaded successfully!');
    }


    public function uploadImagesOld(Request $request)
    {
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'images.*' => 'required',
        ]);

        $sale = Sale::findOrFail($request->sale_id);


        // If column already has images, decode them
        $existingImages = $sale->images ? json_decode($sale->images, true) : [];

        // Upload new images
        foreach ($request->file('images') as $image) {
            $path = $image->store('sales_images', 'public');
            $existingImages[] = $path;
        }

        // Save JSON back to column
        $sale->images = json_encode($existingImages);
        $sale->save();

        return response()->json([
            'message' => 'Images uploaded successfully!',
            'images'  => $existingImages
        ]);
    }
}
