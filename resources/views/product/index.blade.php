@extends('layout.app')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-dark">Products</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @include('common.alert')
            <div class="row">
                <div class="col-2">
                    <button class="btn btn-sm btn-secondary" onclick="history.back()">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Back</button>
                </div>
                <div class="col-8"></div>
                <div class="col-2 text-right">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal123">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Add Product</button>
                </div>

                <!--  Add Existing Product Modal -->
                <div class="modal fade" id="exampleModal123" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark h4" id="exampleModalLabel">Add More Products</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="{{ url('products/info') }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-plus" aria-hidden="true"></i>Add New Product</a>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a href="{{ url('supplierproducts/info') }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-plus" aria-hidden="true"></i>Add Existing Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>SKU</th>
                            <th>Supplier Name</th>
                            <th>Image</th>
                            <th>T_Price</th>
                            <th>R_Price</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>SKU</th>
                            <th>Supplier Name</th>
                            <th>Image</th>
                            <th>T_Price</th>
                            <th>R_Price</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @inject('alldata', 'App\Http\Controllers\MasterController')
                        <?php $i = 1; ?>
                        @foreach ($data as $product)
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $alldata::getbrandname1($product['category_id']); ?></td>
                                <td><?php echo $alldata::getcategoryname($product['category_id']); ?></td>
                                <td><?php echo $product['name']; ?></td>
                                <td><span type="button" class="btn btn-sm btn-light skubtn text-danger"
                                        id="{{ $product->id }}">
                                        <?php echo $product['sku']; ?></span>
                                </td>
                                <td><?php echo $alldata::getsupplierName($product['sup_id']); ?></td>
                                <td>
                                    <img src="<?php echo 'uploads/' . $product['image']; ?>" width="50px" alt="">
                                </td>
                                <td><?php echo $product['t_price']; ?></td>
                                <td><?php echo $product['r_price']; ?></td>
                                <td><?php echo $product['description']; ?></td>
                                <td><?php 

                                $sub_sku = $alldata::getsubskuqty($product['id']);
                                echo $sub_sku+$product['qty'];
                                ?></td>
                                <td><?php echo $product['location']; ?></td>
                                <td>
                                    @if ($product->status == 1)
                                        <a href="{{ url('products/status/' . $product->id) }}"
                                            class="btn btn-sm btn-success">Active</a>
                                    @else
                                        <a href="{{ url('products/status/' . $product->id) }}"
                                            class="btn btn-sm btn-secondary">Inactive</a>
                                    @endif
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ url('products/edit/' . $product->id) }}" class="btn m-1 btn-sm btn-info"><i
                                            class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                    <a href="{{ url('subsku/' . $product->id) }}" class="btn m-1 btn-sm btn-warning"><i
                                            class="fa fa-bars" aria-hidden="true"></i></a>
                                    <button data-id="{{ url('products/delete/' . $product->id) }}"
                                        class="btn m-1 btn-sm btn-danger brand_delete_btn"><i class="fa fa-trash"
                                            aria-hidden="true"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark h4" id="exampleModalLabel">Product Subsku's</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>SKU</th>
                                    <th>Color</th>
                                    <th>Qty.</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('common.script_alert')
@endsection

@push('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.skubtn').click(function() {
            let id = Number($(this).attr('id'));
            let url = "{{ url('sku/data') }}";
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    id: id,
                },
                success: function(response) {
                    let arr = [];
                    response.forEach(val => {
                        let str = '<tr><td>' + val.name + '</td><td>' + val.sku + '</td><td>' +
                            val.colour + '</td><td>' + val.qty + '</td></tr>';
                        arr.push(str);
                    });
                    $('.alldata').html(arr);
                    $('#exampleModal').modal('show');
                }
            })
        })
    </script>
@endpush
