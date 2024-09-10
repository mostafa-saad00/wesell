<div>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center">
                            <h4 class="mb-sm-0">Order #{{ $order->id }} </h4>
                        </div>  
                    </div>
                </div>
                <!-- end page title -->

                <div class="row mb-3">
                    <div class="col-xl-8">

                        @if(\Session::has('custom_error'))
                            <div 
                                style="z-index: 11"
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 6000)" 
                                >
                            
                            
                                <div class="alert alert-danger" id="custom_error">
                                    <ul>
                                        <li>{!! \Session::get('custom_error') !!}</li>
                                    </ul>
                                </div>
                            
                                

                            </div>
                        @endif

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


                        <div class="card p-4">
                            <div class="table-responsive">
                                <table class="invoice-table table table-borderless table-nowrap mb-0">
                                    <thead class="align-middle">
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">#</th>
                                            <th scope="col">
                                                Product Details
                                            </th>
                                            <th scope="col" >Product Price</th>
                                            <th scope="col" style="width: 120px;">Quantity</th>
                                            <th scope="col" style="width: 120px;">Total Price</th>
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
                                                    <p>{{ $item['product_price'] }} L.E</p>                                                            
                                                </td>
                                                <td>
                                                    <div class="">
                                                        <p>x{{ $item['quantity'] }}</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p>{{ $item['total_price'] }} L.E</p>                                                            
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

                        
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex">
                                    @if(!$order_status_in_allowed_statuses)
                                    <h5 class="card-title flex-grow-1 mb-0">Change Order Status <span style="color: red">*</span></h5>
                                    
                                    @else
                                    <h5 class="card-title flex-grow-1 mb-0">Order Status </h5>

                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                    
                                <div class="col-lg-12 col-sm-12 mb-3">

                                    @if(!$order_status_in_allowed_statuses && $picked_up_status == $order->order_status_name) 
                                        <select wire:model.live="order_status" class="form-control bg-light" required>
                                                
                                            <option value="">Select Order Status</option>
                                            @foreach ($allowed_order_statuses as $status)
                                                <option value="{{ $status }}" @if ($order->order_status_name == $status) selected @endif >{{ $status }}</option>
                                            @endforeach
            
                                        </select>
                                    @else 
                                    <span class="
                                    @if($order->order_status_name == 'processing')
                                        badge bg-primary text-uppercase 
                                    @elseif($order->order_status_name == 'cancelled' || $order->order_status_name == 'duplicated')
                                        badge bg-danger text-uppercase
                                    @elseif($order->order_status_name == 'confirmed')
                                        badge bg-secondary text-uppercase
                                    @elseif($order->order_status_name == 'waiting_for_shipping' || $order->order_status_name == 'shipped')
                                        badge bg-info text-uppercase  
                                    @elseif($order->order_status_name == 'waiting_for_pickup' || $order->order_status_name == 'picked_up')
                                        badge bg-warning text-uppercase     
                                    @elseif($order->order_status_name == 'rejected_by_customer' || $order->order_status_name == 'waiting_for_returned' || $order->order_status_name == 'returned_to_warehouse')
                                        badge bg-dark text-uppercase
                                    @elseif($order->order_status_name == 'delivered')
                                        badge bg-success text-uppercase        
                                    @endif
                                
                                ">
                                    {{ $order->order_status_name }}
                                </span>


                                    @endif

                                    @error('order_status')
                                        <div>
                                            <div style="color: red">{{ $message }}</div> 
                                        </div>
                                    @enderror

                                </div>
                                


                                <!--end col-->
                                    

                                
                            </div>
                        </div>
                        <!--end card-->


                        <div class="card">
                            <div class="card-header border-bottom-dashed">
                                <h5 class="card-title mb-0" style="font-weight: 600">Order Summary</h5>
                            </div>
                            
                            <div class="card-body pt-2">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr class="">
                                                <th>Order Status :</th>
                                                <td class="text-end">
                                                    <span class="
                                                    @if($order->order_status_name == 'processing')
                                                        badge bg-primary text-uppercase 
                                                    @elseif($order->order_status_name == 'cancelled' || $order->order_status_name == 'duplicated')
                                                        badge bg-danger text-uppercase
                                                    @elseif($order->order_status_name == 'confirmed')
                                                        badge bg-secondary text-uppercase
                                                    @elseif($order->order_status_name == 'waiting_for_shipping' || $order->order_status_name == 'shipped')
                                                        badge bg-info text-uppercase  
                                                    @elseif($order->order_status_name == 'waiting_for_pickup' || $order->order_status_name == 'picked_up')
                                                        badge bg-warning text-uppercase     
                                                    @elseif($order->order_status_name == 'rejected_by_customer' || $order->order_status_name == 'waiting_for_returned' || $order->order_status_name == 'returned_to_warehouse')
                                                        badge bg-dark text-uppercase
                                                    @elseif($order->order_status_name == 'delivered')
                                                        badge bg-success text-uppercase        
                                                    @endif
                                                
                                                ">
                                                    {{ $order->order_status_name }}
                                                </span>                                                    </td>
                                            </tr>
                                            <tr>
                                                <td>Sub Total :</td>
                                                <td class="text-end">
                                                    <span class="fw-semibold" x-text="$wire.sub_total" ></span>
                                                    <span class="fw-semibold">EGP</span>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Shipping Charge :</td>
                                                
                                                <td class="text-end">
                                                    <span class="fw-semibold" x-text="$wire.shipping" ></span>
                                                    <span class="fw-semibold">EGP</span>
                                                </td>
                                            </tr>
                                            <tr class="table-active">
                                                <th>Total (EGP) :</th>
                                                <td class="text-end">
                                                    <span class="fw-semibold" x-text="$wire.total" ></span>
                                                    <span class="fw-semibold">EGP</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                        </div>

                        @if($order->order_status_name == $picked_up_status) 
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">

                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button type="button" wire:click="updateOrderStatus" class="btn btn-success btn-label right ms-auto"><i class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Update</button>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    <!-- end col -->

                    <div class="col-xl-4">
                        <div class="sticky-side-div">

                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex">
                                        <h5 class="card-title flex-grow-1 mb-0">Customer Details </h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0 vstack gap-3">
                                        

                                        <div class="col-lg-12 col-sm-12">
                                            <div class="input-light" id="customer_name_container">
                                                <input type="text" wire:model="customer_name" placeholder="Customer name" id="customer_name" class="form-control bg-light border-0" value="{{ $customer_name }}" readonly>
                                               
                                            </div>


                                        </div>


                                        <div class="col-lg-12 col-sm-12">
                                            <div class="input-light" id="customer_address_container">
                                                <input type="text" wire:model="customer_address" placeholder="Customer address" id="customer_address" class="form-control bg-light border-0" value="{{ $customer_address }}" readonly>
                                                
                                            </div>
                                            
                                            @error('customer_address')
                                                <div>
                                                    <div style="color: red">{{ $message }}</div> 
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-lg-12 col-sm-12">
                                            <div class="input-light" id="customer_phone_container">
                                                <input type="text" wire:model="customer_phone" placeholder="Customer phone" id="customer_phone" class="form-control bg-light border-0" value="{{ $customer_phone }}" readonly>
                                               
                                            </div>
                                            
                                        </div>

                                        <div class="col-lg-12 col-sm-12">
                                            <div class="input-light" id="customer_city_container">
                                                <input type="text" wire:model="city" id="city" class="form-control bg-light border-0" value="{{ $city }}" readonly>
                                               
                                            </div>

                                        </div>

                                        <div class="col-lg-12 col-sm-12">
                                            <div class="input-light" id="customer_phone_2_container">
                                                <input type="text" wire:model="customer_phone_2" placeholder="Customer phone 2 (optional)" id="customer_phone_2" class="form-control bg-light border-0" value="{{ $customer_phone_2 }}" readonly>
                                               
                                            </div>

                                        </div>

                                        <div class="col-lg-12 col-sm-12">
                                            <div id="customer_notes_container">
                                                <textarea class="form-control bg-light border-0" wire:model="order_notes" id="order_notes"  placeholder="order notes (optional)"></textarea>
                                               
                                            </div>
                                        </div>

                                        <!--end col-->
                                        

                                    </ul>
                                </div>
                            </div>
                            <!--end card-->

                            

                            
                            
                        </div>
                        <!-- end stickey -->

                    </div>
                </div>
                <!-- end row -->

                

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

       
    </div>
    <!-- end main content-->
    

</div>



