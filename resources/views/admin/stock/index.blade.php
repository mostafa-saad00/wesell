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

             

                <div class="card" id="contactList">
                    <div class="card-header">
                        <div class="row align-items-center g-3">
                            <div class="col-md-3">
                                <h5 class="card-title mb-0">All Transactions ({{ $product->title }})</h5>
                            </div>
                            <!--end col-->
                            <div class="col-md-auto ms-auto">
                                <div class="d-flex gap-2">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" placeholder="Search for transactions...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                    <button class="btn btn-success"><i class="ri-equalizer-line align-bottom me-1"></i> Filters</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-header-->
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th></th>
                                        <th>Timestamp</th>
                                        <th>Quantity Change</th>
                                        <th >Transaction Type</th>
                                        <th>Source</th>
                                        
                                    </tr>
                                    <!--end tr-->
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($stock_movements as $movement)
                                        <tr>
                                            <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ001</a></td>
                                            <td>
                                                @if ($movement->type == 'addition')
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title bg-success-subtle text-success rounded-circle fs-16">
                                                            <i class="ri-arrow-right-up-fill"></i>
                                                        </div>
                                                    </div>

                                                @elseif ($movement->type == 'deduction')
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title bg-danger-subtle text-danger rounded-circle fs-16">
                                                            <i class="ri-arrow-left-down-fill"></i>
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                            </td>
                                            <td class="date">{{ $movement->created_at->format('Y-m-d') }} <small class="text-muted">{{ $movement->created_at->format('h:i A') }}</small></td>
                                            
                                            @if ($movement->type == 'addition')
                                                <td>
                                                    <h6 class="text-success mb-1 amount">+{{ $movement->quantity_change }}</h6>
                                                </td>
                                            @elseif ($movement->type == 'deduction')
                                                <td>
                                                    <h6 class="text-danger mb-1 amount">{{ $movement->quantity_change }}</h6>
                                                </td>
                                            @endif
                                            
                                            <td class="to_name">{{ $movement->type }}</td>
                                            <td class="details">{{ $movement->source }}</td>
                                            
                                        </tr>
                                        <!--end tr-->
                                    @endforeach
                                    
                                    
                                    
                                    <!--end tr-->
                                </tbody>
                            </table>
                            <!--end table-->
                           
                        </div>
                        
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->


            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->





</x-app-layout>   
