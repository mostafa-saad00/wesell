<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Return orders</h4>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="row g-2">
                                            <div class="col">
                                                <div class="position-relative mb-3">
                                                    <input type="text" id="orderCode" wire:model.live="orderCode" wire:keydown.enter="searchOrder" class="form-control form-control-lg bg-light border-light" placeholder="Search by order code..." autofocus>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="buttom" wire:click="searchOrder" class="btn btn-danger btn-lg waves-effect waves-light"><i class="mdi mdi-magnify me-1"></i> Search</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    
                                </div>
                                <!--end row-->

                                
                            </div>

                            
                            <!--end card-body-->
                        </div>
                        <!--end card -->


                        @if ($order_not_found)
                            <div>
                                     
                                <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                                    <i class="ri-error-warning-line me-3 align-middle"></i> <strong>No Order Found</strong> - make sure that the order code is correct.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                            </div>

                        @endif 



                        @if(session('success'))
                            <div 
                                style="z-index: 11"
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 3000)" 
                                >
                            
                            
                                <div class="tab-pane" id="pills-finish" role="tabpanel" aria-labelledby="pills-finish-tab">
                                    <div class="text-center py-5">
    
                                        <div class="mb-4">
                                            <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon>
                                        </div>
                                        <p style="font-size: 20px; font-weight: 600">Success!</p>
                                        <p style="font-size: 16px; font-weight: 400">The order has returned</p>
    
                                      
                                    </div>
                                </div>
                            
                                

                            </div>
                        @endif



                        @if ($order)

                            <div class="card">

                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="card">
                                            <div class="card-body checkout-tab">
            
                                                <form action="#">
                                                    
            
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">

                                                            <div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="mb-3">
                                                                            <label for="billinginfo-firstName" class="form-label">
                                                                                Name</label>
                                                                            <input type="text" class="form-control" id="billinginfo-firstName" value="{{ $order->shipping_name }}" readonly disabled>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="col-sm-6">
                                                                        <div class="mb-3">
                                                                            <label for="billinginfo-lastName" class="form-label">
                                                                                Phone</label>
                                                                            <input type="text" class="form-control" id="billinginfo-lastName" value="{{ $order->shipping_phone }}" readonly disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
            
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="mb-3">
                                                                            <label for="billinginfo-lastName" class="form-label">Last
                                                                                Phone 2</label>
                                                                            <input type="text" class="form-control" id="billinginfo-lastName"  value="{{ $order->shipping_phone_2 }}" readonly disabled>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="col-sm-6">
                                                                        <div class="mb-3">
                                                                            <label for="billinginfo-lastName" class="form-label">
                                                                                City</label>
                                                                            <input type="text" class="form-control" id="billinginfo-lastName" value="{{ $order->shipping_city }}"  readonly disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="mb-3">
                                                                            <label for="billinginfo-lastName" class="form-label">
                                                                                Address</label>
                                                                            <input type="text" class="form-control" id="billinginfo-lastName" value="{{ $order->shipping_address }}"  readonly disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="mb-3">
                                                                            <label for="billinginfo-lastName" class="form-label">
                                                                                Notes</label>
                                                                            <input type="text" class="form-control" id="billinginfo-lastName" value="{{ $order->notes }}"  readonly disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
            
                                                               
                                                            </div>
                                                        </div>
                                                        <!-- end tab pane -->
            
                                                        
            
                                                        
            
                                                        
                                                        <!-- end tab pane -->
                                                    </div>
                                                    <!-- end tab content -->
                                                </form>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->
            
                                    <div class="col-xl-4">
                                        <div class="card">
                                           
                                            <div class="card-body">
                                                <div class="table-responsive table-card">
                                                    <table class="table table-borderless align-middle mb-0">
                                                       
                                                        <tbody>
                                                            @foreach ($order_items as $item)                                                                
                                                                <tr>
                                                                    <td>
                                                                        <div class="avatar-md bg-light rounded p-1">
                                                                            <img src="{{ asset('assets/images/products/product-placeholder.png') }}" alt="" class="img-fluid d-block">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="fs-14">{{ $item->product->title }}
                                                                        </h5>
                                                                        <p class="text-muted mb-0"> {{ $item->product_price }} x {{ $item->quantity }}</p>
                                                                    </td>
                                                                    <td class="text-end"> {{ $item->total_price }} EGP</td>
                                                                </tr>
                                                            @endforeach
                                                           
                                                            
                                                        </tbody>
                                                    </table>
            
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->


                                    <div class="col-xl-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h5 class="card-title mb-0">Order Summary</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive table-card">
                                                    <table class="table table-borderless align-middle mb-0">
                                                        
                                                        <tbody>
                                                            
                                                            <tr>
                                                                <td class="fw-semibold" colspan="2">Sub Total :</td>
                                                                <td class="fw-semibold text-end">{{ $order->sub_total }} EGP</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td colspan="2">Shipping Charge :</td>
                                                                <td class="text-end">{{ $order->shipping_price }} EGP</td>
                                                            </tr>
                                                            
                                                            <tr class="table-active">
                                                                <th colspan="2">Total (EGP) :</th>
                                                                <td class="text-end">
                                                                    <span class="fw-semibold">
                                                                        {{ $order->total }} EGP
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
            
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->


                                </div>
                                
                            </div>

                            <!-- Buttons Grid -->
                            <div class="d-grid gap-2" >
                                <button class="btn btn-danger btn-border" id="return_button" onclick="document.getElementById('orderCode').focus()" type="button" wire:click="return_order">Return</button>
                            </div>

                         

                        @endif


                    </div>
                    <!--end card -->
                </div>
                <!--end row-->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
</div>

