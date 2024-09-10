<div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Products</h4>
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
                                        <form wire:submit="filterProducts">
                                            <div class="row g-3">
                                                <div class="col-xxl-11 col-sm-6">
                                                    <div class="search-box">
                                                        <input type="text" wire:model="searchTerm" class="form-control search" placeholder="Search for Product name, sku..." autofocus>
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                               
                                                
                                                
                                                <div class="col-xxl-1 col-sm-4">
                                                    <div>
                                                        <button type="submit" wire:click="filterProducts" class="btn btn-primary w-100" > <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                                            Filters
                                                        </button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>


                                        </form>
                                    </div>
                                </div>
 
                            </div>

                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                
                                                <th scope="col">SKU</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Warehouse Stock</th>
                                                <th scope="col">lowest selling price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td><a href="#" class="fw-semibold">{{ $product->sku }}</a></td>
                                                    <td>
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ asset('assets\images\products/product-placeholder.png') }}" alt="" class="avatar-xs rounded-circle" />
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                {{ $product->title }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $product->warehouse_stock }} pieces</td>

                                                    
                                                    
                                                    
                                                    <td>{{ $product->lowest_selling_price }} LE</td>

                                                    
                                                </tr>

                                            @endforeach
                                            
                                            
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

                <script>
                    function confirmDelete(productId) {
                        if (confirm('Are you sure you want to delete this product?')) {
                            document.getElementById('delete-form-' + productId).submit();
                        }
                    }
                </script>


                @if (session('success') === 'Product created successfully!')
                    <div 
                        style="z-index: 11"
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 5000)" 
                        class="toast-container position-absolute p-3 bottom-0 end-0">

                        <div id="borderedToast2" class="toast toast-border-success overflow-hidden mt-3 fade show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <i class="ri-checkbox-circle-fill align-middle"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Product Created Successfully</h6>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif






                

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
</div>
