<?php

namespace App\Livewire\Warehouse;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.app')]

class ProductIndex extends Component
{
    public $searchTerm;

    public function filterProducts()
    {
        // do nothing then render the component...
    }


    public function render()
    {
        $products = Product::where('is_published', true)
                            ->where('is_deleted', false)
                            ->when($this->searchTerm !== '*' && $this->searchTerm !== null, function ($query) {
                                return $query->where('products.title', 'LIKE', '%' . $this->searchTerm . '%')
                                        ->orWhere('products.sku', 'LIKE', '%' . $this->searchTerm . '%');

                            })
                            ->orderBy('warehouse_stock')
                            ->paginate(15);

        return view('livewire.warehouse.product-index', ['products' => $products]);
    }
}
