<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketplaceController extends Controller
{
    public function show(Product $product)
    {
        return view('user.marketplace.show', compact('product'));
    }

    public function start_selling(Product $product)
    {
        $current_user = Auth::user();
        
        $product->users()->attach($current_user->id);
        
        return redirect()->route('marketplace.index')->with('success', 'Product added successfully.');
    }
}
