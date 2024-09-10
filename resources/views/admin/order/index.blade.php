<x-app-layout>


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                @if (\Session::has('success'))
                    <div 
                        style="z-index: 11"
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 4000)" 
                        >
                    
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>

                    </div>
                @endif


                
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="orderList">
                            <div class="card-header border-0">
                                <div class="row align-items-center gy-3">
                                    <div class="col-sm">
                                        <h5 class="card-title mb-0">Order History</h5>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="d-flex gap-1 flex-wrap">
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Order</button>
                                            <button type="button" class="btn btn-info"><i class="ri-file-download-line align-bottom me-1"></i> Import</button>
                                            <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border border-dashed border-end-0 border-start-0">
                                <form>
                                    <div class="row g-3">
                                        <div class="col-xxl-5 col-sm-6">
                                            <div class="search-box">
                                                <input type="text" class="form-control search" placeholder="Search for order ID, customer, order status or something..." autofocus>
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-6">
                                            <div>
                                                <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" id="demo-datepicker" placeholder="Select date">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-4">
                                            <div>
                                                <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                                    <option value="">Status</option>
                                                    <option value="all" selected>All</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Inprogress">Inprogress</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                    <option value="Pickups">Pickups</option>
                                                    <option value="Returns">Returns</option>
                                                    <option value="Delivered">Delivered</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-4">
                                            <div>
                                                <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idPayment">
                                                    <option value="">Select Payment</option>
                                                    <option value="all" selected>All</option>
                                                    <option value="Mastercard">Mastercard</option>
                                                    <option value="Paypal">Paypal</option>
                                                    <option value="Visa">Visa</option>
                                                    <option value="COD">COD</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-1 col-sm-4">
                                            <div>
                                                <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                                    Filters
                                                </button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                           

                        </div>

                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                


                <div class="row">

                    @foreach ($orders as $order)
                        
                    
                    <div class="col-xxl-3 col-sm-6 project-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="p-3 mt-n3 mx-n3 bg-success-subtle rounded-top">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-0 fs-14"><a href="apps-projects-overview.html" class="text-body">{{ $order->created_at->diffForHumans() }}</a></h5>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="d-flex gap-1 align-items-center my-n2">
                                                <div class="dropdown">
                                                    <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i data-feather="more-horizontal" class="icon-sm"></i>
                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                            View</a>
                                                        <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-3">
                                    <div class="row gy-3">
                                        <div class="col-6">
                                            <div>
                                                <p class="text-bold mb-1">Status</p>
                                                <div class="badge bg-warning-subtle text-warning fs-12">{{ $order->order_status_name }}</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <p class="text-bold mb-1">Date</p>
                                                <h5 class="fs-13">{{ $order->created_at->format('Y-m-d') }} </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mt-3">
                                        <p class="text-bold mb-0 me-2">Name :</p>
                                        <span class="text-muted mb-0 me-2">{{ $order->shipping_name }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mt-3">
                                        <p class="text-bold mb-0 me-2">Phone :</p>
                                        <span class="text-muted mb-0 me-2">{{ $order->shipping_phone }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mt-3">
                                        <p class="text-bold mb-0 me-2">Address :</p>
                                        <span class="text-muted mb-0 me-2">{{ $order->shipping_address }}</span>
                                    </div>
                                </div>

                                

                                
                                    
                                    @if (!$order->OrderItems->isEmpty())
                                        @foreach ($order->OrderItems as $item)
                                            <div class="d-flex align-items-center mt-3">
                                                <p class="text-bold mb-0 me-2">Product :</p>
                                                <span class="text-muted mb-0 me-2">{{ \App\Models\Product::find($item->product_id)->title }}</span>
                                            </div>
                                        @endforeach
                                    @endif

                                    
                                 
                                


                              
                                
                                
                                


                                <div>
                                    <div class="d-flex mb-2">
                                        <div class="flex-grow-1">
                                            <div>Total</div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div>{{ $order->total }} EGP</div>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm animated-progress">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 15%;">
                                        </div><!-- /.progress-bar -->
                                    </div><!-- /.progress -->
                                </div>

                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                    @endforeach


                    <div class="card-body pt-0">
                        <div>
                           

                          
                            <div class="d-flex justify-content-end">
                                <div class="pagination-wrap hstack gap-2">
                                    <a class="page-item pagination-prev disabled" href="#">
                                        Previous
                                    </a>
                                    <ul class="pagination listjs-pagination mb-0"></ul>
                                    <a class="page-item pagination-next" href="#">
                                        Next
                                    </a>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    
                </div>
                <!-- end row -->



            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->





</x-app-layout>   
