<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockMovementFormRequest;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\WarehouseStockMovement;
use Illuminate\Http\Request;

class AdminStockMovementController extends Controller
{

    public function index(Product $product)
    {
        $stock_movements = StockMovement::where('product_id', $product->id)->orderBy('created_at', 'desc')->get();

        return view('admin.stock.index', compact('stock_movements', 'product'));
    }

    public function store(StockMovementFormRequest $request, Product $product)
    {
        $validated = $request->validated();

        // publish the product if it is the first time to add stock to it
        if (!StockMovement::where('product_id', $product->id)->first())
        {
            Product::where('id', $product->id)
            ->update(['is_published' => 1]);
        }

        StockMovement::create([
            'product_id' => $product->id,
            'quantity_change' => $request->quantity,
            'type' => 'addition',
            'source' => 'manual adjustment',
        ]);

        $currentStock = StockMovement::where('product_id', $product->id)
        ->sum('quantity_change');

        

        WarehouseStockMovement::create([
            'product_id' => $product->id,
            'quantity_change' => $request->quantity,
            'type' => 'addition',
            'source' => 'manual adjustment',
        ]);

        $warehouseCurrentStock = WarehouseStockMovement::where('product_id', $product->id)
            ->sum('quantity_change');
        

        Product::where('id', $product->id)->update([
            'current_stock' => $currentStock,
            'warehouse_stock' => $warehouseCurrentStock,
        ]);



        return redirect()->back()->with('success', 'Stock updated successfully!');
    }


    public function storeXXX($productId, $quantityChange, $type, $source)
    {
        StockMovement::create([
            'product_id' => $productId,
            'quantity_change' => $quantityChange,
            'type' => $type,
            'source' => $source,
        ]);

        $currentStock = StockMovement::where('product_id', $productId)
            ->sum('quantity_change');

        Product::where('id', $productId)
        ->update(['current_stock' => $currentStock]);

        return "Stock Movement Created";

    }
}
