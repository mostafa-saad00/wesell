<x-app-layout>

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
                                            <h4 class="fs-16 mb-1" style="font-weight: 600">Good Morning, {{ $user->name }}!</h4>
                                         
                                        </div>
                                        <div class="mt-3 mt-lg-0">
                                            <div class="row g-3 mb-0 align-items-center">
                                                <div class="col-sm-auto">
                                                    <div class="input-group">

                                                        <input type="text" id="date-picker-input" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                        <div class="input-group-text bg-primary border-primary text-white">
                                                            <i class="ri-calendar-2-line"></i>
                                                        </div>
                                                        <script>
                                                            flatpickr("#date-picker-input", {
                                                                mode: "range",
                                                                dateFormat: "Y-m-d",
                                                                
                                                            });
                                                        </script>
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
                                                        Total Earnings</p>
                                                </div>
                                                
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="559.25">0</span> L.E
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
                                                        Orders</p>
                                                </div>
                                                
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="36894">0</span></h4>
                                                    
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
                                                        Customers</p>
                                                </div>
                                                
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="183.35">0</span>M
                                                    </h4>
                                                   
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                        <i class="bx bx-user-circle text-warning"></i>
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
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="165.89">0</span>k
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
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                        <img src="{{ asset('assets/images/products/product-placeholder.png') }}" alt="" class="img-fluid d-block" />
                                                                    </div>
                                                                    <div>
                                                                        <h5 class="fs-13 my-1 fw-semibold" >
                                                                            <a href="apps-ecommerce-product-details.html" class="text-reset">
                                                                                Branded T-Shirts
                                                                            </a>
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-semibold">$29.00</h5>
                                                                <span class="text-muted">Price</span>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-semibold">62</h5>
                                                                <span class="text-muted">Orders</span>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-semibold">510</h5>
                                                                <span class="text-muted">Stock</span>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-semibold">$1,798</h5>
                                                                <span class="text-muted">Amount</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                        <img src="{{ asset('assets/images/products/product-placeholder.png') }}" alt="" class="img-fluid d-block" />
                                                                    </div>
                                                                    <div>
                                                                        <h5 class="fs-13 my-1 fw-semibold" >
                                                                            <a href="apps-ecommerce-product-details.html" class="text-reset">
                                                                                Branded T-Shirts
                                                                            </a>
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-semibold">$29.00</h5>
                                                                <span class="text-muted">Price</span>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-semibold">62</h5>
                                                                <span class="text-muted">Orders</span>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-semibold">510</h5>
                                                                <span class="text-muted">Stock</span>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-semibold">$1,798</h5>
                                                                <span class="text-muted">Amount</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                        <img src="{{ asset('assets/images/products/product-placeholder.png') }}" alt="" class="img-fluid d-block" />
                                                                    </div>
                                                                    <div>
                                                                        <h5 class="fs-13 my-1 fw-semibold" >
                                                                            <a href="apps-ecommerce-product-details.html" class="text-reset">
                                                                                Branded T-Shirts
                                                                            </a>
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-semibold">$29.00</h5>
                                                                <span class="text-muted">Price</span>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-semibold">62</h5>
                                                                <span class="text-muted">Orders</span>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-semibold">510</h5>
                                                                <span class="text-muted">Stock</span>
                                                            </td>
                                                            <td>
                                                                <h5 class="fs-14 my-1 fw-semibold">$1,798</h5>
                                                                <span class="text-muted">Amount</span>
                                                            </td>
                                                        </tr>

                                                        
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
                                                            <th scope="col">Order ID</th>
                                                            <th scope="col">Customer</th>
                                                            <th scope="col">Product</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#VZ2112</a>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    
                                                                    <div class="flex-grow-1">Alex Smith</div>
                                                                </div>
                                                            </td>
                                                            <td>Clothes</td>
                                                            <td>
                                                                <span class="text-success">109.00 L.E</span>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-success-subtle text-success">Paid</span>
                                                            </td>
                                                           
                                                        </tr><!-- end tr -->
                                                        <tr>
                                                            <td>
                                                                <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#VZ2112</a>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    
                                                                    <div class="flex-grow-1">Alex Smith</div>
                                                                </div>
                                                            </td>
                                                            <td>Clothes</td>
                                                            <td>
                                                                <span class="text-success">109.00 L.E</span>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-success-subtle text-success">Paid</span>
                                                            </td>
                                                           
                                                        </tr><!-- end tr -->
                                                        <tr>
                                                            <td>
                                                                <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#VZ2112</a>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    
                                                                    <div class="flex-grow-1">Alex Smith</div>
                                                                </div>
                                                            </td>
                                                            <td>Clothes</td>
                                                            <td>
                                                                <span class="text-success">109.00 L.E</span>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-success-subtle text-success">Paid</span>
                                                            </td>
                                                           
                                                        </tr><!-- end tr -->


                                                        
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
   
</x-app-layout>
