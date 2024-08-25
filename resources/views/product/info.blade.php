@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title text-dark">Add New Product</h4>
                        </div>
                        <div class="col-4 text-right">
                            <button class="btn btn-sm btn-light" onclick="history.back()">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    @include('common.alert')
                    <hr class="bg-warning">
                    <form class="forms-sample create-user pt-2" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Select Category :</label>
                                <select class="form-control " name="category_id">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Product Name :</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Product Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="exampleInputPassword1">Supplier :</label>
                                <select class="form-control " name="sup_id" required>
                                    <option value="" selected disabled>Select Supplier</option>
                                    @foreach ($supplier as $sup)
                                        <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleInputPassword1">SKU :</label>
                                <input type="text" class="form-control" name="sku" placeholder="Enter product Sku">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleInputPassword1">Image :</label>
                                <input type="file" class="form-control" name="image" placeholder="Upload File"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Transfer Price :</label>
                                <input type="text" class="form-control" name="t_price"
                                    placeholder="Enter Transfer Price">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Retail Price :</label>
                                <input type="text" class="form-control" name="r_price" placeholder="Enter Retail Price">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Description :</label>
                                <input type="text" class="form-control" name="description" placeholder="Description">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Quantity :</label>
                                <input type="text" class="form-control" name="qty" placeholder="Total Quantity">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Location :</label>
                                <input type="text" class="form-control" name="location" placeholder="Add Location">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Status :</label>
                                <select class="form-control " name="status" id="status">
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Add</button>
                        <a href="{{ url('products') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    @include('common.script_alert')
@endsection
