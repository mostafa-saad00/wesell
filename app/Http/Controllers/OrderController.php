<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\OrderStatusHistory;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function show(Order $order)
    {
        // Check if the order belongs to the user 
        $this->authorize('view', $order);

        $subTotal = 0;
        foreach($order->orderItems as $item)
        {
            $subTotal += $item->price;
        }

        return view('user.order.show', compact('order', 'subTotal'));
    }


    public function cancel(Order $order)
    {
        $this->authorize('view', $order);

        if($order->order_status_name != 'processing')
        {
            return redirect()->route('order.index')->with('custom_error', 'Can not cancel the order, please contact the support.');
        }

        $cancel_status = OrderStatus::where('name', 'cancelled')->first();
        $system_admin = Admin::where('name', 'System_Admin')->first();

        $order->order_status_name = $cancel_status->name;
        $order->save();

        OrderStatusHistory::create([
            'order_id' => $order->id,
            'order_status_id' => $cancel_status->id,
            'changed_by' => $system_admin->id
        ]);


        $last_order_items_version = OrderItem::where('order_id', $order->id)
                        ->orderBy('version', 'desc')
                        ->first();

        $order_items = $order->orderItems()->where('version', $last_order_items_version->version)->get();

        foreach($order_items as $item)
        {
            // adjust current stock in products table and add record to stock_movements table
            StockMovement::adjustStock($item->product->id, $item->quantity, 'addition' ,'cancel_order');   
        }

        return redirect()->route('order.index')->with('success', 'Order cancelled successfully.');
    }
}
