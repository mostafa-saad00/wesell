<x-app-layout>



    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit customer ({{ $customer->name }})</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

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

                @if($errors->any())
                    <div 
                        style="z-index: 11"
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 4000)" 
                        >
                    
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{$error }}</li>
                                </ul>
                            </div>
                        @endforeach
                        

                    </div>
                @endif

                <form action="{{ route('admin.customer.update', $customer->id) }}" method="POST" id="createcustomer-form" >
                    @csrf

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="customer-name-input">Customer Name </label>
                                        <input type="text" name="name" class="form-control" id="customer-name-input" value="{{ $customer->name }}" placeholder="Enter customer name" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="customer-phone-input">Customer Phone </label>
                                        <input type="number" name="phone" class="form-control" id="customer-phone-input" value="{{ $customer->phone }}" placeholder="Enter customer phone" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Customer Address</label>
                                        <textarea class="form-control" name="address" id="address" rows="8" placeholder="Describe the customer here..." required>{{ $customer->address }}</textarea>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- end card -->
                            

                            
                            
                        </div>
                        <!-- end col -->

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Status</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="choices-publish-status-input" class="form-label">Status</label>

                                        <select class="form-select" name="is_blocked" id="choices-publish-status-input">
                                            <option value="active" @if ($customer->is_blocked == 0) selected @endif>Active</option>   
                                            <option value="blocked" @if ($customer->is_blocked == 1) selected @endif>Blocked</option>   

                                        </select>
                                    </div>

                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->


                            <div class="text-end mb-3">
                                <button type="submit" class="btn btn-success w-sm">Update</button>
                            </div>

                            
                            <!-- end card -->

                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                </form>

                
               
               

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

       
        
       

    </div>
    <!-- end main content-->


    
    @section('extra-javascript')
        <!-- ckeditor -->
        <script src="{{ asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

        <!-- dropzone js -->
        <script src="{{ asset('assets/libs/dropzone/dropzone-min.js') }}"></script>

        <script src="{{ asset('assets/js/pages/ecommerce-customer-create.init.js') }}"></script>
    @stop


</x-app-layout>   