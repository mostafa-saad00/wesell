<?php

namespace App\Livewire\Users;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]

class ProductIndex extends Component
{
    public function render()
    {    
        $products = Product::all();

        return view('livewire.users.product-index', ['products' => $products]);
    }
}
