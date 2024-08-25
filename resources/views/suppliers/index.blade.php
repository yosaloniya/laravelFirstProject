@extends('layout.app')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-dark">Suppliers</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @include('common.alert')
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
                        <i class="fa fa-plus" aria-hidden="true"></i> New Supplier
                    </button>

                    <!--  Add New Supplier Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark h4" id="exampleModalLabel">Manage Supplier details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ url('suppliers/info') }}" class="forms-sample create-user"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <div class="text-left">
                                                    <label class="text-warning" for="exampleInputPassword1">Invoice No.
                                                        :</label>
                                                </div>
                                                <input type="text" class="form-control" name="invoice_no"
                                                    placeholder="Enter Invoice number">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <div class="text-left">
                                                    <label class="text-warning" for="exampleInputPassword1">Supplier Name
                                                        :</label>
                                                </div>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter Supplier's Name">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <div class="text-left">
                                                    <label class="text-warning" for="exampleInputPassword1">Contact
                                                        :</label>
                                                </div>
                                                <input type="text" class="form-control" name="contact"
                                                    placeholder="Enter Contact Number">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <div class="text-left">
                                                    <label class="text-warning" for="exampleInputEmail1">Status :</label>
                                                </div>
                                                <select class="form-control " name="status">
                                                    <option value="" selected disabled>Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <div class="text-left">
                                                    <label class="text-warning" for="exampleInputEmail1">Description
                                                        :</label>
                                                </div>
                                                <input type="text" class="form-control" name="description"
                                                    placeholder="Description">
                                            </div>
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


            {{-- Supplier Table --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice No.</th>
                                <th>Supplier Name</th>
                                <th>Contact</th>
                                <th>description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Invoice No.</th>
                                <th>Supplier Name</th>
                                <th>Contact</th>
                                <th>description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($data as $sup)
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $sup['invoice_no']; ?></td>
                                    <td><?php echo $sup['name']; ?></td>
                                    <td><?php echo $sup['contact']; ?></td>
                                    <td><?php echo $sup['description']; ?></td>


                                    <td>
                                        @if ($sup->status == 1)
                                            <a href="{{ url('suppliers/status/' . $sup->id) }}"
                                                class="btn btn-sm btn-success">Active</a>
                                        @else
                                            <a href="{{ url('suppliers/status/' . $sup->id) }}"
                                                class="btn btn-sm btn-secondary">Inactive</a>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <button id="{{ $sup->id }}"
                                            class="btn m-1 btn-sm btn-warning supplier-product-info"><i class="fa fa-bars"
                                                aria-hidden="true"></i></button>
                                        <button id="{{ $sup->id }}" type="button"
                                            class="btn m-1 btn-sm btn-info editdata1">
                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                        </button>

                                        <button data-id="{{ url('suppliers/delete/' . $sup->id) }}"
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


        <!-- Edit Supplier details Modal -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark h4" id="exampleModalLabel">Edit Supplier
                            details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('suppliers/update') }}" class="forms-sample create-user" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" class="id">
                                <div class="form-group col-sm-6">
                                    <div class="text-left">
                                        <label class="text-warning" for="exampleInputPassword1">Invoice No.
                                            :</label>
                                    </div>
                                    <input type="text" class="form-control invoicedata" name="invoice_no"
                                        placeholder="Enter Invoice number">
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="text-left">
                                        <label class="text-warning" for="exampleInputPassword1">Supplier Name
                                            :</label>
                                    </div>
                                    <input type="text" class="form-control namedata" name="name"
                                        placeholder="Enter Supplier's Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <div class="text-left">
                                        <label class="text-warning" for="exampleInputPassword1">Contact
                                            :</label>
                                    </div>
                                    <input type="text" class="form-control contactdata" name="contact"
                                        placeholder="Enter Contact Number">
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="text-left">
                                        <label class="text-warning" for="exampleInputEmail1">Status :</label>
                                    </div>
                                    <select class="form-control statusdata" name="status">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="1" {{ $sup->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $sup->status == 0 ? 'selected' : '' }}>Inactive</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <div class="text-left">
                                        <label class="text-warning" for="exampleInputEmail1">Description
                                            :</label>
                                    </div>
                                    <input type="text" class="form-control descdata" name="description"
                                        placeholder="Description">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>


        {{-- supplier product details --}}
        <div class="modal fade" id="exampleModal15" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark h4" id="exampleModalLabel">Supplier Product
                            details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Product Name</th>
                                        <th>SKU</th>
                                        <th>Image</th>
                                        <th>Qty</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Product Name</th>
                                        <th>SKU</th>
                                        <th>Image</th>
                                        <th>Qty</th>
                                        <th>Location</th>
                                    </tr>
                                </tfoot>
                                <tbody class="supplier_data_tbody">


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
            $('.editdata1').click(function() {
                let id = Number($(this).attr('id'));
                let url = "{{ url('suppliers/data') }}";
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        $('.invoicedata').val(response.invoice_no);
                        $('.namedata').val(response.name);
                        $('.contactdata').val(response.contact);
                        $('.descdata').val(response.description);
                        $('.statusdata').val(response.status);
                        $('.id').val(response.id);
                        $('#exampleModal1').modal('show');
                    }

                });
            })


            $('.supplier-product-info').click(function() {
                let id = Number($(this).attr('id'));
                let url = "{{ url('suppliers/products/info') }}";
                let index = 1;
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        $('.supplier_data_tbody').empty(); // Clear previous data
                        let arr = [];
                        response.forEach((data) => {
                            let imagedata = 'uploads/' + data.image;
                            let str = "<tr><td>" + index++ + "</td><td>" + formatDate(data
                                    .created_at) + "</td><td>" + data.name + "</td><td>" + data
                                .sku + "</td><td><img src='" + imagedata +
                                "' class='img-fluid border border-secondary' width='50px'></td><td>" +
                                data.qty + "</td><td>" + data.location + "</td></tr>";
                            arr.push(str);
                        });
                        $('.supplier_data_tbody').html(arr);
                        $('#exampleModal15').find('.modal-dialog').addClass('modal-xl');
                        $('#exampleModal15').modal('show');
                    }
                });
            });

            // Function to format date
            function formatDate(dateString) {
                // Assuming dateString is in ISO 8601 format (e.g., "2024-05-07T12:30:45Z")
                let date = new Date(dateString);
                // Extract day, month, and year components
                let day = date.getDate();
                let month = date.getMonth() + 1; // Months are zero-based, so we add 1
                let year = date.getFullYear();
                // Pad single-digit day and month with leading zeros if needed
                day = day < 10 ? '0' + day : day;
                month = month < 10 ? '0' + month : month;
                // Construct formatted date string
                return day + '/' + month + '/' + year;
            }
        </script>
    @endpush
