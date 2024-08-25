@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
            <div class="row">
                   
                   <div class="col-8">
                       <h4 class="card-title text-dark">Edit SKU</h4>
                   </div>
                   <div class="col-4 text-right">
                   <button class="btn btn-sm btn-light" onclick="history.back()">
                   <i class="fa fa-times" aria-hidden="true"></i>
                           </button>
                   </div>
               </div>
<hr class="bg-warning">
@include('common.alert')
                <form class="forms-sample create-user pt-2" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input type="hidden" value="{{$data->product_id}}" name="product_id">
                            <label for="exampleInputPassword1">Name :</label>
                            <input type="text" value="{{$data->name}}" class="form-control" name="name" placeholder="Enter product Name">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="exampleInputPassword1">SKU :</label>
                            <input type="text" value="{{$data->sku}}" class="form-control" name="sku" placeholder="Enter product Sku">
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="exampleInputPassword1">Supplier :</label>
                        <select class="form-control " name="sup_id" required>
                            <option value="" selected disabled>Select Supplier</option>
                            @foreach($supplier as $sup)
                            <option value="{{$sup->id}}"<?php echo $data['sup_id']==$sup['id']?"selected":""?> >{{$sup->name}}</option>
                            @endforeach
                        </select> 
                    </div>
                        <div class="form-group col-sm-4">
                            <label for="exampleInputPassword1">Image :</label>
                            <input type="hidden" value="{{$data->image}}" name="img">
                            <img src="{{asset('uploads/'.$data->image)}}" width="50px" alt="">
                            <input type="file" class="form-control" name="image" placeholder="Upload File" >
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="exampleInputPassword1">Colour :</label>
                            <input type="text" value="{{$data->colour}}" class="form-control" name="colour" placeholder="Enter Product Colour">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="exampleInputPassword1">Transfer Price :</label>
                            <input type="text" value="{{$data->t_price}}" class="form-control" name="t_price" placeholder="Enter Transfer Price">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="exampleInputPassword1">Retail Price :</label>
                            <input type="text" value="{{$data->r_price}}" class="form-control" name="r_price" placeholder="Enter Retail Price">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="exampleInputPassword1">Size :</label>
                            <input type="text" value="{{$data->size}}" class="form-control" name="size" placeholder="Enter Size">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="exampleInputPassword1">Quantity :</label>
                            <input type="text" value="{{$data->qty}}" class="form-control" name="qty" placeholder="Total Quantity">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="exampleInputPassword1">Location :</label>
                            <input type="text" value="{{$data->location}}" class="form-control" name="location" placeholder="Add Location" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="exampleInputEmail1">Status :</label>
                            <select class="form-control " name="status" id="status">
                                <option value="" selected disabled>Select Status</option>
                                <option value="1"{{ $data->status==1?"selected":""}}>Active</option>
                                <option value="0"{{ $data->status==0?"selected":""}}>Inactive</option>

                            </select>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="exampleInputPassword1">Description :</label>
                            <input type="text" value="{{$data->description}}" class="form-control" name="description" placeholder="Description">
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <button class="btn btn-light" onclick="history.back()">
                   Cancel
                           </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@include('common.script_alert')
</div>
@endsection