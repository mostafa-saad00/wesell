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
                                                <a href="{{ route('admin.product.create') }}" class="btn btn-success" id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Add Product</a>
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
                                                <th scope="col">Stock</th>
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
                                                            <a href="{{ route('admin.product.edit', $product->id) }}" class="link-primary fs-15"><i class="ri-edit-2-line"></i></a>
                                                            <a href="#" onclick="event.preventDefault(); confirmDelete({{ $product->id }});" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                                            <form id="delete-form-{{ $product->id }}" action="{{ route('admin.product.destroy', $product->id) }}" method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="link-success" data-bs-toggle="modal" data-bs-target="#addStockModel_{{$product->id}}">
                                                            Add
                                                            <i class="bx bx-add-to-queue align-middle"></i>
                                                        </a>
                                                        <a href="{{ route('admin.stock-movement.index', $product->id ) }}" class="link-warning">View Transactions
                                                            <i class="ri-arrow-right-line align-middle"></i>
                                                        </a>
                                                    </td>
                                                    <!-- Varying Modal Content -->
                                                    
                                                        
                                                    <div class="modal fade" id="addStockModel_{{$product->id}}" tabindex="-1" aria-labelledby="addStockModelLabel" aria-modal="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="addStockModelLabel">Add Stock </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('admin.stock-movement.store', $product->id) }}" method="POST">
                                                                        @csrf

                                                                        <div class="row g-3">
                                                                            <div class="col-xxl-12">
                                                                                <div>
                                                                                    <label for="productTitle_{{ $product->id }}" class="form-label">Product Title</label>
                                                                                    <input type="text" class="form-control" id="productTitle_{{ $product->id }}" value="{{ $product->title }}" disabled>
                                                                                </div>
                                                                            </div><!--end col-->
                                                                            <div class="col-xxl-12">
                                                                                <div>
                                                                                    <label for="quantity" class="form-label">Quantity</label>
                                                                                    <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Enter Quantity">
                                                                                </div>
                                                                            </div><!--end col-->
                                                                            
                                                                            <div class="col-lg-12">
                                                                                <div class="hstack gap-2 justify-content-end">
                                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </div><!--end col-->
                                                                        </div><!--end row-->
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                    

                                                </tr>

                                            @endforeach

                                            
                                            
                                            




                                            <script>
                                                function confirmDelete(productId) {
                                                    if (confirm('Are you sure you want to delete this product?')) {
                                                        document.getElementById('delete-form-' + productId).submit();
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
