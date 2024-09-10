<x-app-layout>

    @section('extra-css')
        <!-- Plugins css -->
        <link href="{{ asset('assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
    @stop

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Edit Product</h4>
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

                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" id="editproduct-form" >
                    @csrf

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-title-input">Product Title</label>
                                        <input type="text" name="title" value="{{ $product->title }}" class="form-control" id="product-title-input" value="" placeholder="Enter product title" required autofocus>
                                        <div class="invalid-feedback">Please Enter a product title.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label>Product Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="9">{{ $product->description }}</textarea>
                                    </div>
                                    @if ($product->is_private == 1)
                                        <div class="mb-3">
                                            <label class="form-label" for="product-title-input">Assigned user by email <span style="color: red">"private product"</span></label>
                                            <input type="text" value="{{ $product->users()->get()->first()->email }}" class="form-control" id="product-assigned-user-input" value="" placeholder="Enter assigned user email (optional)" disabled>
                                        </div>   
                                    @endif
                                </div>
                            </div>
                            <!-- end card -->
                            

                            
                            
                        </div>
                        <!-- end col -->

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Publish</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="choices-publish-status-input" class="form-label">Status</label>

                                        <select class="form-select" name="is_published" id="choices-publish-status-input" aria-label="Disabled">
                                                <option value="Published" @if ($product->is_published == 1) selected @endif>Published</option>   
                                                <option value="Draft" @if ($product->is_published == 0) selected @endif>Draft</option>
                                        </select>
                                    </div>

                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Product prices</h5>
                                </div>
                                <!-- end card body -->
                                <div class="card-body">
                                    <div>
                                        <label for="price" class="form-label">Cost</label>
                                        <input type="number" value="{{ $product->cost }}" name="cost" id="cost" class="form-control" placeholder="Enter cost" required>
                                    </div>

                                    <div class="mt-3">
                                        <label for="price" class="form-label">Break even price</label>
                                        <input type="number" value="{{ $product->break_even_price }}" name="break_even_price" id="break_even_price" class="form-control" placeholder="Enter break even price" required>
                                    </div>

                                    <div class="mt-3">
                                        <label for="price" class="form-label">Lowest selling price</label>
                                        <input type="number" value="{{ $product->lowest_selling_price }}" name="lowest_selling_price" id="lowest_selling_price" class="form-control" placeholder="Enter lowest selling price" required>
                                    </div>

                                </div>

                                
                            </div>
                            <!-- end card -->

                            <div class="text-end mb-3">
                                <button type="submit" class="btn btn-success w-sm">Submit</button>
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

        <script src="{{ asset('assets/js/pages/ecommerce-product-create.init.js') }}"></script>
    @stop


</x-app-layout>   