<?php
    // echo "<pre>";e
?>
@extends('layout.app')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-dark">Product SKU's</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        @include('common.alert')
        <div class="row">
        <div class="col-2">
            <a href="{{url('products')}}" class="btn btn-sm btn-secondary">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Back</a>
            </div>
            <div class="col-8"></div>
            <div class="col-2 text-right">
                <button href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal1234">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Add SKU</button>
                    
            </div>
             <!--  Add Existing Product Modal -->
             <div class="modal fade" id="exampleModal1234" tabindex="-1" role="dialog"
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
                                 <a href="#" class="btn btn-sm btn-warning">
                                     <i class="fa fa-plus" aria-hidden="true"></i>Add New SKU</a>
                             </div>
                             <div class="col-sm-6 text-right">
                                 <a href="#" class="btn btn-sm btn-warning">
                                     <i class="fa fa-plus" aria-hidden="true"></i>Add Existing SKU</a>
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
                        <th>Product Name</th>
                        <th>SKU</th>
                        <th>Supplier</th>
                        <th>Image</th>
                        <th>Colour</th>
                        <th>T_Price</th>
                        <th>R_Price</th>
                        <th>Size</th>
                        <th>Qty</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>SKU</th>
                        <th>Supplier</th>
                        <th>Image</th> 
                        <th>Colour</th> 
                        <th>T_Price</th>
                        <th>R_Price</th>
                        <th>Size</th>
                        <th>Qty</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @inject('alldata','App\Http\Controllers\MasterController')
                    <?php $i=1;?>
                   @foreach ($output as $item)
                   <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->sku}}</td>
                    <td>{{$item->sup_id}}</td>
                    <td><img src="<?php echo '/uploads/' . $item['image']; ?>" width="50px" alt=""></td> 
                    <td>{{"Colour"}}</td> 
                    <td>sdfg</td>
                    <td>werty</td>
                    <td>{{"Size"}}</td>
                    <td>{{$item->qty}}</td>
                    <td>Location</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
                   @endforeach
                </tbody>
            </table>
            <div id="alertmsg">alert</div>
        </div>
    </div>
</div>
@include('common.script_alert')
@endsection
