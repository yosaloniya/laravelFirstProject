@extends('layout.app')
@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-dark">Orders</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-2">
                    <button class="btn btn-sm btn-secondary" onclick="history.back()">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Back</button>
                </div>
                <div class="col-8"></div>
                <div class="col-2 text-right">
                    <a href="{{ url('orders/info') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        New Order</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order No.</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Total Price</th>
                            <th>Payment Status</th>
                            <th>Due Payment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Order No.</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Total Price</th>
                            <th>Payment Status</th>
                            <th>Due Payment</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @inject('alldata', 'App\Http\Controllers\MasterController')
                        <?php $i = 1; ?>

                        @foreach ($data as $sales)
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $sales['order_no']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($sales->created_at));
                                ?></td>
                                <td><?php echo $alldata::getcustomername($sales['customer_id']); ?></td>
                                <td><?php echo $sales['total_price']; ?></td>
                                <td>
                                    @if ($sales->payment_status == 1)
                                        Clear
                                    @else
                                        Pending
                                    @endif
                                </td>
                                <td><?php echo $sales['due_payment']; ?></td>

                                <td class="d-flex ">

                                    <a href="{{ url('orders/generate-bill/' . $sales->id) }}"
                                        class="btn m-1 btn-sm btn-secondary"><i class="fa fa-print"
                                            aria-hidden="true"></i></a>
                                    <a href="{{ url('orders/edit/' . $sales->id) }}" class="btn m-1 btn-sm btn-info"><i
                                            class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                    <button data-id="{{ url('orders/delete/' . $sales->id) }}"
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
@endsection
