<div>
    
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">ِAll roducts</h4>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="orderList">
                            


                            <div class="card-body border border-dashed border-end-0 border-start-0">
                                
                                @if(session('custom_error'))
                                    <div 
                                        style="z-index: 11"
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 4000)" 
                                        >
                                    
                                    
                                        <div class="alert alert-danger" id="custom_error">
                                            <ul>
                                                <li>{{ session('custom_error') }}</li>
                                            </ul>
                                        </div>
                                    
                                        

                                    </div>
                                @endif

                                
                                @if(session('success'))
                                    <div 
                                        style="z-index: 11"
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 4000)" 
                                        >
                                    
                                    
                                        <div class="alert alert-success" id="success">
                                            <ul>
                                                <li>{{ session('success') }}</li>
                                            </ul>
                                        </div>
                                    
                                        

                                    </div>
                                @endif
                                
                                <form wire:submit="filterMarketplace">
                                    <div class="row g-3">
                                        <div class="col-xxl-5 col-sm-5">
                                            <div class="search-box">
                                                <input type="text" wire:model="searchTerm" class="form-control search" placeholder="Search for product title, description, sku..." autofocus>
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-4">
                                            <div>
                                                <select class="form-control" wire:model.live="records" id="idrecords">
                                                    <option value="15">15 record in the page</option>
                                                    <option value="30">30 record in the page</option>
                                                    <option value="50">50 record in the page</option>
                                                    <option value="100">100 record in the page</option>
                                                   
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-4">
                                            <div>
                                                <select class="form-control" wire:model.live="sorting" id="idsorting">
                                                    <option value="created_at">Latest products</option>
                                                    <option value="updated_at">updated date</option>
                                                    <option value="lowest_selling_price">Price (High to Low)</option>
                                                   
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-4">
                                            <div>
                                                <select class="form-control" wire:model.live="quantity" id="idquantity">
                                                    <option value="0">All Quantities</option>
                                                    <option value="50">More than 50 pisces</option>
                                                    <option value="100">More than 100 pisces</option>
                                                    <option value="200">More than 200 pisces</option>
                                                    <option value="500">More than 500 pisces</option>
                                                   
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        
                                        <div class="col-xxl-1 col-sm-4">
                                            <div>
                                                <button type="submit" wire:click="filterMarketplace" class="btn btn-primary w-100" > <i class="ri-equalizer-fill me-1 align-bottom"></i>
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
                    
                    @foreach ($public_products as $product)

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{ route('marketplace.show', $product->id) }}">
                                        <h4 class="card-title" style="font-weight: 600;">{{ $product->title }}</h4>
                                    </a>
                                </div>
                                <a href="{{ route('marketplace.show', $product->id) }}">
                                    <img class="img-fluid" src="{{ asset('assets/images/products/product-placeholder.png') }}" alt="Card image cap">
                                </a>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Min selling price: {{ $product->lowest_selling_price }} EGP</li>
                                    <li class="list-group-item">Min profit: {{ $product->lowest_selling_price - $product->break_even_price }} EGP</li>
                                </ul>
                                <div class="card-footer">
                                    <div class=" justify-content-end">
                                                                    

                                        <a href="#" onclick="event.preventDefault(); confirmStartSelling({{ $product->id }});" class="btn btn-outline-success btn-border btn-sm d-grid mb-2">Start selling this product</a>
                                        <a href="{{ route('marketplace.show', $product->id) }}" class="btn btn-outline-primary btn-border btn-sm d-grid mb-2">More Details</a>

                                        <form id="start-selling-form-{{ $product->id }}" action="{{ route('marketplace.start_selling', $product->id) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>

                                    


                                </div>
                               
                            </div>
                        </div><!-- end col -->

                    @endforeach

                    {{ $public_products->links() }}
                    
                </div><!-- end row -->



                <script>
                    function confirmStartSelling(productId) {
                        if (confirm('Are you sure you want to start selling this product?')) {
                            document.getElementById('start-selling-form-' + productId).submit();
                        }
                    }
                </script>


            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->


</div>
