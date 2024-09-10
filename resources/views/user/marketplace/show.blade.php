<x-app-layout>

    @section('extra-css')

    <style>
        .copied-message {
            display: none;
            color: green;
            margin-left: 10px;
        }
        .show {
            display: inline;
        }
    </style>
        
    @endsection

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Product Details</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row gx-lg-5">
                                    <div class="col-xl-4 col-md-8 mx-auto">
                                        <div class="product-img-slider sticky-side-div">
                                            <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <img src="{{ asset('assets/images/products/product-placeholder.png') }}" alt="" class="img-fluid d-block" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end swiper thumbnail slide -->
                                            
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-8">
                                        <div class="mt-xl-0 mt-5">
                                            <div class="d-flex">
                                                <div class="flex-grow-1 page-title-box">
                                                    <p style="font-size: 25px; font-weight: 500">{{ $product->title }}</p>
                                                    <div class="hstack gap-3 flex-wrap mt-2">
                                                        
                                                        <div>Sku : <span class="text-body fw-medium" id="product_sku">{{ $product->sku }}</span>
                                                        </div>
                              
                                                        
                                                    </div>
                                                </div>
                                                



                                                
                                                <form id="start-selling-form-{{ $product->id }}" action="{{ route('marketplace.start_selling', $product->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>

                                                
                                            </div>

                                            

                                            <div class="row mt-4">
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="p-2 border border-dashed rounded">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                    <i class="ri-money-dollar-circle-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted mb-1">Lowest Selling Price:</p>
                                                                <h5 class="mb-0" style="font-size: 16px; font-weight: 600">{{ $product->lowest_selling_price }} EGP</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="p-2 border border-dashed rounded">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                    <i class="ri-money-dollar-circle-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted mb-1">Lowest profit:</p>
                                                                <h5 class="mb-0" style="font-size: 16px; font-weight: 600">{{ $product->lowest_selling_price - $product->break_even_price }} EGP</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="p-2 border border-dashed rounded">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                    <i class="ri-stack-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted mb-1">Available Stocks :</p>
                                                                <h5 class="mb-0" style="font-size: 16px; font-weight: 600">{{ $product->current_stock }} pieces</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="p-2 border border-dashed rounded">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                    <i class="ri-inbox-archive-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted mb-1">Delivery rate:</p>
                                                                <h5 class="mb-0">No data available</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            </div>

                                            

                                            <div class="mt-4 text-muted">
                                                <h5 class="fs-13">Description :</h5>
                                                <p style="font-size: 16px; font-weight: 600">
                                                    {{ $product->description }}
                                                </p>
                                            </div>

                                            <div class="flex-shrink-0 mt-4">
                                                <div>
                                                    <a href="#" onclick="event.preventDefault(); confirmStartSelling({{ $product->id }});" class="btn btn-outline-success btn-border mb-2" >Start selling this product</a>
                                                </div>
                                            </div>


                                            <div class="product-content mt-5">
                                                <nav>
                                                    <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="nav-speci-tab" data-bs-toggle="tab" href="#nav-speci" role="tab" aria-controls="nav-speci" aria-selected="true">Details</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="false">Marketing Angels</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                                <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="nav-speci" role="tabpanel" aria-labelledby="nav-speci-tab">
                                                        <div>
                                                            <h5 class="mb-3">No data available...</h5>
                                                            <p>No data available...</p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                                                        <div>
                                                            <h5 class="mb-3">No data available...</h5>
                                                            <div>
                                                                <p class="mb-2"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>
                                                                    No data available...</p>
                                                                <p class="mb-2"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>
                                                                    No data available...</p>
                                                                <p class="mb-2"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>
                                                                    No data available...</p>
                                                                <p class="mb-0"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>
                                                                    No data available...</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <!-- product-content -->

                                            
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
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



    @section('extra-javascript')

    <script>
        function confirmStartSelling(productId) {
            if (confirm('Are you sure you want to start selling this product?')) {
                document.getElementById('start-selling-form-' + productId).submit();
            }
        }
    </script>

    <script>
        function copySku()
        {
           // Get the SKU text
            var skuText = document.getElementById('product_sku').innerText;
            
            // Use the Clipboard API to copy the text
            navigator.clipboard.writeText(skuText).then(function() {
                // Show the "Copied" message
                var copiedMessage = document.getElementById('copied-message');
                copiedMessage.classList.add('show');
                
                // Remove the message after a short delay
                setTimeout(function() {
                    copiedMessage.classList.remove('show');
                }, 2000);
            }).catch(function(error) {
                console.error('Error copying text: ', error);
            });
        }
    </script>
        
    @endsection
</x-app-layout> 