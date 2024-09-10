<x-app-layout>


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
                                        <div class="col-sm">
                                            <div class="col-sm-auto">
                                                <div class="search-box ms-2">
                                                    <input type="text" class="form-control" id="searchProductList" placeholder="Search Products..." autofocus>
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div>
                                                <a href="{{ route('product.create') }}" class="btn btn-success" id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Add Product</a>
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
                                                
                                                <th scope="col">SKU</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Current Stock</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Break even price</th>
                                                <th scope="col">lowest selling price</th>
                                                <th scope="col">Action</th>
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
                                                    <td>{{ $product->current_stock }} pieces</td>

                                                    @if ($product->is_published == 1)                 
                                                        <td class="text-success"><i class="ri-checkbox-circle-line fs-17 align-middle"></i> Published</td>
                                                    @elseif ($product->is_published == 0)
                                                        <td class="text-danger"><i class="ri-close-circle-line fs-17 align-middle"></i> Draft</td>
                                                    @endif
                                                    
                                                    
                                                    <td>{{ $product->break_even_price }} LE</td>
                                                    <td>{{ $product->lowest_selling_price }} LE</td>

                                                    <td>
                                                        <div class="hstack gap-3 flex-wrap">
                                                            <a href="{{ route('product.edit', $product->id) }}" class="link-primary fs-15"><i class="ri-edit-2-line"></i></a>
                                                            @if ($product->is_private == 0)
                                                             
                                                                <a href="#" onclick="event.preventDefault(); confirmDelete({{ $product->id }});" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                                                <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
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


</x-app-layout>   