<div>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <h4 class="fs-16 mb-1" style="font-weight: 600">Good Morning, {{ $user->name }}! 
                                                
                                            </h4>
                                            
                                      
                                        </div>
                                        <div class="mt-3 mt-lg-0">
                                            <div class="row g-3 mb-0 align-items-center">
                                                <div class="col-sm-auto">
                                                    <div class="input-group">

                                                        <input type="text" wire:model.live="date" id="date-picker-input" class="form-control border-0 dash-filter-picker shadow" placeholder="{{ $startDate }} to {{ $endDate }}">
                                                        <div class="input-group-text bg-primary border-primary text-white">
                                                            <i class="ri-calendar-2-line"></i>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                
                                               
                                            </div>
                                            <!--end row-->
                                        </div>
                                    </div><!-- end card header -->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->

                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0" style="font-size: 16px">
                                                        Earnings</p>
                                                </div>
                                                
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span>{{ $total_user_earnings }}</span> L.E
                                                    </h4>
                                                    
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                                        <i class="bx bx-dollar-circle text-success"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0" style="font-size: 16px">
                                                        All Orders</p>
                                                </div>
                                                
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span>{{ $orders_count }}</span></h4>
                                                    
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-info-subtle rounded fs-3">
                                                        <i class="bx bx-shopping-bag text-info"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0" style="font-size: 16px">
                                                        Delivered Orders</p>
                                                </div>
                                                
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span>{{ $delivered_orders_count }}</span>
                                                    </h4>
                                                   
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-light-subtle rounded fs-3">
                                                        <i class="bx bx-shopping-bag text-success"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0" style="font-size: 16px">
                                                        My Balance</p>
                                                </div>
                                               
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span>{{ $total_user_balance }}</span> L.E
                                                    </h4>
                                                    
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                        <i class="bx bx-wallet text-primary"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                            </div> <!-- end row-->

                            

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1" style="font-size: 17px; font-weight: 600">Best Selling Products</h4>
                                            
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                                    <tbody>
                                                        @foreach($topProducts as $product)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                            <img src="{{ asset('assets/images/products/product-placeholder.png') }}" alt="" class="img-fluid d-block" />
                                                                        </div>
                                                                        <div>
                                                                            <h5 class="fs-13 my-1 fw-semibold" >
                                                                                <a href="apps-ecommerce-product-details.html" class="text-reset">
                                                                                    {{ $product->title }}
                                                                                </a>
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h5 class="fs-14 my-1 fw-semibold">{{ $product->lowest_selling_price }} L.E</h5>
                                                                    <span class="text-muted">Lowest Selling Price</span>
                                                                </td>
                                                                <td>
                                                                    <h5 class="fs-14 my-1 fw-semibold">{{ $product->current_stock }}</h5>
                                                                    <span class="text-muted">Stock</span>
                                                                </td>
                                                                <td>
                                                                    <h5 class="fs-14 my-1 fw-semibold">{{ $product->total_quantity }} pieces</h5>
                                                                    <span class="text-muted">Sold</span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        

                                                        
                                                    </tbody>
                                                </table>
                                            </div>

                                            

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1" style="font-size: 17px; font-weight: 600">Recent Orders</h4>
                                            
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                    <thead class="text-muted table-light">
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Customer</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Total</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($latest_orders as $order)
                                                        
                                                            <tr>
                                                                <td>
                                                                    <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">{{ $order->id }}</a>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        
                                                                        <div class="flex-grow-1">{{ $order->shipping_name }}</div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $order->created_at->format('Y-m-d') }} <small class="text-muted">{{ $order->created_at->format('h:i a') }}</small></td>
                                                                <td>
                                                                    <span class="text-success">{{ $order->total }} L.E</span>
                                                                </td>
                                                                <td>
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
                                                                    </span>
                                                                    
                                                                </td>
                                                            
                                                            </tr><!-- end tr -->
                                                            @endforeach


                                                            
                                                        </tbody><!-- end tbody -->
                                                    </table><!-- end table -->
                                                </div>

                                                

                                            </div> <!-- .card-body-->
                                        </div> <!-- .card-->
                                    </div> <!-- .col-->
                                </div> <!-- end row-->

                                

                            </div> <!-- end .h-100-->

                        </div> <!-- end col -->

                        
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->

</div>

@script
<script>

    let startDate = "{{ $startDate }}";
    let endDate = "{{ $endDate }}";

    
    flatpickr("#date-picker-input", {
        mode: "range",
        dateFormat: "Y-m-d",
        defaultDate: [startDate, endDate]
    });
</script>
@endscript