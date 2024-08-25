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
                <button href="{{url('subsku/info/'.$id)}}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal1234">
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
                                 <a href="{{url('subsku/info/'.$id)}}" class="btn btn-sm btn-warning">
                                     <i class="fa fa-plus" aria-hidden="true"></i>Add New SKU</a>
                             </div>
                             <div class="col-sm-6 text-right">
                                 <a href="{{url('supplierproducts/info')}}" class="btn btn-sm btn-warning">
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
                    @foreach($data as $subsku)
                    <tr>
                        <td><?php echo $i++?></td>
                        <td><?php echo $subsku['name']?></td>
                        <td><?php echo $subsku['sku']?></td>
                        <td><?php echo $alldata::getsupplierName($subsku['sup_id'])?></td>
                        <td>
                            <img src="{{asset('uploads/'.$subsku->image)}}" width="50px" alt="">
                        </td>
                        <td><?php echo $subsku['colour']?></td>
                        <td><?php echo $subsku['t_price']?></td>
                        <td><?php echo $subsku['r_price']?></td>
                        <td><?php echo $subsku['size']?></td>
                        <td><?php echo $subsku['qty']?></td>
                        <td><?php echo $subsku['location']?></td>
                        <td>
                            @if($subsku->status == 1)
                            <a href="{{url('subsku/status/'.$subsku->id)}}" class="btn btn-sm btn-success alertmsg">Active</a>
                            @else
                            <a href="{{url('subsku/status/'.$subsku->id)}}" class="btn btn-sm btn-secondary alertmsg">Inactive</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('subsku/edit/'.$subsku->id)}}" class="btn btn-sm btn-info"><i
                                    class="fa fa-pencil-square" aria-hidden="true"></i></a>
                            <button data-id="{{url('subsku/delete/'.$subsku->id)}}" class="btn btn-sm btn-danger brand_delete_btn"><i class="fa fa-trash"
                                    aria-hidden="true"></i></button>
                        </td>
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
