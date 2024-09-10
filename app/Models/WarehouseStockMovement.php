<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseStockMovement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function adjustWarehouseStock($productId, $quantityChange, $type, $source) 
    {
        WarehouseStockMovement::create([
            'product_id' => $productId,
            'quantity_change' => $quantityChange,
            'type' => $type,
            'source' => $source,
        ]);

        $warehouseCurrentStock = WarehouseStockMovement::where('product_id', $productId)
            ->sum('quantity_change');

        Product::where('id', $productId)
        ->update(['warehouse_stock' => $warehouseCurrentStock]);

        return "Stock Movement Created";
    }
}
