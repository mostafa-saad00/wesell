<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $products = User::find($user->id)->products->where('is_deleted', 0)->sortByDesc('created_at');
        
        return view('user.product.index', compact('products'));
    }

    public function create()
    {
        return view('user.product.create');  
    }

    public function store(ProductFormRequest $request)
    {
        $validated = $request->validated();
        
        $sku = Product::generateSKU('EG');

        $user = $request->user();

        $product = Product::create([
            'owner_id' => $user->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'cost' => $validated['cost'],
            'break_even_price' => $validated['break_even_price'],
            'lowest_selling_price' => $validated['lowest_selling_price'],
            'sku' => $sku,
            'is_private' => 1,
        ]);

        

        $user->products()->attach($product->id);

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product) 
    {
        $isUserHaveAccessToProduct = Auth::user()->products->contains($product->id);

        if ($isUserHaveAccessToProduct)
        {
            return view('user.product.edit', compact('product'));
        } 
        else 
        {
            return back();    
        }         
    }

    public function update(ProductFormRequest $request, Product $product)
    {
        $validated = $request->validated();

        $isUserHaveAccessToProduct = Auth::user()->products->contains($product->id);

        if ($isUserHaveAccessToProduct)
        {
            Product::where('id',$product->id)->update([
                'title' => $validated['title'],
                'description' => $validated['description'],            
            ]);

            return redirect()->route('product.index')->with('success', 'Product updated successfully!');
        } 
        else 
        {
            return back();    
        }

        
    }

    public function destroy(Product $product)
    {
        $current_user = Auth::user();

        $product->users()->detach($current_user->id);
        
        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
}
