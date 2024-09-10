<?php

namespace App\Livewire\Moderators;

use App\Models\Admin;
use App\Models\AdminOrder;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderAssignSystem;
use App\Models\OrderDelay;
use App\Models\OrderHistory;
use App\Models\OrderItem;
use App\Models\OrderNotresponding;
use App\Models\OrderStatus;
use App\Models\OrderStatusHistory;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\ShippingModerator;
use App\Models\ShippingRate;
use App\Models\StockMovement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;


#[Layout('layouts.app')]


class OrderShow extends Component
{
    public $order;
    public $hasAccess = false;

    public $moderator_can_edit = true;

    public $order_items = [];
    public $added_products_ids = [];

    public $add_item_form_visibility = false;
    public $order_items_edited = false;

    public $edit_order_ability = false;

    public $order_have_edits = false;

    public $order_status_is_proccessing_or_confirmed = false;

    public $order_delayed_maximum_times = false;

    public $delayed_date;
    public $delayed_order_notes;

    public $productid;
    public $productName;
    public $quantity;
    public $price;
    public $lowest_selling_price;
    public $current_stock;
    
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
    public $user_id;

    public $shippingRates = [];


    public function mount(Order $order)
    {
        $this->checkAccess();

        $this->order = $order;

        $moderator = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        $isShippingModerator = ShippingModerator::where('admin_id', $moderator->id)->exists();

        if ($isShippingModerator)
        {
            $this->moderator_can_edit = false;
        }

        $this->user_id = $order->user->id;
        $this->order_id = $order->id;

        $order_items = OrderItem::where('order_id', $order->id)->where('is_deleted', 0)->get();
 
        foreach($order_items as $item)
        {
            $this->order_items[] = [
                'productid' => $item->product->id,
                'productName' => $item->product->title,
                'quantity' => $item->quantity,
                'product_price' => $item->product_price,
                'total_price' => $item->total_price,
            ];

            $this->added_products_ids[] = $item->product->id;
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

        
        $order_history_exists = OrderHistory::where('order_id', $order->id)->exists();
        $order_items_edits_exists = OrderItem::where('order_id', $order->id)->where('version', '>', 1)->exists();


        if(count($order->orderDelays) > 0)
        {
            $this->order_delayed_maximum_times = true;
        }


        if($order_history_exists || $order_items_edits_exists)
        {
            $this->order_have_edits = true;
        }

        if ($order->order_status_name == 'processing' || $order->order_status_name == 'confirmed') 
        {
            $this->order_status_is_proccessing_or_confirmed = true;
        }

        $user_shipping_rates_package = $order->user->shipping_rates_package;
        $shipping_rates  = ShippingRate::all();

        foreach($shipping_rates as $rate)
        {
            $city_name = City::findOrFail($rate->city_id)->name;
            $this->shippingRates[$city_name] = $rate->$user_shipping_rates_package;
        }
    }

    public function delete_item($key)
    {
        $this->order_items_edited = true;

        array_splice($this->order_items, $key, 1);

        array_splice($this->added_products_ids, $key, 1);

        $this->update_sub_total();

        $this->update_total();
    }

    public function update_sub_total()
    {
        $this->sub_total = 0;
        foreach($this->order_items as $item)
        {
            $this->sub_total += $item['total_price'];
        }
    }
    
    public function update_total()
    {
        $this->total = $this->shipping + $this->sub_total;
    }

    public function updatedCity($value)
    {
        // Update the shipping cost based on the selected city
        $this->shipping = $this->shippingRates[$value] ?? 0.00;

        $this->update_total();
    }

    public function updatedProductid($value)
    {
        $this->quantity = 1;

        $product = Product::find($value);
        
        if ($value == '')
        {
            $this->reset(['productid', 'quantity', 'price', 'lowest_selling_price']);

            $this->quantity = 1;

            $this->update_sub_total();

            $this->update_total();

            return;
        }
        
        if (!$product) 
        {
            $this->addError('custom_error', 'No product found.');
            return;
        } 
        else
        {
            $this->lowest_selling_price = $product->lowest_selling_price;
            $this->current_stock = $product->current_stock;
        }
    }

    public function click_add_button()
    {
        $this->add_item_form_visibility = true;
    }

    public function change_order_edit_ability()
    {
        $this->edit_order_ability = true;
    }

    public function editOrder()
    {
        if($this->customer_phone_2)
        {
            $this->validateOnly('customer_phone_2', 
                [
                    'customer_phone_2' => 'numeric|regex:/^\d{11}$/',
                ],
                [
                    'customer_phone_2.numeric' => 'The customer phone 2 must be a number.',
                    'customer_phone_2.regex' => 'The customer phone 2 must be 11 digits.',
                ]
            );
        }
        
        if($this->order_notes)
        {
            $this->validateOnly('order_notes', 
                [
                    'order_notes' => 'string|max:20',
                ],
                [
                    'order_notes.string' => 'the order notes field must be a string.',
                    'order_notes.max' => 'The max length is 500 charachter.',
                ]
            );
        }

        $validator = Validator::make(
            [
                'customer_name' => $this->customer_name,
                'customer_phone' => $this->customer_phone,
                'customer_address' => $this->customer_address,
                'city' => $this->city,
            ],
            [
                'customer_name' => 'required|string|max:255',
                'customer_phone' => 'required|numeric|regex:/^\d{11}$/',
                'customer_address' => 'required|string|max:500',
                'city' => 'required|string|max:255',
            ],
            [
                'customer_name.required' => 'The customer name is required.',
                'customer_phone.required' => 'The customer phone number is required.',
                'customer_phone.regex' => 'The customer phone number format is invalid.',
                'customer_address.required' => 'The customer address is required.',
                'city.required' => 'The city is required.',        
            ]
        );

        if ($validator->fails()) {
            $this->setErrorBag($validator->errors());
            return;
        }

        $order = Order::where('id', $this->order_id)->first();

        $order_histories_exists = OrderHistory::where('order_id', $this->order_id)->exists();

        if ($order_histories_exists)
        {
            $version = OrderHistory::where('order_id', $this->order_id)->first()->version + 1;
        }
        else
        {
            $version = 1;
        }

        OrderHistory::create([
            'order_id' => $this->order_id,
            'user_id' => $order->user_id,
            'customer_id' => $order->customer_id,
            'order_status_id' => $order->order_status_id,
            'order_status_name' => $order->order_status_name,
            'shipping_name' => $order->shipping_name,
            'shipping_phone' => $order->shipping_phone,
            'shipping_phone_2' => $order->shipping_phone_2,
            'shipping_address' => $order->shipping_address,
            'shipping_city' => $order->shipping_city,
            'shipping_price' => $order->shipping_price,
            'sub_total' => $order->sub_total,
            'total' => $order->total,
            'notes' => $order->notes,
            'shipping_code' => $order->shipping_code,
            'version' => $version,
            'updated_by' => Auth::guard('admin')->user()->id,
        ]);


        $order->update([
            'shipping_name' => $this->customer_name,
            'shipping_phone' => $this->customer_phone,
            'shipping_phone_2' => $this->customer_phone_2,
            'shipping_address' => $this->customer_address,
            'shipping_city' => $this->city,
            'shipping_price' => $this->shipping,
            'total' => $this->total,
            'notes' => $this->order_notes
        ]);

        $this->edit_order_ability = false;
        $this->order_have_edits = true;

        session()->flash('order_updated_message', 'Order updated successfully.');

    }

    public function updateOrder() 
    {
        if (count($this->order_items) < 1)
        {
            $this->addError('custom_error', 'No items added.');
            return;
        }

        if ($this->order_items_edited == true)
        {
            $last_order_items_version = OrderItem::where('order_id', $this->order_id)
                        ->orderBy('version', 'desc')
                        ->first();

            $order_items = OrderItem::where('order_id', $this->order_id)->where('version', $last_order_items_version->version)->get();
 

            foreach($order_items as $item)
            {
                $item->is_deleted = 1;
                $item->save();

                // adjust stock
                StockMovement::adjustStock($item->product->id, $item->quantity, 'addition' ,'update_order');
            }



            foreach ($this->order_items as $item)
            {
                $product_price_exists = ProductPrice::where('user_id', $this->user_id)->where('product_id', $item['productid'])->where('price', $item['product_price'])->exists();

                if ($product_price_exists)
                {
                    $product_price = ProductPrice::where('user_id', $this->user_id)->where('product_id', $item['productid'])->where('price', $item['product_price'])->first();
                }
                else
                {
                    $product_price = ProductPrice::create([
                        'user_id' => $this->user_id,
                        'product_id' => $item['productid'],
                        'price' => $item['product_price'],
                    ]);
                }

                OrderItem::create([
                    'user_id' => $this->user_id,
                    'product_id' => $item['productid'],
                    'order_id' => $this->order_id,
                    'product_price_id' => $product_price->id,
                    'quantity' => $item['quantity'],
                    'product_price' => $item['product_price'],
                    'total_price' => $item['total_price'],
                    'version' => $last_order_items_version->version + 1
                ]);

                // adjust stock
                StockMovement::adjustStock($item['productid'], -$item['quantity'], 'deduction' ,'update_order');
            }
        }


        $moderator = Auth::guard('admin')->user();

        $order = Order::where('id', $this->order_id)->update([
            'shipping_city' => $this->city,
            'shipping_price' => $this->shipping,
            'sub_total' => $this->sub_total,
            'total' => $this->total,
        ]);


    
        return redirect()->route('moderator.order.show', $this->order_id)->with('success', 'Order Updated Successfully.');
    }

    public function cancelOrder()
    {
        $moderator = Auth::guard('admin')->user();

        $cancel_status = OrderStatus::where('name', 'cancelled')->first();

        $last_order_items_version = OrderItem::where('order_id', $this->order_id)
                        ->orderBy('version', 'desc')
                        ->first();

        $order = Order::where('id', $this->order_id)->first();

        $order->update([
            'order_status_id' => $cancel_status->id,
            'order_status_name' => $cancel_status->name,
        ]);

        OrderStatusHistory::create([
            'order_id' => $this->order_id,
            'order_status_id' => $cancel_status->id,
            'changed_by' => $moderator->id
        ]);

        $order_items = $order->orderItems()->where('version', $last_order_items_version->version)->get();

        foreach($order_items as $item)
        {
            // adjust current stock in products table and add record to stock_movements table
            StockMovement::adjustStock($item->product->id, $item->quantity, 'addition' ,'cancel_order');   
        }

        return redirect()->route('moderator.order.show', $this->order_id)->with('success', 'Order Cancelled Successfully.');
    }

    public function duplicatedOrder()
    {
        $moderator = Auth::guard('admin')->user();

        $duplicated_status = OrderStatus::where('name', 'duplicated')->first();

        $last_order_items_version = OrderItem::where('order_id', $this->order_id)
                        ->orderBy('version', 'desc')
                        ->first();

        $order = Order::where('id', $this->order_id)->first();

        $order->update([
            'order_status_id' => $duplicated_status->id,
            'order_status_name' => $duplicated_status->name,
        ]);

        OrderStatusHistory::create([
            'order_id' => $this->order_id,
            'order_status_id' => $duplicated_status->id,
            'changed_by' => $moderator->id
        ]);

        $order_items = $order->orderItems()->where('version', $last_order_items_version->version)->get();

        foreach($order_items as $item)
        {
            // adjust current stock in products table and add record to stock_movements table
            StockMovement::adjustStock($item->product->id, $item->quantity, 'addition' ,'duplicated_order');
        }

        return redirect()->route('moderator.order.show', $this->order_id)->with('success', 'Order Marked as duplicated Successfully.');
    }

    public function add_item()
    {    

        $validated = $this->validate([ 
            'quantity' => 'required|integer|min:1|max:9999999999',
        ]);


        $validator = Validator::make(
            [
                'productid' => $this->productid,
                'quantity' => $this->quantity,
                'price' => $this->price,
            ],
            [
                'productid' => 'required|integer|min:1|max:9999999999',
                'quantity' => 'required|integer|min:1|max:9999999999',
                'price' => 'required|integer|min:' . $this->lowest_selling_price * $this->quantity . '|max:9999999999',
            ],
            [
                'productid.required' => 'The product field is required.',
                'productid.integer' => 'The product must be an integer.',
                'productid.min' => 'The product must be at least 1.',
                'productid.max' => 'The product may not be greater than 9999999999.',
                'quantity.required' => 'The quantity field is required.',
                'quantity.integer' => 'The quantity must be an integer.',
                'quantity.min' => 'The quantity must be at least 1.',
                'quantity.max' => 'The quantity may not be greater than 9999999999.',
                'price.required' => 'The total price field is required.',
                'price.integer' => 'The total price must be an integer.',
                'price.min' => 'The total price must be at least ' . $this->quantity . ' x ' . $this->lowest_selling_price . ' = ' . $this->lowest_selling_price * $this->quantity . '.',
                'price.max' => 'The total price may not be greater than 9999999999.',
            ]
        );

        if ($validator->fails()) {
            $this->setErrorBag($validator->errors());
            return;
        }

        
        $product = Product::find($this->productid);

        
        if (!$product) 
        {
            $this->addError('custom_error', 'No product found.');
            return;
        } 

        if ($product->current_stock < $this->quantity)
        {
            $this->addError('custom_error', 'There is not enough stock of this product.');
            return;
        }


        $this->order_items[] = [
            'productid' => $product->id,
            'productName' => $product->title,
            'quantity' => $this->quantity,
            'product_price' => $this->price / $this->quantity,
            'total_price' => $this->price,
        ];

        $this->added_products_ids[] = $product->id;
        
        $this->reset(['productid', 'quantity', 'price', 'lowest_selling_price', 'current_stock']);

        $this->resetErrorBag();

        $this->quantity = 1;
  
        $this->update_sub_total();
        $this->update_total();
        
        $this->order_items_edited = true;
    }


    public function delayOrder()
    {
        $validator = Validator::make(
            [
                'delayed_date' => $this->delayed_date,
                'delayed_order_notes' => $this->delayed_order_notes
            ],
            [
                'delayed_date' => 'required|date',
                'delayed_order_notes' => 'nullable|string|max:500',
            ],
            [
                'delayed_date.required' => 'The date input is required.',
                'delayed_date.date' => 'The date input is wrong formated.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('moderator.order.show', $this->order_id)->with('custom_error', 'Order Delayed Failed.');

        }

        $order = Order::where('id', $this->order_id)->update([
            'notes' => $this->delayed_order_notes,
            'updated_at' => $this->delayed_date,
        ]);

        OrderDelay::create([
            'order_id' => $this->order_id
        ]);

        return redirect()->route('moderator.order.show', $this->order_id)->with('success', 'Order Delayed Successfully.');

    }

   
    public function checkAccess()
    {
        $admin = Auth::guard('admin')->user();

        $this->hasAccess = $admin->orders->contains($this->order);

        if (!$this->hasAccess) {
            abort(403, 'Unauthorized');
        }
    }


    public function render()
    {
        $order_user_id = Order::where('id', $this->order_id)->first()->user->id;

        $current_user = User::where('id', $order_user_id)->first();
            
        $user_products = collect($current_user->products)
            ->where('is_deleted', 0)
            ->where('is_published', 1)
            ->whereNotIn('id', $this->added_products_ids)
            ->all();

        return view('livewire.moderators.order-show', ['order' => $this->order, 'user_products' => $user_products]);   
    }
}
