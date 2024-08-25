@extends('layout.app')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-dark">Supplier Products</h1>

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
                    <a href="{{ url('supplierproducts/info') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Add Existing Products</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>SKU</th>
                                <th>Sub-SKU</th>
                                <th>Supplier Name</th>
                                <th>Qty.</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>SKU</th>
                                <th>Sub-SKU</th>
                                <th>Supplier Name</th>
                                <th>Qty.</th>
                                <th>Date</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @inject('alldata', 'App\Http\Controllers\MasterController')
                            <?php $i = 1; ?>
                            @foreach ($data as $spr)
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $spr['sku']; ?></td>
                                    <td><?php echo $spr['sub_sku']; ?></td>
                                    <td><?php echo $alldata::getsupplierName($spr['sup_id']); ?></td>
                                    <td><?php echo $spr['qty']; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($spr->created_at));
                                    ?></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        </script>
    @endpush
