<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\SystemAccount;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_deleted', 0)->orderBy('created_at', 'desc')->get();
        
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');  
    }

    public function store(ProductFormRequest $request)
    {
        $validated = $request->validated();

        $owner_id = SystemAccount::first()->system_user;
 
        if ($request->assigned_user)
        {
            $user = User::where('email', $request->assigned_user)->first();
            if($user)
            {
                $is_private = 1;
                $owner_id = $user->id;
            }
            else
            {
                return redirect()->back()->with('failed', 'This user does not exist!');   
            }
        }
        else
        {
            $is_private = 0;
        }


        $is_published = Product::getIsPublishedBooleanNumber($request->is_published);


        $sku = Product::generateSKU('EG');

        $product = Product::create([
            'owner_id' => $owner_id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'sku' => $sku,
            'cost' => $validated['cost'],
            'break_even_price' => $validated['break_even_price'],
            'lowest_selling_price' => $validated['lowest_selling_price'],
            'is_published' => $is_published,
            'is_private' => $is_private,
        ]);

        if ($is_private == 1)
        {
            $user->products()->attach($product->id);
        }

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully!');
    }



    public function edit(Product $product) 
    {
        return view('admin.product.edit', compact('product'));   
    }

    public function update(ProductFormRequest $request, Product $product)
    {
        $validated = $request->validated();

        $is_published = Product::getIsPublishedBooleanNumber($request->is_published);

        Product::where('id',$product->id)->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'cost' => $validated['cost'],
            'break_even_price' => $validated['break_even_price'],
            'lowest_selling_price' => $validated['lowest_selling_price'],
            'is_published' => $is_published,
        ]);
        
        return redirect()->back()->with('success', 'Product updated successfully!');
    }


    public function destroy(Product $product)
    {
        Product::where('id',$product->id)->update([
            'is_deleted' => 1,
        ]);
        
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully!');
    }

    
}
