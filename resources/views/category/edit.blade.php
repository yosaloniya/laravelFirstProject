@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-md-9 grid-margin stretch-card mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-8">
                            <h4 class="card-title text-dark">Edit Category</h4>
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
                        <div class="form-group">
                            <label for="exampleInputPassword1">Select Brand :</label>
                            <select class="form-control " name="brand_id">
                                <option value="{{ $data->brand_id }}" selected disabled>Select Brand</option>
                                @foreach ($brand as $br)
                                    <option value="{{ $br->id }}" <?php echo $data['brand_id'] == $br->id ? 'selected' : ''; ?>>{{ $br->brand }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Name :</label>
                            <input type="text" value="{{ $data->name }}" class="form-control" name="name"
                                placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Image :</label>
                            <input type="hidden" value="{{ $data->image }}" class="form-control" name="img"
                                placeholder="Image">
                            <img src="{{ asset('uploads/' . $data->image) }}" width="50px" alt="">
                            <input type="file" class="form-control" name="image" placeholder="Image">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status :</label>
                            <select class="form-control " name="status" id="status">
                                <option value="" selected disabled>Select Status</option>
                                <option value="1" <?php echo $data['status'] == 1 ? 'selected' : ''; ?>>Active</option>
                                <option value="0" <?php echo $data['status'] == 0 ? 'selected' : ''; ?>>Inactive</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description :</label>
                            <input type="text" value="{{ $data->description }}" class="form-control" name="description"
                                placeholder="Description">
                        </div>



                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        <a href="{{ url('category') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    @include('common.script_alert')
@endsection
