<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function adjustStock($productId, $quantityChange, $type, $source) 
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
