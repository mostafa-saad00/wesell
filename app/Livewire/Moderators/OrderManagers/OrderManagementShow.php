<?php

namespace App\Livewire\Moderators\OrderManagers;

use App\Models\MerchantWalletTransaction;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\OrderStatusHistory;
use App\Models\User;
use App\Models\UserWalletTransaction;
use App\Models\WalletTransactionType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]

class OrderManagementShow extends Component
{
    public $order;
    public $order_items = [];

    public $order_status;
    public $allowed_order_statuses = ['delivered', 'rejected_by_customer'];
    public $picked_up_status = 'picked_up';

    public $order_profit_type_name = 'ربح طلب';
    public $product_cost_type_name = 'تكلفة منتج';

    public $order_status_in_allowed_statuses = false;

    public $customer_name;
    public $customer_phone;
    public $customer_phone_2;
    public $customer_address;
    public $city;
    
    public $order_notes;
    
    public $shipping;
    public $sub_total;
    public $total;


    public function mount(Order $order)
    {
        $this->order = $order;
        $order_items = OrderItem::where('order_id', $order->id)->where('is_deleted', 0)->get();

        if (in_array($order->order_status_name, $this->allowed_order_statuses)) 
        {
            $this->order_status_in_allowed_statuses = true;
        }

        foreach($order_items as $item)
        {
            $this->order_items[] = [
                'productid' => $item->product->id,
                'productName' => $item->product->title,
                'quantity' => $item->quantity,
                'product_price' => $item->product_price,
                'total_price' => $item->total_price,
            ];

        }

        $this->customer_name = $order->shipping_name;
        $this->customer_phone = $order->shipping_phone;
        $this->customer_address = $order->shipping_address;
        $this->city = $order->shipping_city;

        $this->customer_phone_2 = $order->shipping_phone_2;
        $this->order_notes = $order->notes;

        $this->sub_total = $order->sub_total;
        $this->shipping = $order->shipping_price;
        $this->total = $order->total;
    }

    public function updateOrderStatus()
    {
        if (in_array($this->order_status, $this->allowed_order_statuses)) 
        {
            if($this->order_status == 'delivered')
            {
                $current_order = Order::where('id', $this->order->id)->first();

                $total_order_profit = 0;

                $order_profit_transaction_type = WalletTransactionType::where('name', $this->order_profit_type_name)->first();
                $product_cost_transaction_type = WalletTransactionType::where('name', $this->product_cost_type_name)->first();
                

                foreach($current_order->orderItems as $item)
                {
                    MerchantWalletTransaction::create([
                        'user_id' => $item->product->owner_id,
                        'product_id' => $item->product->id,
                        'wallet_transaction_type' => $product_cost_transaction_type->id,
                        'type_name' => $product_cost_transaction_type->name,
                        'quantity' => $item->quantity,
                        'product_cost' => $item->product->cost,
                        'total_earnings' => $item->quantity * $item->product->cost, 
                    ]);

                    $total_order_profit += ($item->product_price - $item->product->break_even_price) * $item->quantity;
  
                }

                UserWalletTransaction::create([
                    'user_id' => $this->order->user_id,
                    'wallet_transaction_type' => $order_profit_transaction_type->id,
                    'type_name' => $order_profit_transaction_type->name,
                    'amount' => $total_order_profit,
                ]);

                return redirect()->route('moderator.order_management.show', $this->order->id)->with('success', 'successss!');
            }


            


            return;






            $moderator = Auth::guard('admin')->user();

            $status = OrderStatus::where('name', $this->order_status)->where('is_deleted', 0)->first(); 

            $order = Order::where('id', $this->order->id)->update([
                'order_status_id' => $status->id,
                'order_status_name' => $status->name
            ]);

            OrderStatusHistory::create([
                'order_id' => $this->order->id,
                'order_status_id' => $status->id,
                'changed_by' => $moderator->id
            ]);


            return redirect()->route('moderator.order_management.show', $this->order->id)->with('success', 'Order Updated Successfully.');
        }
        else
        {
            return redirect()->route('moderator.order_management.show', $this->order->id)->with('custom_error', 'Please select order status correctly.');
        }
    }

    public function render()
    {
        return view('livewire.moderators.order-managers.order-management-show');
    }
}
