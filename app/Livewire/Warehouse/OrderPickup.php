<?php

namespace App\Livewire\Warehouse;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\OrderStatusHistory;
use App\Models\WarehouseStockMovement;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.app')]

class OrderPickup extends Component
{
    public $order;

    public $orderCode;

    public $order_items;

    public $order_not_found;


    public function searchOrder()
    {
        $order = Order::where('shipping_code', $this->orderCode)->where('order_status_name', 'shipped')->first();

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

    public function pick_up_the_order()
    {
        $picked_up_status = OrderStatus::where('name', 'picked_up')->first();

        $warehouse_admin = Auth::guard('admin')->user();

        OrderStatusHistory::create([
            'order_id' => $this->order->id,
            'order_status_id' => $picked_up_status->id,
            'changed_by' => $warehouse_admin->id,
        ]);

        Order::where('id', $this->order->id)->update([
            'order_status_id' => $picked_up_status->id,
            'order_status_name' => $picked_up_status->name,
        ]);


        $last_order_items_version = OrderItem::where('order_id', $this->order->id)
                        ->orderBy('version', 'desc')
                        ->first();

        $order_items = OrderItem::where('order_id', $this->order->id)->where('version', $last_order_items_version->version)->get();
 

        foreach($order_items as $item)
        {
            // adjust warehouse stock
            WarehouseStockMovement::adjustWarehouseStock($item->product->id, -$item->quantity, 'deduction' ,'pickup_order');     
        }

        
        



        session()->flash('success');
        $this->reset('order', 'orderCode');

    }


    public function render()
    {

        return view('livewire.warehouse.order-pickup');
    }   
}
