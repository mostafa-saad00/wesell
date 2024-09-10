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

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Customers</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    
                    <!-- end col -->

                    <div class="col-xl-12 col-lg-12">
                        <div>
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="row g-4">
                                        <div class="col-sm">
                                            <div class="col-sm-auto">
                                                <div class="search-box ms-2">
                                                    <input type="text" class="form-control" id="searchcustomerList" placeholder="Search customers..." autofocus>
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div>
                                                <a href="{{ route('admin.customer.create') }}" class="btn btn-success" id="addcustomer-btn"><i class="ri-add-line align-bottom me-1"></i> Add customer</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
 
                            </div>

                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customers as $customer)
                                                <tr>
                                                    <td><a href="#" class="fw-semibold">{{ $customer->name }}</a></td>
                                                    <td><a href="#" class="fw-semibold">{{ $customer->phone }}</a></td>
                                                    <td><a href="#" class="fw-semibold">{{ $customer->address }}</a></td>

                                                    <td>
                                                        <div class="hstack gap-3 flex-wrap">
                                                            <a href="{{ route('admin.customer.edit', $customer->id) }}" class="link-primary fs-15"><i class="ri-edit-2-line"></i></a>
                                                            <a href="#" onclick="event.preventDefault(); confirmDelete({{ $customer->id }});" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                                            <form id="delete-form-{{ $customer->id }}" action="{{ route('admin.customer.destroy', $customer->id) }}" method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            
                                            <script>
                                                function confirmDelete(customerId) {
                                                    if (confirm('Are you sure you want to delete this customer?')) {
                                                        document.getElementById('delete-form-' + customerId).submit();
                                                    }
                                                }
                                            </script>
                                            
                                        </tbody>
                                        
                                    </table>
                                    <!-- end table -->
                                </div>
                                <!-- end table responsive -->
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->


            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->


</x-app-layout>   