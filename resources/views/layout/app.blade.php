<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
      <!-- Page level plugins -->
     
</head>
<style>
       .modal.show .modal-dialog {
    transform: translate(115px, 10px);
}
    .error{
        font-size:13px !important;
        color:red;
    }
    
</style>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layout.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">




                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2  text-gray-600 small">{{Auth::user()->name}}</span>
                                <img class="img-profile rounded-circle" src="{{asset('uploads/'.Auth::user()->image)}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                
                                <button class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">
                                    <i class="fa fa-user-circle-o fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </button>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    @yield('content')
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{url('signout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @csrf
                <div class="modal-body">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="">
                                <img src="{{asset('uploads/'.Auth::user()->image)}}" class="imgget1 img-fluid ml-3  border border-success rounded-circle" width="100px" alt="">
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
                                            {{Auth::user()->user_id}}
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
                                        {{Auth::user()->name}}
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
                                        {{Auth::user()->fname}}
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
                                        {{Auth::user()->email}}
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
                                        {{Auth::user()->phone}}
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
                                        {{Auth::user()->address}}
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
                                     @if(Auth::user()->sex=='m')
                                     Male
                                     @elseif(Auth::user()->sex=='f')
                                     Female
                                     @else
                                     Others
                                     @endif
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
                                        {{Auth::user()->dob}}
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
                                        {{Auth::user()->doj}}
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
                                        @if(Auth::user()->role==1)
                                        Admin
                                        @else
                                        User
                                        @endif
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
                                        @if(Auth::user()->status==1)
                                        Active
                                        @else
                                        Inactive
                                        @endif
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

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    {{-- <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script> --}}

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script> 
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    {{-- <script src="sweetalert2.all.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@stack('script')
<script>
    
    window.addEventListener('load', function() {
    $(".create-user").validate({
        rules: {
            name: {
                required: true,
                maxlength: 30,
            },
            email: {
                required: true,
                email: true,
                maxlength: 50
            },
            password: {
                required: true,
                minlength: 5
            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            },
            
            description: {
                required: true,
            },
            brand: {
                required: true,
            },
            status: {
                required: true,
            },
            brand_id: {
                required: true,
            },
            
            category_id: {
                required: true,
            },
            sku: {
                required: true,
            },
            t_price: {
                required: true,
            },
            r_price: {
                required: true,
            },
            qty: {
                required: true,
            },
            
            size: {
                required: true,
            },
            colour: {
                required: true,
            },
            address: {
                required: true,
            },
            contact: {
                required: true,
            },
            invoice_no: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Name is required",
                maxlength: "Name cannot be more than 30 characters"
            },
            email: {
                required: "Email is required",
                email: "Email must be a valid email address",
                maxlength: "Email cannot be more than 30 characters",
            },
            password: {
                required: "Password is required",
                minlength: "Password must be at least 5 characters"
            },
            confirm_password: {
                required: "Confirm password is required",
                equalTo: "Password and confirm password should same"
            },
           
            description: {
                required: "Description is required",
            },
            status: {
                required: "Status is required",
            },
            brand: {
                required: "Brand is required",
            },
            brand_id: {
                required: "Please select a brand",
            },
            
            category_id: {
                required: "Please select a category",
            },
            sku: {
                required: "sku is required",
            },
            t_price: {
                required: "Transfer price is required",
            },
            r_price: {
                required: "Retail price is required",
            },
            qty: {
                required: "please enter quantity",
            },
            
            size: {
                required: "Size is required",
            },
            colour: {
                required: "Colour is required",
            },
            address: {
                required: "Address is required",
            },
            contact: {
                required: "Contact is required",
            },
            invoice_no: {
                required: "invoice_no is required",
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});


$(document).ready(function() {
    $('.brand_delete_btn').click(function(e) {
        e.preventDefault();
        let id=$(this).attr('data-id');
 
 
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
                setTimeout(function() {
                    window.location.href = id;
                }, 1500);
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                });
            }
        });
    });
});
</script>
</body>

</html>