@extends('layout.app')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-dark">Users</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-2 ">
                <button class="btn btn-sm btn-secondary" onclick="history.back()">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Back</button>

            </div>
            <div class="col-8"></div>
            <div class="col-2 text-right">


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-plus" aria-hidden="true"></i> New User
                </button>

                <!--Add New User Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark h4" id="exampleModalLabel">Add New User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="{{url('users/info')}}" class="forms-sample create-user" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <div class="text-left">
                                                <label class="text-warning" for="exampleInputPassword1">User Id
                                                    :</label>
                                            </div>
                                            <input type="text" class="form-control" name="user_id"
                                                placeholder="Enter an unique User Id">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <div class="text-left">
                                                <label class="text-warning" for="exampleInputPassword1">Name :</label>
                                            </div>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Enter User's Name">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <div class="text-left">
                                                <label class="text-warning" for="exampleInputPassword1">Email :</label>
                                            </div>
                                            <input type="text" class="form-control" name="email"
                                                placeholder="Enter Email">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <div class="text-left">
                                                <label class="text-warning" for="exampleInputPassword1">Father's Name
                                                    :</label>
                                            </div>
                                            <input type="text" class="form-control" name="fname"
                                                placeholder="Enter Father's Name">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <div class="text-left">
                                                <label class="text-warning" for="exampleInputPassword1">Phone :</label>
                                            </div>
                                            <input type="text" class="form-control" name="phone"
                                                placeholder="Enter Phone Number">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <div class="text-left">
                                                <label class="text-warning" for="exampleInputEmail1">Role :</label>
                                            </div>
                                            <select class="form-control " name="role">
                                                <option value="" selected disabled>Choose Role</option>
                                                <option value="1">Admin</option>
                                                <option value="0">User</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <div class="text-left">
                                                <label class="text-warning" for="exampleInputEmail1">Gender :</label>
                                            </div>
                                            <select class="form-control " name="sex">
                                                <option value="" selected disabled>Select Gender
                                                </option>
                                                <option value="m">Male</option>
                                                <option value="f">Female</option>
                                                <option value="o">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <div class="text-left">
                                                <label class="text-warning" for="exampleInputPassword1">D.O.B. :</label>
                                            </div>
                                            <input type="date" id="datepicker" class="form-control" name="dob">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <div class="text-left">
                                                <label class="text-warning" for="exampleInputPassword1">D.O.J. :</label>
                                            </div>
                                            <input type="date" class="form-control" name="doj">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <div class="text-left">
                                                <label class="text-warning" for="exampleInputPassword1">Image :</label>
                                            </div>
                                            <input type="file" class="form-control" name="image"
                                                placeholder="Upload File" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <div class="text-left">
                                                <label class="text-warning" for="exampleInputEmail1">Status :</label>
                                            </div>
                                            <select class="form-control " name="status">
                                                <option value="" selected disabled>Select Status
                                                </option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <div class="text-left">
                                                <label class="text-warning" for="exampleInputPassword1">Password
                                                    :</label>
                                            </div>
                                            <input type="text" class="form-control" name="password"
                                                placeholder="Enter Password">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <div class="text-left">
                                                <label class="text-warning" for="exampleInputEmail1">Confirm Password
                                                    :</label>
                                            </div>
                                            <input type="text" class="form-control" name="confirm_password"
                                                placeholder="Confirm Password">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="text-left text-warning">
                                            <label class="text-warning" for="exampleInputPassword1">Address
                                                :</label>
                                        </div>
                                        <textarea class="form-control addressdata" name="address" id="" cols="30"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>

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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i=1;?>
                        @foreach($data as $user)
                        <tr>
                            <td><?php echo $i++?></td>
                            <td><?php echo $user['name']?></td>
                            <td><?php echo $user['email']?></td>

                            <td>
                                @if($user->role == 1)
                                Admin
                                @else
                                User
                                @endif
                            </td>
                            <td>
                                @if($user->status == 1)
                                <a href="{{url('users/status/'.$user->id)}}" class="btn btn-sm btn-success">Active</a>
                                @else
                                <a href="{{url('users/status/'.$user->id)}}"
                                    class="btn btn-sm btn-secondary">Inactive</a>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-light usersdatabtn" id="{{$user->id}}">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>


                                <button id="{{$user->id}}" type="button" class="btn btn-sm btn-info editdata">
                                    <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                </button>


                                <button data-id="{{url('users/delete/'.$user->id)}}"
                                    class="btn btn-sm btn-danger brand_delete_btn"><i class="fa fa-trash"
                                        aria-hidden="true"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--User information Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark h4" id="exampleModalLabel">User information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="">
                                <img src="" class="imgget1 img-fluid ml-3  border border-success rounded-circle" width="100px" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="text-dark text-left">
                        <ul class="text-dark font-weight-bold mt-4">
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        <p>
                                            User Id :
                                        </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="useriddata1">
                                            
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        <p>
                                            Name :
                                        </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="namedata1">
                                           
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        <p>
                                            Father's Name :
                                        </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="fnamedata1">
                                            
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        <p>
                                            Email Address :
                                        </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="emaildata1">
                                            
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        <p>
                                            Contact :
                                        </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="phonedata1">
                                            
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        <p>
                                            Address :
                                        </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="addressdata1">
                                            
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        <p>
                                            Gender :
                                        </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="sexdata1">
                                            
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        <p>
                                            D.O.B. :
                                        </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="dobdata1">
                                            
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        <p>
                                            D.O.J. :
                                        </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="dojdata1">
                                            
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        <p>
                                            Role :
                                        </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="roledata1">
                                            
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        <p>
                                            Status :
                                        </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="statusdata1">
                                            
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--Users update Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark h4" id="exampleModalLabel">Edit User
                        details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{url('users/update')}}" class="forms-sample create-user" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" class="id">
                            <div class="form-group col-sm-6">
                                <div class="text-left">
                                    <label class="text-warning" for="exampleInputPassword1">Name :</label>
                                </div>
                                <input type="text" class="form-control namedata" name="name"
                                    placeholder="Enter User's Name">
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="text-left">
                                    <label class="text-warning" for="exampleInputPassword1">Email :</label>
                                </div>
                                <input type="text" class="form-control emaildata" name="email"
                                    placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="text-left">
                                    <label class="text-warning" for="exampleInputPassword1">Phone :</label>
                                </div>
                                <input type="text" class="form-control phonedata" name="phone"
                                    placeholder="Enter Phone Number">
                            </div>

                            <div class="form-group col-sm-6">
                                <div class="text-left">
                                    <label class="text-warning" for="exampleInputPassword1">Image :</label>
                                </div>
                                <div class="row inputimage">

                                    <input type="hidden" class="imagedata" name="img">

                                    <input type="file" class="form-control " name="image" placeholder="Upload File">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="text-left">
                                    <label class="text-warning" for="exampleInputPassword1">Father's Name
                                        :</label>
                                </div>
                                <input type="text" class="form-control fnamedata" name="fname"
                                    placeholder="Enter Father's Name">
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="text-left">
                                    <label class="text-warning" for="exampleInputEmail1">Gender :</label>
                                </div>
                                <select class="form-control sexdata" name="sex">
                                    <option value="" selected disabled>Select Gender
                                    </option>
                                    <option value="m" {{$user->role=='m'?"selected":""}}>Male</option>
                                    <option value="f" {{$user->role=='f'?"selected":""}}>Female</option>
                                    <option value="o" {{$user->role=='o'?"selected":""}}>Others</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="text-left text-warning">
                                <label class="text-warning" for="exampleInputPassword1">Address :</label>
                            </div>
                            <textarea class="form-control addressdata" name="address" id="" cols="30"
                                rows="3"></textarea>
                        </div>

                        <div class="imgget my-3">
                            <img src="" class="img-fluid" width="70px" alt="">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </div>

                </div>
                </form>

            </div>

        </div>
    </div>
</div>

@endsection
@push('script')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.editdata').click(function() {
    let id = Number($(this).attr('id'));

    let url = "{{url('users/data')}}";
    $.ajax({
        url: url,
        method: 'POST',
        data: {
            id: id,
        },
        success: function(response) {
            $('.namedata').val(response.name);
            $('.emaildata').val(response.email);
            $('.phonedata').val(response.phone);
            $('.imagedata').val(response.image);
            let img = "{{asset('uploads/')}}"
            $('.imgget img').attr('src', img + "/" + response.image);
            $('.fnamedata').val(response.fname);
            $('.sexdata').val(response.sex);
            $('.passworddata').val(response.password);
            $('.addressdata').val(response.address);
            $('.id').val(response.id);
            $('#exampleModal2').modal('show');
        },

    });
});

$('.usersdatabtn').click(function(){
    let id = Number($(this).attr('id'));
    let url = "{{url('users/data')}}";
    $.ajax({
        url:url,
        method:'POST',
        data:{
            id:id,
        },
        success: function(response) {
            if (response.role==0) {
                $('.roledata1').html('User');
            }else{
                $('.roledata1').html('Admin')
            }
            $('.useriddata1').html(response.user_id);
            $('.namedata1').html(response.name);
            $('.emaildata1').html(response.email);
            $('.phonedata1').html(response.phone);
            let img1 = "{{asset('uploads/')}}"
            $('.imgget1').attr('src', img1 + "/" + response.image);
            $('.fnamedata1').html(response.fname);
            if (response.sex=='m') {
                $('.sexdata1').html('Male');
            }
            else if(response.sex=='f'){
                $('.sexdata1').html('Female');
            }else{
                $('.sexdata1').html('Others');
            }
            $('.addressdata1').html(response.address);
            $('.dobdata1').html(response.dob);
            $('.dojdata1').html(response.doj);
            if (response.status==1) {
                $('.statusdata1').html('Active');
            } else {
                $('.statusdata1').html('Inactive'); 
            }
            $('#exampleModal1').modal('show');
        }
    })
})
</script>
@endpush