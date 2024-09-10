<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                

                <div class="row justify-content-center">
                    
                    <div class="col-xxl-9">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Create Order</h4>
                                </div>
                            </div>
                        </div>

                        
                        <div class="card">

                            <div class="card-body p-4">

                                @error('custom_error')
                                    <div 
                                        style="z-index: 11"
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 6000)" 
                                        >
                                    
                                    
                                        <div class="alert alert-danger" id="custom_error">
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        </div>
                                    
                                        

                                    </div>
                                @enderror

                                @if (\Session::has('success'))
                                    <div 
                                        style="z-index: 11"
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 6000)" 
                                        >
                                    
                                        <div class="alert alert-success" id="success_message">
                                            <ul>
                                                <li>{!! \Session::get('success') !!}</li>
                                            </ul>
                                        </div>

                                    </div>
                                @endif

                                
                                <form wire:submit="add_item">
                                    <div class="row g-3">
                                        <div class="col-lg-6 col-sm-6">
                                            <label for="product_name">Product name: @if ($current_stock) (current stock = {{ $current_stock }}) pieces @endif</label>
                                            <div class="input-light">
                                                <select name="productid" wire:model.live="productid" class="form-control bg-light border-0" id="product" required autofocus>
                                                    <option value="">Select Product</option>
                                                    @foreach ($user_products as $product)
                                                        <option 
                                                            @if ($product->current_stock <= 0)
                                                                disabled
                                                                wire:key="{{ $product->id }}"
                                                            @else   
                                                                value="{{ $product->id }}" 
                                                                wire:key="{{ $product->id }}"
                                                            @endif
                                                            
                                                        >

                                                        @if ($product->current_stock <= 0)
                                                            {{ $product->title }} <span style="color: red" class="danger text-bold">(No Stock)</span>
                                                        @else     
                                                            {{ $product->title }}
                                                        @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                @error('productid')
                                                    <div>
                                                        <div style="color: red">{{ $message }}</div> 
                                                    </div>
                                                @enderror 
                                              
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-2 col-sm-6">
                                            <label for="quantity">Quantity</label>
                                            <div>
                                                <div class="input-step">
                                                    <button type="button" class='minus'>x</button>
                                                    <input type="number" wire:model="quantity" name="item_product_quantity" class="product-quantity" id="product-qty">
                                                    
                                                </div>
                                                <div>
                                                    @error('quantity')
                                                        <div>
                                                            <div style="color: red">{{ $message }}</div> 
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <label for="total_price">Total Price: @if ($lowest_selling_price) (minimum price of 1 piece = {{ $lowest_selling_price }}) @endif</label>
                                            <input type="number"  wire:model="price" name="total_price" class="form-control product-price bg-light border-0" id="total_price" placeholder="0.00 L.E" required />
                                            <div>
                                                @error('price')
                                                    <div>
                                                        <div style="color: red">{{ $message }}</div> 
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->

                                    
                                        
                                    </div>
                                    <!--end row-->
                                    <div class="mt-3">
                                        <button type="submit" id="add-item" class="btn btn-soft-secondary fw-medium"><i class="ri-add-fill me-1 align-bottom"></i> Add Item</button>
                                    </div>

                                </form>
                            </div>



                            


                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="invoice-table table table-borderless table-nowrap mb-0">
                                        <thead class="align-middle">
                                            <tr class="table-active">
                                                <th scope="col" style="width: 50px;">#</th>
                                                <th scope="col">
                                                    Product Details
                                                </th>
                                                <th scope="col" style="width: 120px;">Quantity</th>
                                                <th scope="col" style="width: 120px;">Total Price</th>
                                                <th scope="col" class="text-end" style="width: 105px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="newlink">
                                            @foreach ($order_items as $key => $item)
                                                
                                                <tr id="{{ $key + 1 }}" class="product">
                                                    <th scope="row" class="product-id">{{ $key + 1 }}</th>
                                                    <td class="text-start">
                                                        <div class="col-lg-8 col-sm-6">
                                                            <p>{{ $item['productName'] }}</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="">
                                                            <p>x{{ $item['quantity'] }}</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>{{ $item['price'] }} L.E</p>                                                            
                                                    </td>
                                                
                                                
                                                    <td class="product-removal">
                                                        <a wire:click="delete_item({{$key}})" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                                    </td> 
                                                
                                                    
                                                </tr>

                                           
                                                
                                                
                                               
                                            @endforeach

                                            @if (count($order_items) == 0)
                                                <td>
                                                    <p>No products added....</p>                                                            
                                                    <p>.</p>                                                            
                                                </td>
                                            @endif

                                        </tbody>
                                            
                                        
                                    </table>
                                    <!--end table-->
                                </div>

                           

                                

                                
                                
                            </div>




                            <form wire:submit="save_order">
                                
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-lg-6 col-sm-6">
                                            <label for="customer_name">Customer Name</label>
                                            <input type="text" wire:model="customer_name" class="form-control bg-light border-0" id="customer_name" placeholder="Customer Name" required>
                                            
                                            @error('customer_name')
                                                <div>
                                                    <div style="color: red">{{ $message }}</div> 
                                                </div>
                                            @enderror
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6 col-sm-6">
                                            <div>
                                                <label for="customer_phone">Customer Phone 1</label>
                                                <input type="number" wire:model="customer_phone" class="form-control bg-light border-0" id="customer_phone" placeholder="Customer Phone" required>
                                            </div>
                                            
                                            @error('customer_phone')
                                                <div>
                                                    <div style="color: red">{{ $message }}</div> 
                                                </div>
                                            @enderror
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6 col-sm-6">
                                            <div>
                                                <label for="customer_phone_2">Customer Phone 2 (optional)</label>
                                                <input type="number" wire:model="customer_phone_2" class="form-control bg-light border-0" id="customer_phone_2" placeholder="Customer Phone 2 (optional)">
                                            </div>
                                            
                                            @error('customer_phone_2')
                                                <div>
                                                    <div style="color: red">{{ $message }}</div> 
                                                </div>
                                            @enderror
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6 col-sm-6">
                                            <label for="city">City</label>
                                            <div class="input-light">
                                                <select wire:model.live="city" class="form-control bg-light border-0" id="city" required>
                                                    <option value="">Select City</option>
                                                    @foreach ($shippingRates as $city_name => $rate)

                                                        <option value="{{ $city_name }}">  {{ $city_name }}</option>
                                                        
                                                    @endforeach

                                                    
                                                </select>
                                            </div>
                                            
                                            @error('city')
                                                <div>
                                                    <div style="color: red">{{ $message }}</div> 
                                                </div>
                                            @enderror
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6 col-sm-6">
                                            <div>
                                                <label for="customer_address">Customer Address</label>
                                                <textarea class="form-control bg-light border-0" wire:model="customer_address" id="billingAddress" rows="3" placeholder="Address" required></textarea>
                                            </div>

                                            @error('customer_address')
                                                <div>
                                                    <div style="color: red">{{ $message }}</div> 
                                                </div>
                                            @enderror
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6 col-sm-6">
                                            <div>
                                                <label for="order_notes">Notes (optional)</label>
                                                <textarea class="form-control bg-light border-0" wire:model="order_notes" id="order_notes" rows="3" placeholder="order_notes (optional)"></textarea>
                                            </div>

                                            @error('order_notes')
                                                <div>
                                                    <div style="color: red">{{ $message }}</div> 
                                                </div>
                                            @enderror
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>


                             
                               

                                


                                
                                <div class="card-body p-4">
                                    <div class="table-responsive">
                                        <table class="invoice-table table table-borderless table-nowrap mb-0">
                                            <thead class="align-middle">
                                                <tr class="">
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                    <th scope="col" style="width: 120px;"></th>
                                                    <th scope="col" class="text-end" style="width: 105px;"></th>
                                                </tr>
                                            </thead>
                                            
                                                
                                            <tbody>
                                                <tr>
                                                    
                                                </tr>
                                                <tr class="border-top border-top-dashed mt-2">
                                                    <td colspan="3"></td>
                                                    <td colspan="2" class="">
                                                        <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                            <tbody>
                                                               
                                                                <tr>
                                                                    <th scope="row">Sub Total</th>
                                                                    <td style="width:150px;">
                                                                        <input type="text" wire:model="sub_total" class="form-control bg-light border-0" id="cart-subtotal" placeholder="0.00 L.E" readonly />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Shipping Charge</th>
                                                                    <td>
                                                                        <input type="text" wire:model="shipping" class="form-control bg-light border-0" id="cart-shipping" placeholder="0.00 L.E" readonly />
                                                                    </td>
                                                                </tr>
                                                                <tr class="border-top border-top-dashed">
                                                                    <th scope="row">Total Amount</th>
                                                                    <td>
                                                                        <input type="text" wire:model="total" class="form-control bg-light border-0" id="cart-total" placeholder="0.00 L.E" readonly />
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--end table-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--end table-->
                                    </div>

                                    

                                    
                                    <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                        <button type="submit" class="btn btn-success" id="submit_button"><i class="ri-add-line align-bottom me-1"></i> Create</button>
                                    </div>
                                </div>
                            
                            
                            
                            </form>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
</div>

@section('extra-javascript')
    <script>
        document.getElementById('submit_button').addEventListener('click', function() {
            setTimeout(function() {
                var custom_error = document.getElementById('custom_error');
                var success_message = document.getElementById('success_message');

                if (custom_error || success_message) {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            }, 2000);

            
        });

    </script>
@endsection

