<x-app-layout>
   
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-sm-0" style="font-size: 18px;font-weight: 600">Wallet</h3>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xxl-3">
                        <div class="card">
                            <div class="card-body p-4">
                                <div>
                                    <div class="flex-shrink-0 avatar-md mx-auto">
                                        <div class="avatar-title bg-light rounded">
                                            <img src="{{ asset('assets/images/brands/store-logo-placeholder.png') }} " alt="" height="50" />
                                        </div>
                                    </div>
                                 
                                    <div class="table-responsive mt-4">
                                        <table class="table mb-0 table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th><span style="font-size: 15px;font-weight: 500">Store Name</span></th>
                                                    <td><span style="font-size: 15px;font-weight: 400">{{ $user->store_name }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th><span style="font-size: 15px;font-weight: 500" >Owner Name</span></th>
                                                    <td><span style="font-size: 15px;font-weight: 400">{{ $user->name }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th><span style="font-size: 15px;font-weight: 500" >Email</span></th>
                                                    <td><span style="font-size: 15px;font-weight: 400">{{ $user->email }}</span></td>
                                                </tr>

                                                <tr>
                                                    <th><span style="font-size: 15px;font-weight: 500" >Phone</span></th>
                                                    <td><span style="font-size: 15px;font-weight: 400">{{ $user->phone }}</span></td>
                                                </tr>

                                                @if ($user->store_domain)
                                                <tr>
                                                    <th><span style="font-size: 15px;font-weight: 500" >Website</span></th>
                                                    <td><a href="{{ $user->store_domain }}" target="_blank" style="font-size: 15px" class="link-primary">{{ $user->store_domain }}</a></td>
                                                </tr>
                                                @endif
                                               
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                            
                            
                          
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->

                    <div class="col-xxl-9">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1" style="font-size: 18px;font-weight: 600">Wallet</h4>
                                <div>
                                    <!-- Grids in modals -->
                                    <a href="apps-ecommerce-add-product.html" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#exampleModalgrid"><i class="las la-money-bill-wave align-bottom me-1" style="font-size: 22px"></i> Withdraw Earnings</a>


                                   
                                    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalgridLabel">Withdraw Earnings</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="javascript:void(0);">
                                                        <div class="row g-3">
                                                            <div class="col-xxl-12">
                                                                <div>
                                                                    <label for="firstName" class="form-label">Amount (EGP)</label>
                                                                    <input type="text" class="form-control" id="firstName" placeholder="Enter firstname">
                                                                </div>
                                                            </div><!--end col-->
                                                            <div class="col-xxl-12">
                                                                <div>
                                                                    <label for="lastName" class="form-label">Wallet number</label>
                                                                    <input type="text" class="form-control" id="lastName" placeholder="Enter lastname">
                                                                </div>
                                                            </div><!--end col-->
                                                            
                                                            <div class="col-lg-12">
                                                                <div class="hstack gap-2 justify-content-end">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Withdraw</button>
                                                                </div>
                                                            </div><!--end col-->
                                                        </div><!--end row-->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div><!-- end card header -->

                            <div class="card-header p-0 border-0 bg-light-subtle">
                                <div class="row g-0 text-center">
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1"><span class="counter-value" data-target="7585" style="font-size: 18px;font-weight: 600">0</span>
                                            </h5>
                                            <p class=" mb-0">All Orders</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1"><span class="counter-value" data-target="3585" style="font-size: 18px;font-weight: 600">0</span>
                                            </h5>
                                            <p class="mb-0">Delivered Orders</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1 fw-semibold"><span class="counter-value" data-target="22.89" style="font-size: 18px;font-weight: 600">0</span> L.E</h5>
                                            <p class="mb-0">All Earnings</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1 fw-semibold text-success"><span class="counter-value" data-target="22.89" style="font-size: 18px;font-weight: 600">0</span> L.E</h5>
                                            <p class="mb-0">Balance</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    
                                </div>
                            </div><!-- end card header -->

                            
                        </div><!-- end card -->

                       
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header border-0">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1" style="font-size: 18px;font-weight: 600">Invoices</h5>
                                       
                                    </div>
                                </div>

                                

                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive table-card">

                                            <table class="table align-middle table-bordered border-dark" id="invoiceTable">
                                                <thead class="text-muted">
                                                    <tr>
                                                        
                                                        <th class="text-uppercase">Transaction Date</th>
                                                        <th class="text-uppercase">Amount added/subtracted</th>
                                                        <th class="text-uppercase">Type</th>
                                                        <th class="text-uppercase">Notes</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody class="list" id="invoice-list">
                                                    <tr>
                                                        
                                                        <td>12-08-2023</td>
                                                        <td>150 L.E</td>
                                                        <td>Profit</td>
                                                        <td>...</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td>25-08-2023</td>
                                                        <td>200 L.E</td>
                                                        <td>Withdraw</td>
                                                        <td>...</td>
                                                        
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    
                                                    <h5 class="mt-2">No Result Found!</h5>
                                                    <p class="text-muted mb-0">There is no data yet to show</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    
                                </div>


                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="card-header border-0">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1" style="font-size: 18px;font-weight: 600">Latest Transactions</h5>
                                       
                                    </div>
                                </div>

                                

                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive table-card">

                                            <table class="table align-middle table-bordered border-dark" id="invoiceTable">
                                                <thead class="text-muted">
                                                    <tr>
                                                        
                                                        <th class="text-uppercase">Amount</th>
                                                        <th class="text-uppercase">Payment method</th>
                                                        <th class="text-uppercase">Beneficiary</th>
                                                        <th class="text-uppercase">Status</th>
                                                        <th class="text-uppercase">Date</th>
                                                        <th class="text-uppercase">Refusal reason</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody class="list" id="invoice-list">
                                                    <tr>
                                                        
                                                        <td>311</td>
                                                        <td>Vodafone cash</td>
                                                        <td>01234567890</td>
                                                        <td>Successful</td>
                                                        <td>6/25/2024</td>
                                                        <td>...</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td>355</td>
                                                        <td>Vodafone cash</td>
                                                        <td>01234567890</td>
                                                        <td>Successful</td>
                                                        <td>2/23/2024</td>
                                                        <td>...</td>
                                                        
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    
                                                    <h5 class="mt-2">No Result Found!</h5>
                                                    <p class="text-muted mb-0">There is no data yet to show</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    
                                </div>


                            </div>
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
    
   
</x-app-layout>
