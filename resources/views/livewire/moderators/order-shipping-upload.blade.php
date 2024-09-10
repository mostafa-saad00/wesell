<div>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                @if ($moderator_order != null)

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center">
                                <h4 class="mb-sm-0">Order Upload Shipping </h4>
                            </div>  
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row mb-3">
                        <div class="col-xl-8">

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
                                        <h5 class="card-title flex-grow-1 mb-0">Shipping Details <span style="color: red">*</span></h5>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                        
                                    <div class="col-lg-12 col-sm-12 mb-3">
                                        <select wire:model.live="selected_shipping_carrier_id" class="form-control bg-light" id="selected_shipping_carrier" required >
                                            <option value="">Select Shipping Carrier</option>
                                            @foreach ($shipping_carriers as $carrier)

                                                <option value="{{ $carrier->id }}">{{ $carrier->name }}</option>
                                                
                                            @endforeach
                                            
                                        </select>

                                        @error('selected_shipping_carrier_id')
                                            <div>
                                                <div style="color: red">{{ $message }}</div> 
                                            </div>
                                        @enderror

                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                        

                                        <div class="input-light">
                                            <input type="text" wire:model="shipping_code" placeholder="Shipping Code" id="shipping_code" class="form-control bg-light" required>
                                        </div>

                                        @error('shipping_code')
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
                                                        @if($moderator_order->order_status_name == 'processing')
                                                            badge bg-primary text-uppercase 
                                                        @elseif($moderator_order->order_status_name == 'cancelled' || $moderator_order->order_status_name == 'duplicated')
                                                            badge bg-danger text-uppercase
                                                        @elseif($moderator_order->order_status_name == 'confirmed')
                                                            badge bg-secondary text-uppercase
                                                        @elseif($moderator_order->order_status_name == 'waiting_for_shipping' || $moderator_order->order_status_name == 'shipped')
                                                            badge bg-info text-uppercase  
                                                        @elseif($moderator_order->order_status_name == 'waiting_for_pickup' || $moderator_order->order_status_name == 'picked_up')
                                                            badge bg-warning text-uppercase     
                                                        @elseif($moderator_order->order_status_name == 'rejected_by_customer' || $moderator_order->order_status_name == 'waiting_for_returned' || $moderator_order->order_status_name == 'returned_to_warehouse')
                                                            badge bg-dark text-uppercase        
                                                        @endif
                                                    
                                                    ">
                                                        {{ $moderator_order->order_status_name }}
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
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
    
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button type="button" wire:click="orderUploaded" class="btn btn-success btn-label right ms-auto"><i class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Shipping upload completed</button>
                                    </div>
                                </div>
                            </div>

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
                                                    <input type="text" wire:model="customer_name" placeholder="Customer name" id="customer_name" class="bg-light border-0" style="width: 90%" value="{{ $customer_name }}" readonly>
                                                    <button style="font-size: 20px">
                                                        <i class="ri-file-copy-line"></i>
                                                    </button>
                                                </div>


                                            </div>


                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-light" id="customer_address_container">
                                                    <input type="text" wire:model="customer_address" placeholder="Customer address" id="customer_address" class="bg-light border-0" style="width: 90%" value="{{ $customer_address }}" readonly>
                                                    <button style="font-size: 20px">
                                                        <i class="ri-file-copy-line"></i>
                                                    </button>
                                                </div>
                                                
                                                @error('customer_address')
                                                    <div>
                                                        <div style="color: red">{{ $message }}</div> 
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-light" id="customer_phone_container">
                                                    <input type="text" wire:model="customer_phone" placeholder="Customer phone" id="customer_phone" class="bg-light border-0" style="width: 90%" value="{{ $customer_phone }}" readonly>
                                                    <button style="font-size: 20px">
                                                        <i class="ri-file-copy-line"></i>
                                                    </button>
                                                </div>
                                                
                                            </div>

                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-light" id="customer_city_container">
                                                    <input type="text" wire:model="city" id="city" class="bg-light border-0" style="width: 90%" value="{{ $city }}" readonly>
                                                    <button style="font-size: 20px">
                                                        <i class="ri-file-copy-line"></i>
                                                    </button>
                                                </div>

                                            </div>

                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-light" id="customer_phone_2_container">
                                                    <input type="text" wire:model="customer_phone_2" placeholder="Customer phone 2 (optional)" id="customer_phone_2" class="bg-light border-0" style="width: 90%" value="{{ $customer_phone_2 }}" readonly>
                                                    <button style="font-size: 20px">
                                                        <i class="ri-file-copy-line"></i>
                                                    </button>
                                                </div>

                                            </div>

                                            <div class="col-lg-12 col-sm-12">
                                                <div id="customer_notes_container">
                                                    <textarea class="bg-light border-0" wire:model="order_notes" id="order_notes"  style="width: 90%" placeholder="order notes (optional)"></textarea>
                                                    <button style="font-size: 20px">
                                                        <i class="ri-file-copy-line"></i>
                                                    </button>
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

                @else

                    All your orders are uploaded

                @endif

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

       
    </div>
    <!-- end main content-->
    

</div>



@script

<script>
    let customer_name_container = document.querySelector("#customer_name_container");
    let customer_address_container = document.querySelector("#customer_address_container");
    let customer_phone_container = document.querySelector("#customer_phone_container");
    let customer_city_container = document.querySelector("#customer_city_container");
    let customer_phone_2_container = document.querySelector("#customer_phone_2_container");
    let customer_notes_container = document.querySelector("#customer_notes_container");

    customer_name_container.querySelector("button").addEventListener("click", function(){
        
        let input = customer_name_container.querySelector("input");
        input.select();
        document.execCommand("copy");

        window.getSelection().removeAllRanges();

    });

    customer_address_container.querySelector("button").addEventListener("click", function(){
        
        let input = customer_address_container.querySelector("input");
        input.select();
        document.execCommand("copy");

        window.getSelection().removeAllRanges();

    });

    customer_phone_container.querySelector("button").addEventListener("click", function(){
        
        let input = customer_phone_container.querySelector("input");
        input.select();
        document.execCommand("copy");

        window.getSelection().removeAllRanges();

    });

    customer_city_container.querySelector("button").addEventListener("click", function(){
        
        let input = customer_city_container.querySelector("input");
        input.select();
        document.execCommand("copy");

        window.getSelection().removeAllRanges();

    });

    customer_phone_2_container.querySelector("button").addEventListener("click", function(){
        
        let input = customer_phone_2_container.querySelector("input");
        input.select();
        document.execCommand("copy");

        window.getSelection().removeAllRanges();

    });

    customer_notes_container.querySelector("button").addEventListener("click", function(){
        
        let textarea = customer_notes_container.querySelector("textarea");
        textarea.select();
        document.execCommand("copy");

        window.getSelection().removeAllRanges();

    });
</script>

@endscript