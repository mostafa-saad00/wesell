<div>
    
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Orders</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="orderList">
                            <div class="card-header border-0">
                                <div class="row align-items-center gy-3">
                                    <div class="col-sm">
                                        <h5 class="card-title mb-0">All Orders</h5>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="d-flex gap-1 flex-wrap">
                                            <a href="{{ route('order.create') }}" class="btn btn-success add-btn" id="create-order"><i class="ri-add-line align-bottom me-1"></i> Create Order</a>

                                            <!-- <button type="button" class="btn btn-info"><i class="ri-file-download-line align-bottom me-1"></i> Import</button> -->
                                            
                                            <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body border border-dashed border-end-0 border-start-0">
                                
                                @if(session('custom_error'))
                                    <div 
                                        style="z-index: 11"
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 4000)" 
                                        >
                                    
                                    
                                        <div class="alert alert-danger" id="custom_error">
                                            <ul>
                                                <li>{{ session('custom_error') }}</li>
                                            </ul>
                                        </div>
                                    
                                        

                                    </div>
                                @endif

                                
                                @if(session('success'))
                                    <div 
                                        style="z-index: 11"
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 4000)" 
                                        >
                                    
                                    
                                        <div class="alert alert-success" id="success">
                                            <ul>
                                                <li>{{ session('success') }}</li>
                                            </ul>
                                        </div>
                                    
                                        

                                    </div>
                                @endif
                                
                                <form wire:submit="filterOrders">
                                    <div class="row g-3">
                                        <div class="col-xxl-6 col-sm-6">
                                            <div class="search-box">
                                                <input type="text" wire:model="searchTerm" class="form-control search" placeholder="Search for order ID, customer info or something..." autofocus>
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-sm-6">
                                            <div>
                                                <input type="text" wire:model="date_range" class="form-control flatpickr-input" id="date-picker-input" placeholder="Select date" readonly="readonly">
                                            </div>
                                        </div>
                                        
                                        <div class="col-xxl-2 col-sm-4">
                                            <div>
                                                <select class="form-control" wire:model="status" id="idStatus">
                                                    <option value="">All Statuses</option>
                                                    @foreach ($order_statuses as $status)
                                                        <option value="{{ $status->name }}">{{ $status->name }}</option>
                                                    @endforeach
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        
                                        <div class="col-xxl-1 col-sm-4">
                                            <div>
                                                <button type="submit" wire:click="filterOrders" class="btn btn-primary w-100" > <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                                    Filters
                                                </button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                            <div class="card-body pt-0 mt-3">
                                <div>
                                    <div class="table-responsive table-card mb-1">
                                        <table class="table table-nowrap align-middle" id="orderTable">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th scope="col" style="width: 25px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                        </div>
                                                    </th>
                                                    <th>Order ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Customer Phone</th>
                                                    <th>Order Date</th>
                                                    <th>Total</th>
                                                    <th>Order Status</th>
                                                    <th>Show</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach ($orders as $order)          
                                                    <tr wire:key="{{ $order->id }}">
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td class="id"><a href="{{ route('order.show', $order->id) }}" class="fw-medium link-primary">#VZ2101</a></td>
                                                        <td class="customer_name">{{ $order->shipping_name }}</td>
                                                        <td class="product_name">{{ $order->shipping_phone }}</td>
                                                        <td class="date">{{ $order->created_at->format('Y-m-d') }} <small class="text-muted">{{ $order->created_at->format('h:i a') }}</small></td>
                                                        <td class="amount">{{ $order->total }} L.E</td>
                                                        <td class="status">
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
                                                        <td>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <a href="{{ route('moderator.order_management.show', $order->id) }}" class="link-primary fs-15"><i class="ri-eye-fill"></i></a>
                                                            </div>

                                                        </td>
                                                    </tr>

                                                @endforeach

                                            </tbody>
                                        </table>


                                        
                                    </div>

                                    {{ $orders->links() }}


                                    
                                </div>
                                

                              
                            </div>
                        </div>

                    </div>
                    <!--end col-->
                </div>
                <!--end row-->



                <script>
                    function confirmCancelOrder(orderId) {
                        if (confirm('Are you sure you want to cancel this order?')) {
                            document.getElementById('cancel-order-form-' + orderId).submit();
                        }
                    }

                    
                </script>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    </div>
    <!-- end main content-->
</div>

@script
<script>
    flatpickr("#date-picker-input", {
        mode: "range",        
    });

</script>
@endscript

