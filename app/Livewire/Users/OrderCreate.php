<?php

namespace App\Livewire\Users;

use App\Models\Admin;
use App\Models\AdminOrder;
use App\Models\City;
use App\Models\ConfirmationModerator;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderAssignSystem;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\OrderStatusHistory;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Role;
use App\Models\ShippingRate;
use App\Models\StockMovement;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate; 

use function PHPUnit\Framework\isEmpty;

#[Layout('layouts.app')]

class OrderCreate extends Component
{

    public $order_items = [];
    public $added_products_ids = [];

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
    public $city_id;
    public $order_notes;

    public $shipping;
    public $sub_total;
    public $total;

    public $shippingRates = [];
    

    public function mount()
    {
        $this->update_shipping_rates();
    }

    public function update_shipping_rates()
    {
        $user_shipping_rates_package = Auth::user()->shipping_rates_package;
        $shipping_rates  = ShippingRate::all();

        foreach($shipping_rates as $rate)
        {
            $city_name = City::findOrFail($rate->city_id)->name;
            $this->shippingRates[$city_name] = $rate->$user_shipping_rates_package;
        }
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

        $current_user = Auth::user();
        
        if (!$product || !$current_user->products->contains($this->productid)) 
        {
            $this->addError('custom_error', 'No product found or you do not have access to this product.');
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
            'price' => $this->price,
        ];

        $this->added_products_ids[] = $product->id;

        
        $this->reset(['productid', 'quantity', 'price', 'lowest_selling_price', 'current_stock']);

        $this->resetErrorBag();

        $this->quantity = 1;
  
        $this->update_sub_total();

        $this->update_total();
        
    }

 

    public function updatedProductid($value)
    {
        $this->quantity = 1;

        $product = Product::find($value);

        $current_user = Auth::user();
        
        if ($value == '')
        {
            $this->reset(['productid', 'quantity', 'price', 'lowest_selling_price']);

            $this->quantity = 1;

            $this->update_sub_total();

            $this->update_total();

            return;
        }
        
        if (!$product || !$current_user->products->contains($value)) 
        {
            $this->addError('custom_error', 'No product found or you do not have access to this product.');
            return;
        } 
        else
        {
            $this->lowest_selling_price = $product->lowest_selling_price;
            $this->current_stock = $product->current_stock;
        }
    }


    public function delete_item($key)
    {
        array_splice($this->order_items, $key, 1);

        array_splice($this->added_products_ids, $key, 1);

        $this->update_sub_total();

        $this->update_total();
    }
   

    public function updatedCity($value)
    {
        $city_exicts = City::where('name', $value)->exists();

        if($city_exicts)
        {
            $city_id = City::where('name', $value)->first()->id;

            $this->city_id = $city_id;

            // Update the shipping cost based on the selected city
            $this->shipping = $this->shippingRates[$value] ?? 0.00;
            $this->update_total();
        }
       
        if($value == "")
        {
            $this->reset('shipping');
            $this->update_total();
        }
        
    }

    public function update_total()
    {
        $this->total = $this->shipping + $this->sub_total;
    }

    public function update_sub_total()
    {
        $this->sub_total = 0;
        foreach($this->order_items as $item)
        {
            $this->sub_total += $item['price'];
        }
    }


    public function save_order()
    {
        if (count($this->order_items) < 1)
        {
            $this->addError('custom_error', 'No items added.');
            return;
        }

        if (!OrderAssignSystem::first())
        {
            $this->addError('custom_error', 'No confirmation admins found.');
            return;
        }

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


        $current_user = Auth::user();
        $customer = Customer::where('phone', $this->customer_phone)->first();
        $processing_order_status = OrderStatus::where('name', 'processing')->first();

        if ($customer === null)
        {
            $customer = Customer::create([
                'name' => $this->customer_name,
                'phone' => $this->customer_phone,
                'address' => $this->customer_address,
            ]);
        }

        $order = Order::create([
            'user_id' => $current_user->id,
            'customer_id' => $customer->id,
            'order_status_id' => $processing_order_status->id,
            'order_status_name' => $processing_order_status->name,
            'shipping_name' => $this->customer_name,
            'shipping_phone' => $this->customer_phone,
            'shipping_phone_2' => $this->customer_phone_2,
            'shipping_address' => $this->customer_address,
            'shipping_city' => $this->city,
            'shipping_city_id' => $this->city_id,
            'shipping_price' => $this->shipping,
            'sub_total' => $this->sub_total,
            'total' => $this->total,
            'notes' => $this->order_notes
        ]);
    

        foreach($this->order_items as $item)
        {
            $item_price = $item['price'] / $item['quantity'];

            $product_price = ProductPrice::where('user_id', $current_user->id)
                                        ->where('product_id', $item['productid'])
                                        ->where('price', $item_price)
                                        ->first();

            if ($product_price === null)       
            {
                $product_price = ProductPrice::create([
                    'user_id' => $current_user->id,
                    'product_id' => $item['productid'],
                    'price' => $item_price
                ]);
            }                     

            OrderItem::create([
                'user_id' => $current_user->id,
                'product_id' => $item['productid'],
                'order_id' => $order->id,
                'product_price_id' => $product_price->id,
                'quantity' => $item['quantity'],
                'product_price' => $product_price->price,
                'total_price' => $item['price'],
            ]);

            // adjust current stock in products table and add record to stock_movements table
            StockMovement::adjustStock($item['productid'], -$item['quantity'], 'deduction' ,'order');     

        }


        $system_admin = Admin::where('name', 'System_Admin')->first();

        OrderStatusHistory::create([
            'order_id' => $order->id,
            'order_status_id' => $processing_order_status->id,
            'changed_by' => $system_admin->id
        ]);


        $lastAssignedAdmin = OrderAssignSystem::where('role', 'confirmation')->first()->last_assigned_admin_id;
        
        $nextAdmin = ConfirmationModerator::where('admin_id', '>', $lastAssignedAdmin)
                                                        ->orderBy('id', 'asc')
                                                        ->first();

        if (!$nextAdmin) {
            // إذا لم يكن هناك مسؤول لاحق، ابدأ من الأول
            $nextAdmin = ConfirmationModerator::orderBy('id', 'asc')->first();
        }



        AdminOrder::create([
            'admin_id' => $nextAdmin->admin_id,
            'order_id' => $order->id,
        ]);

        OrderAssignSystem::where('role', 'confirmation')->first()->update(['last_assigned_admin_id' => $nextAdmin->admin_id]);

        session()->flash('success', 'Order created successfully.');

        $this->reset();
        $this->resetErrorBag();
        
        $this->update_shipping_rates();
    }
  

    public function render()
    {
        $current_user = Auth::user();
        
        $user_products = collect($current_user->products)
            ->where('is_deleted', 0)
            ->where('is_published', 1)
            ->whereNotIn('id', $this->added_products_ids)
            ->all();

            
        return view('livewire.users.order-create', ['user_products' => $user_products]);
    }
}
