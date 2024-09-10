<?php

namespace App\Livewire\Users;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]

class MarketplaceIndex extends Component
{
    use WithPagination;

    public $user_products_ids = [];

    public $searchTerm;

    public $records = 15;
    
    public $sorting = 'created_at';
    
    public $quantity = 0;
    


    public function mount()
    {
        $current_user = Auth::user();

        foreach ($current_user->products as $product)
        {
            $this->user_products_ids[] = $product->id;
        }
    
        
    }

    public function updatedSorting($value)
    {
        if($value == 'created_at')
        {
            $this->sorting = 'created_at';
        }
        elseif($value == 'updated_at')
        {
            $this->sorting = 'updated_at';
        }
        elseif($value == 'lowest_selling_price')
        {
            $this->sorting = 'lowest_selling_price';
        }
        else
        {
            $this->sorting = 'created_at';
        }
    }

    public function updatedQuantity($value)
    {
        if($value == 0)
        {
            $this->quantity = 0;
        }
        elseif($value == 50)
        {
            $this->quantity = 50;
        }
        elseif($value == 100)
        {
            $this->quantity = 100;
        }
        elseif($value == 200)
        {
            $this->quantity = 200;
        }
        elseif($value == 500)
        {
            $this->quantity = 500;
        }
        else
        {
            $this->quantity = 0;
        }
    }

    public function updatedRecords($value)
    {
        if($value == 15)
        {
            $this->records = 15;
        }
        elseif($value == 30)
        {
            $this->records = 30;
        }
        elseif($value == 50)
        {
            $this->records = 50;
        }
        elseif($value == 100)
        {
            $this->records = 100;
        }
        else
        {
            $this->records = 15;
        }
    }

    public function filterMarketplace()
    {
        // do nothing then render the component
    }


    public function render()
    {
        $searchTerm = $this->searchTerm;


        $public_products = Product::where('is_deleted', 0)
            ->where('is_published', 1)
            ->where('is_private', 0)
            ->where('current_stock', '>', $this->quantity)
            ->whereNotIn('id', $this->user_products_ids)
            ->where(function($query) use ($searchTerm) {
                $query->where('title', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('sku', 'LIKE', '%' . $searchTerm . '%');

            })
            ->orderBy($this->sorting , 'desc')
            ->paginate($this->records);

    
        return view('livewire.users.marketplace-index', ['public_products' => $public_products]);
    }
}
