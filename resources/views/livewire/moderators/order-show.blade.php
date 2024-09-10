<div>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center">
                                <h4 class="mb-sm-0">Order Details</h4>

                                @if ($order_have_edits)
                                    <a href="{{ route('moderator.order.order_edits', $order_id) }}" class="link-danger link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover ml-2" target="blank">see order edits</a>
                                @endif
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


                            @if ($moderator_can_edit)
   
                                @if (!$add_item_form_visibility)

                                    @if ($order_status_is_proccessing_or_confirmed)
                                        <div class="row align-items-center gy-3">
                                            <div class="mb-4">
                                                <button type="submit" wire:click="click_add_button" class="btn btn-primary waves-effect waves-light"><i class="ri-add-fill me-1 align-bottom"></i> Add</button>
                                            </div>
                                            
                                        </div>
                                    @endif

                                @endif

                            @endif

                            @if ($add_item_form_visibility)

                                <div class="card" id="add_item_card" >

                                    <div class="card-body p-4">
  
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
                                                <button type="submit" id="add-item" class="btn btn-dark fw-medium"><i class="ri-add-fill me-1 align-bottom"></i> Add Item</button>
                                            </div>

                                        </form>
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
                                                @if ($order_status_is_proccessing_or_confirmed && $moderator_can_edit) 
                                                    <th scope="col" class="text-end" style="width: 105px;"></th>
                                                @endif
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
                                                
                                                    @if ($order_status_is_proccessing_or_confirmed && $moderator_can_edit) 
                                                        <td class="product-removal">
                                                            <a wire:click="delete_item({{$key}})" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                                        </td> 
                                                    @endif
                                                    
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
                                                        @endif
                                                    
                                                    ">
                                                        {{ $order->order_status_name }}
                                                    </span>                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Sub Total :</th>
                                                    <td class="text-end">
                                                        <span class="fw-semibold" x-text="$wire.sub_total" ></span>
                                                        <span class="fw-semibold">EGP</span>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping Charge :</th>
                                                    
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


                            

                            <div class="card mt-3">
                                <div class="card-header">
                                    <div class="d-sm-flex align-items-center">
                                        <h5 class="card-title flex-grow-1 mb-0">Order Statuses</h5>                                                                    
    
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="profile-timeline">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            
                                            @foreach ($order->order_status_histories as $status)
                                            
                                                <div class="accordion-item border-0">
                                                    <div class="accordion-header" id="headingOne">
                                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 avatar-xs">
                                                                    <div class="avatar-title bg-success rounded-circle">
                                                                        <i class="ri-shopping-bag-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h6 class="fs-14 mb-0">{{ strtoupper($status->order_status->name) }} - <span class="fw-normal">{{ \Carbon\Carbon::parse($status->created_at)->format('D') }}, {{ $status->created_at->format('Y-m-d') }}</span><small class="text-muted"> {{ $status->created_at->format('h:i a') }}</small>- <span class="fw-normal">By: {{ $status->admin->name }} </span></h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    
                                                </div>
    
                                            @endforeach
                                                    
    
                                            
                                            
                                        </div>
                                        <!--end accordion-->
                                    </div>
                                </div>
                            </div>
                            <!--end card-->

                            @if (count($order_items) > 0)  
                                @if ($order_status_is_proccessing_or_confirmed && $moderator_can_edit) 
                                    <div class="row align-items-center gy-3">
                                        <div class="col-sm">

                                            <button type="button" class="btn btn-soft-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel order</button>

                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center p-5">
                                                            <lord-icon
                                                                src="https://cdn.lordicon.com/tdrtiskw.json"
                                                                trigger="loop"
                                                                colors="primary:#121331,secondary:#e83a30"
                                                                style="width:130px;height:130px">
                                                            </lord-icon>
                                                            
                                                            <div class="mt-4">
                                                                <h4 class="mb-3" style="font-size: 16px; font-weight: 600">Cancel the order</h4>
                                                                <p class="text-muted mb-4"> Are you sure?</p>
                                                                <div class="hstack gap-2 justify-content-center">
                                                                    <button type="button" class="btn btn-link link-danger fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                                    <button type="button" wire:click="cancelOrder" class="btn btn-danger">Cancel the order</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                            <button type="button" class="btn btn-soft-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2"><i class="mdi mdi-arrange-send-backward align-middle me-1"></i> Duplicated order</button>

                                            <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center p-5">
                                                            <lord-icon
                                                                src="https://cdn.lordicon.com/tdrtiskw.json"
                                                                trigger="loop"
                                                                colors="primary:#121331,secondary:#8930e8"
                                                                style="width:130px;height:130px">
                                                            </lord-icon>
                                                            
                                                            <div class="mt-4">
                                                                <h4 class="mb-3" style="font-size: 16px; font-weight: 600">Mark the order as duplicated</h4>
                                                                <p class="text-muted mb-4"> Are you sure?</p>
                                                                <div class="hstack gap-2 justify-content-center">
                                                                    <button type="button" class="btn btn-link link-secondary fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                                    <button type="button" wire:click="duplicatedOrder" class="btn btn-secondary">Mark as duplicated</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            

                                            @if (!$order_delayed_maximum_times)
                                    
                                        <button type="button" class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop3"><i class="mdi mdi-arrange-send-backward align-middle me-1"></i> Delay the order</button>

                                        <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center p-5">
                                                        <div class="col-xxl-12 col-sm-12">
                                                            <div>
                                                                <h4 class="mb-3" style="font-size: 16px; font-weight: 600">select the confirmation date</h4>
                                                                <input type="date" wire:model="delayed_date" class="form-control" id="date-picker-input" placeholder="Select date">
                                                                <textarea class="form-control mt-3" wire:model="delayed_order_notes" id="delayed_order_notes" rows="3" placeholder="order notes (optional)" ></textarea>

                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mt-4">
                                                            <div class="hstack gap-2 justify-content-center">
                                                                <button type="button" class="btn btn-link link-primary fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                                <button type="button" wire:click="delayOrder" class="btn btn-primary">Delay</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endif
                                    

                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="d-flex gap-1 flex-wrap">
                                                <button type="button" wire:click="updateOrder" class="btn btn-success btn-label right ms-auto"><i class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Update</button>
                                            </div>
                                        </div>
                                    </div>

                                @endif        
               
                            @endif
                        </div>
                        <!-- end col -->

                        
                        
                        <div class="col-xl-4">
                            <div class="sticky-side-div">

                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <h5 class="card-title flex-grow-1 mb-0">Customer Details </h5>
                                              
                                            @if ($moderator_can_edit)
                                                
                                                @if (!$edit_order_ability)
                                                    @if ($order_status_is_proccessing_or_confirmed)
                                                        <div class="text-end">
                                                            <button type="button" wire:click="change_order_edit_ability" class="btn btn-warning btn-sm waves-effect waves-light"><i class=" ri-edit-2-fill"></i></button>
                                                        </div>
                                                    @endif
                                                @endif
                                                
                                            @endif


                                            
                                        </div>
                                        @if (\Session::has('order_updated_message'))
                                            <div 
                                                style="z-index: 11"
                                                x-data="{ show: true }"
                                                x-show="show"
                                                x-transition
                                                x-init="setTimeout(() => show = false, 6000)" 
                                                >
                                            
                                                <div class="text-success-emphasis" id="success_message">
                                                    
                                                        {!! \Session::get('order_updated_message') !!}
                                                    
                                                </div>

                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0 vstack gap-3">
                                            

                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-light">
                                                    <input type="text" wire:model="customer_name" placeholder="Customer name" id="customer_name" class="form-control bg-light border-0" value="{{ $customer_name }}" @if (!$edit_order_ability) readonly @endif >
                                                </div>
                                                
                                                @error('customer_name')
                                                    <div>
                                                        <div style="color: red">{{ $message }}</div> 
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-light">
                                                    <input type="text" wire:model="customer_address" placeholder="Customer address" id="customer_address" class="form-control bg-light border-0" value="{{ $customer_address }}" @if (!$edit_order_ability) readonly @endif >
                                                </div>
                                                
                                                @error('customer_address')
                                                    <div>
                                                        <div style="color: red">{{ $message }}</div> 
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-light">
                                                    <input type="text" wire:model="customer_phone" placeholder="Customer phone" id="customer_phone" class="form-control bg-light border-0" value="{{ $customer_phone }}" @if (!$edit_order_ability) readonly @endif >
                                                </div>
                                                
                                                @error('customer_phone')
                                                    <div>
                                                        <div style="color: red">{{ $message }}</div> 
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-light">
                                                    <select wire:model.live="city" class="form-control bg-light border-0" id="city" required @if (!$edit_order_ability) disabled @endif>
                                                        <option value="">Select City</option>
                                                        @foreach ($shippingRates as $city_name => $rate)

                                                            <option value="{{ $city_name }}">{{ $city_name }}</option>
                                                            
                                                        @endforeach
                                                        
                                                    </select>
                                                </div>
                                                
                                                @error('city')
                                                    <div>
                                                        <div style="color: red">{{ $message }}</div> 
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-light">
                                                    <input type="text" wire:model="customer_phone_2" placeholder="Customer phone 2 (optional)" id="customer_phone_2" class="form-control bg-light border-0" value="{{ $customer_phone_2 }}" @if (!$edit_order_ability) readonly @endif>
                                                </div>
                                                
                                                @error('customer_phone_2')
                                                    <div>
                                                        <div style="color: red">{{ $message }}</div> 
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-12 col-sm-12">
                                                <div>
                                                    <textarea class="form-control bg-light border-0" wire:model="order_notes" id="order_notes" rows="3" placeholder="order notes (optional)" @if (!$edit_order_ability) readonly @endif></textarea>
                                                </div>
    
                                                @error('order_notes')
                                                    <div>
                                                        <div style="color: red">{{ $message }}</div> 
                                                    </div>
                                                @enderror
                                            </div>


                                            @if ($edit_order_ability)
                                                <div class="text-end">
                                                    <button type="button" wire:click="editOrder({{$order_id}})" class="btn btn-warning waves-effect waves-light right ms-auto">Update</button>
                                                </div>
                                            @endif
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


@script
<script>

    const today = new Date();

    
    const tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);
    const tomorrowYearAfter = tomorrow.getFullYear();
    const tomorrowMonthAfter = String(tomorrow.getMonth() + 1).padStart(2, '0');
    const tomorrowDayAfter = String(tomorrow.getDate()).padStart(2, '0');
    const formattedTomorrow = `${tomorrowYearAfter}-${tomorrowMonthAfter}-${tomorrowDayAfter}`;

    const sixDaysAfter = new Date(today);
    sixDaysAfter.setDate(today.getDate() + 6);
    const yearAfter = sixDaysAfter.getFullYear();
    const monthAfter = String(sixDaysAfter.getMonth() + 1).padStart(2, '0');
    const dayAfter = String(sixDaysAfter.getDate()).padStart(2, '0');
    const formattedDateAfter = `${yearAfter}-${monthAfter}-${dayAfter}`;

    

    flatpickr("#date-picker-input", {
        enable: [
            {
                from: formattedTomorrow,
                to: formattedDateAfter
            },
        ]
    });
</script>
@endscript