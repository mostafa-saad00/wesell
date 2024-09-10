<?php

namespace App\Livewire\Users;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


#[Layout('layouts.app')]

class OrderIndex extends Component
{
    use WithPagination;

    public $searchTerm;
    public $status;

    public function filterOrders()
    {
        // do nothing then render the component
    }

    
    public function render()
    {
        $current_user = Auth::user();
        $order_statuses = DB::table('order_statuses')->get();

        $searchTerm = $this->searchTerm;

        $orders = Order::where('user_id', $current_user->id)
               ->where(function($query) use ($searchTerm) {
                   $query->where('shipping_name', 'LIKE', '%' . $searchTerm . '%')
                         ->orWhere('shipping_phone', 'LIKE', '%' . $searchTerm . '%');
                         
               })
               ->orderBy('created_at', 'desc')
               ->paginate(15);

               
        if ($this->status ) 
        {
            $orders = Order::where('user_id', $current_user->id)
               ->where(function($query) use ($searchTerm) {
                   $query->where('shipping_name', 'LIKE', '%' . $searchTerm . '%')
                         ->orWhere('shipping_phone', 'LIKE', '%' . $searchTerm . '%');
                         
               })
               ->where('order_status_name', $this->status)
               ->paginate(15);

        }

    


        return view('livewire.users.order-index', ['orders' => $orders, 'order_statuses' => $order_statuses]);
    }


    
}
