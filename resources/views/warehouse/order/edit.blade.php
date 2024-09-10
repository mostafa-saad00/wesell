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

                

                <h1>
                    Warehouse edit
                </h1>
            
               

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