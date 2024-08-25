@extends('layout.app')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection--single {
            height: 38.5px !important;
            border: 1px solid #d1d3e2 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #87878e;
            line-height: 36px;
        }
    </style>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card mx-auto sales-form">
            <div class="card">
                <div class="card-body main-row-alert">
                    <div class="row">

                        <div class="col-8">
                            <h4 class="card-title text-dark">Existing Product</h4>
                        </div>
                        <div class="col-4 text-right">
                            <button class="btn btn-sm btn-light" onclick="history.back()">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <hr class="bg-warning">
                    <form class="forms-sample create-user pt-2" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="chooseproduct">
                            <div class="row productdata" id="">
                                {{-- @foreach ($product as $pr)
                                <input type="hidden" name="product_id" value="{{$pr->id}}" id="">
                            @endforeach --}}
                                <div class="form-group col-sm-12">
                                    <label for="exampleInputPassword1">Choose SKU :</label>
                                    <select class="form-control sku-select productselect" name="sku" required>
                                        <option value="" selected disabled>Select SKU</option>
                                        @foreach ($product as $pr)
                                            <option value="{{ $pr->id }}" data-sku="{{ $pr->sku }}">
                                                {{ $pr->sku }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group asd col-sm-12">
                                    <label for="exampleInputPassword1">Choose Sub_SKU :</label>
                                    <select class="form-control sub-sku productselect" name="sub_sku" required>
                                        <option value="" selected disabled>Select Sub_SKU</option>
                                    </select>
                                </div>
                                {{-- <input type="hidden" name="product_id" value="{{$pr->id}}" id=""> --}}
                                <div class="form-group col-sm-12">
                                    <label for="exampleInputPassword1">Supplier Name :</label>
                                    <select class="form-control sup-id" name="sup_id" required>
                                        <option value="" selected disabled>Select Supplier</option>
                                        @foreach ($supplier as $sup)
                                            <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="exampleInputPassword1">Qty. :</label>
                                    <input type="number" class="form-control qty" name="qty"
                                        placeholder="Enter Quantity" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Add</button>
                        <a href="{{ url('products') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function select() {
            $('.productselect').select2({});
        }
        select();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $(document).on("change", ".sku-select", function() {
                let id = $(this).val();
                if (id != 0) {
                    let vrb = $(this);
                    $(this).parent().siblings().children('.sub-sku').empty();
                    let url = "{{ url('product/subsku') }}";
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            if (data) {
                                if (data == 201) {
                                    let selectedOption = vrb.find("option:selected");
                                    // let val = selectedOption.data("name");
                                    $('.sub-sku').html(
                                        "<option value='Not Found'  selected >Not Found</option>"
                                        );
                                } else {

                                    let optd =
                                        "<option value='0'  selected disabled>Select Sub_SKU</option>\n\
                                        <option value='none'>none</option>";
                                    vrb.parent().siblings().children('.sub-sku').append(optd);
                                    // console.log($(this).parent().next().find('select'));
                                    data.forEach(sub => {
                                        let opt = "<option value=" + sub.id +
                                            " data-pname=" + sub.name + " data-price=" +
                                            sub.t_price + " data-p_id=" + sub.id + ">" +
                                            sub.sku + "</option>";
                                        vrb.parent().siblings().children('.sub-sku')
                                            .append(opt);
                                    });
                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

           
            $('form').submit(function(e) {
                e.preventDefault();
                let id = $('.sku-select').val();
                let sup_id = $('.sup-id').val();
                let qty = +$('.qty').val();
                let sub_sku = $('.sub-sku option:selected').text();
                sub_sku = sub_sku ? sub_sku : "Not Found";
                let sku = $('.sku-select option:selected').data("sku");
                // let id = Number($(this).attr('id'));
                let url = "{{ url('supplierproducts/save') }}";
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        id: id,
                        sup_id: sup_id,
                        sku: sku,
                        sub_sku: sub_sku,
                        qty: qty
                    },
                    success: function(response) {
                        if (response == "success") {
                            
                            let errorMessage = `
                        <div class="alert alert-success fade-in alert-dismissible alertmsgnew" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="fa fa-times"></i>
                            </button>
                            <strong>Success ! </strong> Product Quantity Updated Successfully.
                            </div>`;
                            $(".main-row-alert").prepend(errorMessage);
                            setTimeout(() => {
                                $('.alertmsgnew').fadeOut('fast');
                                window.location.href = "/supplierproducts";
                            }, 1500);
                        } else{
                            
                            let errorMessage = `
                            <div class="alert alert-danger fade-in alert-dismissible alertmsgnew" role="alert">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                    </button>
                            <strong>Error ! </strong> Product Quantity not Updated!
                        </div>`;
                            $(".main-row-alert").prepend(errorMessage);
                            setTimeout(() => {
                                $('.alertmsgnew').fadeOut('fast');
                            }, 2000);
                        }
                    }

                });
            });

        });




        
    </script>
@endpush
