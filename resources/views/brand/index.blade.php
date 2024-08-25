@extends('layout.app')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-dark">Brand</h1>

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
                    <a href="{{ url('brand/info') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        New Brand</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Brand</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Brand</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($data as $brand)
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $brand['brand']; ?></td>
                                <td>
                                    @if ($brand->status == 1)
                                        <a href="{{ url('brand/status/' . $brand->id) }}"
                                            class="btn btn-sm btn-success">Active</a>
                                    @else
                                        <a href="{{ url('brand/status/' . $brand->id) }}"
                                            class="btn btn-sm btn-secondary">Inactive</a>
                                    @endif
                                </td>
                                <td><?php echo $brand['description']; ?></td>
                                <td>
                                    <a href="{{ url('brand/edit/' . $brand->id) }}" class="btn btn-sm btn-info"><i
                                            class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                    <button data-id="{{ url('brand/delete/' . $brand->id) }}"
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
    @include('common.script_alert')
@endsection
