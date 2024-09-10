<?php

namespace App\Livewire\Warehouse;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\OrderStatusHistory;
use App\Models\StockMovement;
use App\Models\WarehouseStockMovement;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.app')]

class OrderReturn extends Component
{
    public $order;

    public $orderCode;

    public $order_items;

    public $order_not_found;

    public $allowed_statuses_ids = [];

    public function mount()
    {
        $allowed_statuses = OrderStatus::where('name', 'picked_up')
                                        ->orWhere('name', 'rejected_by_customer')
                                        ->orWhere('name', 'waiting_for_returned')
                                        ->get();

        foreach($allowed_statuses as $status)   
        {
            $this->allowed_statuses_ids[] = $status->id;
        }                            

    }


    public function searchOrder()
    {
        $order = Order::where('shipping_code', $this->orderCode)->whereIn('order_status_id', $this->allowed_statuses_ids)->first();

        if ($order)
        {
            $order_items = OrderItem::where('order_id', $order->id)->where('is_deleted', 0)->get();

            $this->order = $order;
            $this->order_items = $order_items;

            $this->order_not_found = false;
        }
        else
        {
            $this->order_not_found = true;
            $this->reset('order');
        }

        
    }

    public function updatedOrderCode()
    {
        $this->order_not_found = false;
    }


    public function return_order()
    {
        $returned_status = OrderStatus::where('name', 'returned_to_warehouse')->first();

        $warehouse_admin = Auth::guard('admin')->user();

        OrderStatusHistory::create([
            'order_id' => $this->order->id,
            'order_status_id' => $returned_status->id,
            'changed_by' => $warehouse_admin->id,
        ]);

        Order::where('id', $this->order->id)->update([
            'order_status_id' => $returned_status->id,
            'order_status_name' => $returned_status->name,
        ]);


        $last_order_items_version = OrderItem::where('order_id', $this->order->id)
        ->orderBy('version', 'desc')
        ->first();

        $order_items = OrderItem::where('order_id', $this->order->id)->where('version', $last_order_items_version->version)->get();

        foreach($order_items as $item)
        {
            // adjust stock
            StockMovement::adjustStock($item->product->id, $item->quantity, 'addition' ,'return_order');

            // adjust warehouse stock
            WarehouseStockMovement::adjustWarehouseStock($item->product->id, $item->quantity, 'addition' ,'return_order');     

        }

 
        session()->flash('success');
        $this->reset('order', 'orderCode');

    }


    public function render()
    {
        return view('livewire.warehouse.order-return');
    }
}
