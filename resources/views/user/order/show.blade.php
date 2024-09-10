<x-app-layout>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Order Details</h4>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-9">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title flex-grow-1 mb-0">Order #VL2667</h5>
                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-nowrap align-middle table-borderless mb-0">
                                        <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col">Product Details</th>
                                                <th scope="col">Item Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col" class="text-end">Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderItems->where('is_deleted', 0) as $item)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                                <img src="{{ asset('assets/images/products/product-placeholder.png') }}" alt="" class="img-fluid d-block">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h5 class="fs-14"><a href="apps-ecommerce-product-details.html" class="text-body">{{ $item->product->title }}</a></h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->product_price }} L.E</td>
                                                    <td>x{{ $item->quantity }}</td>
                                                    
                                                    <td class="fw-medium text-end">
                                                        {{ $item->total_price }} L.E
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                            <tr class="border-top border-top-dashed">
                                                <td colspan="3"></td>
                                                <td colspan="2" class="fw-medium p-0">
                                                    <table class="table table-borderless mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <td>Sub Total :</td>
                                                                <td class="text-end">{{ $order->sub_total }} L.E</td>
                                                            </tr>
                                                           
                                                            <tr>
                                                                <td>Shipping Charge :</td>
                                                                <td class="text-end">{{ $order->shipping_price }} L.E</td>
                                                            </tr>
                                                           
                                                            <tr class="border-top border-top-dashed">
                                                                <th scope="row">Total (EGP) :</th>
                                                                <th class="text-end">{{ $order->total }} L.E</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--end card-->
                        <div class="card">
                            <div class="card-header">
                                <div class="d-sm-flex align-items-center">
                                    <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>                                                                    

                                    @if ($order->order_status_name == 'processing')
                                        <div class="flex-shrink-0 mt-2 mt-sm-0">
                                            <a href="javascript:void(0);" onclick="event.preventDefault(); confirmCancelOrder({{ $order->id }});" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order</a>
                                        </div>

                                        <form id="cancel-order-form-{{ $order->id }}" action="{{ route('order.cancel', $order->id) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @endif
                                    
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
                    </div>
                    <!--end col-->
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex">
                                    <h5 class="card-title flex-grow-1 mb-0"><i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Logistics Details</h5>
                                    <div class="flex-shrink-0">
                                        <a href="javascript:void(0);" class="badge bg-primary-subtle text-primary fs-11">Track Order</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                                    <h5 class="fs-16 mt-2">Turbo Logistics</h5>
                                    <p class="text-muted mb-0">Payment Mode : Cash on Delivery</p>
                                </div>
                            </div>
                        </div>
                        <!--end card-->

                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex">
                                    <h5 class="card-title flex-grow-1 mb-0">Customer Details</h5>
                                   
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled mb-0 vstack gap-3">
                                   
                                    <li><i class=" ri-account-circle-line me-2 align-middle text-muted fs-16"></i>{{ $order->shipping_name }}</li>
                                    <li><i class="ri-map-pin-line me-2 align-middle text-muted fs-16"></i>{{ $order->shipping_address }}</li>
                                    <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $order->shipping_phone }}</li>
                                </ul>
                            </div>
                        </div>
                        <!--end card-->
                        
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
                
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->

        
    </div>
    <!-- end main content-->



</x-app-layout>   