<?php

namespace App\Livewire\Moderators;

use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\OrderStatusHistory;
use App\Models\ShippingCarrier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]

class OrderShippingUpload extends Component
{
    public $order_items = [];

    public $moderator_order;

    public $shipping_code;
    public $shipping_carriers;
    public $selected_shipping_carrier_id;
    
    
    public $customer_name;
    public $customer_phone;
    public $customer_phone_2;
    public $customer_address;
    public $city;
    
    public $order_notes;
    
    public $shipping;
    public $sub_total;
    public $total;

    public $order_id;


    public function mount()
    {
        $moderator = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        $moderator_order = $moderator->orders()->where('order_status_name', 'confirmed')->orderBy('created_at')->first();

        if ($moderator_order)
        {
            $this->order_id = $moderator_order->id;

            $order_items = OrderItem::where('order_id', $moderator_order->id)->where('is_deleted', 0)->get();
 
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

            $this->moderator_order = $moderator_order;

            $this->customer_name = $moderator_order->shipping_name;
            $this->customer_phone = $moderator_order->shipping_phone;
            $this->customer_address = $moderator_order->shipping_address;
            $this->city = $moderator_order->shipping_city;

            $this->customer_phone_2 = $moderator_order->shipping_phone_2;
            $this->order_notes = $moderator_order->notes;

            $this->sub_total = $moderator_order->sub_total;
            $this->shipping = $moderator_order->shipping_price;
            $this->total = $moderator_order->total;

            $this->shipping_carriers = ShippingCarrier::all();
        }
        else
        {
            $this->moderator_order = null;
        }
    }

    public function orderUploaded()
    {
        $validator = Validator::make(
            [
                'shipping_code' => $this->shipping_code,
                'selected_shipping_carrier_id' => $this->selected_shipping_carrier_id,
            ],
            [
                'shipping_code' => 'required|string|max:255',
                'selected_shipping_carrier_id' => 'required|exists:shipping_carriers,id',
            ],
            [
                'shipping_code.required' => 'The shipping code is required.',
                'shipping_code.string' => 'The shipping code must be a string.',
                'shipping_code.max' => 'The max lenght of shipping code is 255 charachter.',       
            ]
        );

        if ($validator->fails()) {
            $this->setErrorBag($validator->errors());
            return;
        }

        $moderator = Auth::guard('admin')->user();

        $shipped_status = OrderStatus::where('name', 'shipped')->first();

        $order = Order::where('id', $this->order_id)->update([
            'order_status_id' => $shipped_status->id,
            'order_status_name' => $shipped_status->name,
            'shipping_city' => $this->city,
            'shipping_price' => $this->shipping,
            'sub_total' => $this->sub_total,
            'total' => $this->total,
            'shipping_code' => $this->shipping_code,
            'shipping_carrier_id' => $this->selected_shipping_carrier_id,
        ]);

        OrderStatusHistory::create([
            'order_id' => $this->order_id,
            'order_status_id' => $shipped_status->id,
            'changed_by' => $moderator->id
        ]);

        return redirect()->route('moderator.shipping_upload_orders.index')->with('success', 'Order Shipped Successfully.');

    }

    public function render()
    {
        return view('livewire.moderators.order-shipping-upload');
    }
}
