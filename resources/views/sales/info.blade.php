<?php
// echo "<pre>";
//     print_r($product);
//     exit();
?>
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

        .sales-form {
            max-height: 100vh;
        }
    </style>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card mx-auto sales-form">
            <div class="card">
                <div class="card-body main-row-alert">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title text-dark">New Order</h4>
                        </div>
                        <div class="col-4 text-right">
                            <button class="btn btn-sm btn-light" onclick="history.back()">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    @include('common.alert')
                    <hr class="bg-warning">
                    <form class="forms-sample create-user pt-2">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Order Number :</label>
                                <input type="text" class="form-control order_no" name="order_no"
                                    placeholder="Enter Order No." required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Customer Name :</label>
                                <select class="form-control customer_id" name="customer_id" required>
                                    <option value="" selected disabled>Choose Customer</option>
                                    @foreach ($customer as $cust)
                                        <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="chooseproduct">
                            <div class="row productdata" id="">
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputPassword1">Choose SKU :</label>
                                    <select class="form-control sku-select productselect" name="sku" required>
                                        <option value="" selected disabled>Select SKU</option>
                                        @foreach ($product as $pr)
                                            <option value="{{ $pr->id }}" data-name="{{ $pr->name }}"
                                                data-price="{{ $pr->t_price }}">{{ $pr->sku }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group asd col-sm-6">
                                    <label for="exampleInputPassword1">Choose Sub_SKU :</label>
                                    <select class="form-control sub-sku productselect" name="sub_sku" required>
                                        <option value="" selected disabled>Select Sub_SKU</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="exampleInputPassword1">Product Name :</label>
                                    <input type="text" class="form-control product-name" name="product_id" data-p_id=""
                                        placeholder="Enter Product Name" required disabled>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="exampleInputPassword1">Price :</label>
                                    <input type="number" class="form-control tprice" name="price"
                                        placeholder="Enter Price" required disabled>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="exampleInputPassword1">Qty. :</label>
                                    <div class="row">
                                        <div class="col-sm-12"><input type="number" class="form-control qty" name="qty"
                                                onkeyup="calculatePrice()" placeholder="Enter Quantity"></div>
                                        <div class="col-sm-2 d-none"><a class="btn btn-sm btn-light"
                                                onClick="remove_section(this)"><i class="fa fa-close"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="addbtn">
                            <a class="addData btn btn-sm btn-warning"><i class="fa fa-plus"></i>Add More</a>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Total Price :</label>
                                <input type="text" class="form-control total_price" name="total_price"
                                    placeholder="Enter Total Price" disabled required>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Payment Status :</label>
                                <select class="form-control payment_status" name="payment_status" required>
                                    <option value="" selected disabled>Select Payment Status</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Clear</option>

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Total Payment :</label>
                                <input type="text" class="form-control total_payment" name="total_payment"
                                    placeholder="Total Payment" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Due Payment :</label>
                                <input type="text" class="form-control due_payment" name="due_payment"
                                    placeholder="Due Payment" required disabled>
                            </div>
                        </div>

                        <button class="btn btn-primary mr-2 addselasdata" type="submit">Add</button>
                        <a href="{{ url('orders') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@push('script')
    <script>
        function calculatePrice() {
            let tPrice = 0;
            let qtytags = document.querySelectorAll(".qty");
            let pricetags = document.querySelectorAll(".tprice");
            let size = qtytags.length;
            for (let i = 0; i < size; i++) {
                let qty = +qtytags[i].value || 0;
                let price = +pricetags[i].value || 0;
                tPrice += qty * price;
            }
            $(".total_price").val(tPrice);
        }

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
                                    let val = selectedOption.data("name");
                                    let price = selectedOption.data("price");
                                    vrb.parent().siblings().children('.product-name').val(val);
                                    // vrb.parent().siblings().children('.product-name').data("p_id", p_id);
                                    vrb.parent().siblings().children('.tprice').val(price);
                                    let optd =
                                        "<option value='Not Found'  selected >Not Found</option>";
                                    vrb.parent().siblings().children('.sub-sku')
                                        .append(
                                            optd);
                                } else {
                                    let optd =
                                        "<option value='0'  selected disabled>Select Sub_SKU</option>\n\
                                            <option value='none'>none</option>";
                                    vrb.parent().siblings().children('.sub-sku').append(optd);
                                    // console.log($(this).parent().next().find('select'));
                                    data.forEach(sub => {
                                        let opt = "<option value=" + sub.id +
                                            " data-pname=" + sub.name + " data-price=" +
                                            sub
                                            .t_price + " data-p_id=" + sub.id + ">" +
                                            sub
                                            .sku + "</option>";
                                        vrb.parent().siblings().children('.sub-sku')
                                            .append(
                                                opt);
                                    });
                                }
                                // $(this).parent().siblings().children('.sub-sku').append(optd);
                            }
                            // d.closest('.productdata').find('.tprice').val(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                    // let price = $(".tprice").val();
                    // $(".total_price").val(price*qty);
                }

            });




            // Add click event for adding sales data
            // $(document).on("keyup", '.qty', function() {


            // let qty = +$(this).val();
            // let qtyTag = $(this);
            // if (qty != 0) {
            //     let price = qtyTag.parent().parent().parent().siblings().children(".tprice").val();
            //     let tPrise = +$(".total_price").val();
            //     // console.log(tPrise);
            //     // console.log(qty);
            //     let newP = qty * price;
            //     $(".total_price").val(tPrise + newP);
            // } else {
            //     $(".total_price").val("");
            // }

            // });
            $('.total_payment').on("keyup", function() {
                let totalPayment = +$(this).val();
                let price = +$(".total_price").val();
                if (totalPayment <= price) {
                    $(".due_payment").val(price - totalPayment);
                } else {
                    $(".total_payment").val(price);
                    $(".due_payment").val(0);
                }

            });

            $(document).on('change', ".sub-sku", function() {
                let selectedOption = $(this).find("option:selected");
                let selectTag = $(this);
                let val = selectedOption.data("pname");
                if (!val) {
                    let url = "{{ url('product/getPrice') }}";
                    let id = selectTag.parent().siblings().children(".sku-select").val();
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            if (data) {
                                selectTag.parent().siblings().children(".product-name").val(data
                                    .name);
                                selectTag.parent().siblings().children(".tprice").val(data
                                    .t_price);
                            }
                            // d.closest('.productdata').find('.tprice').val(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {

                    let price = selectedOption.data("price");
                    let qty = selectedOption.data("qty");
                    let p_id = selectedOption.data("p_id");
                    $(this).parent().siblings().children('.product-name').val(val);
                    $(this).parent().siblings().children('.product-name').data("p_id", p_id);
                    $(this).parent().siblings().children('.tprice').val(price);
                }

            });
            $('form').submit(function(e) {
                e.preventDefault();
                let order_no = $('.order_no').val();
                let customer_id = $('.customer_id').val();
                let payment_status = $('.payment_status').val();
                let total_payment = $('.total_payment').val();
                let due_payment = $('.due_payment').val();
                let status = $('.status').val();
                let total_price = $('.total_price').val();
                let product = [];
                $('.productdata:last-child .productselect').change(function() {
                    var id = $(this).val();
                    let url = "{{ url('product/price') }}";
                    let d = $(this);
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            d.closest('.productdata').find('.tprice').val(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
                // Loop through each product
                $('.productdata').each(function() {
                    let sku = $(this).find('.sku-select').val();
                    let subSku = $(this).find('.sub-sku').val();
                    let p_id = $(this).find('.product-name').data("p_id");
                    let price = $(this).find('.tprice').val();
                    let qty = $(this).find('.qty').val();

                    // Add product data to array
                    product.push({
                        sku: sku,
                        sub_sku: subSku,
                        p_id: p_id,
                        price: price,
                        qty: qty
                    });
                });

                // AJAX request
                $.ajax({

                    url: "{{ url('orders/save') }}",
                    method: 'POST',
                    // headers: {

                    //     'Content-Type': 'application/json' // Set the Content-Type header here
                    // },

                    data: {
                        order_no: order_no,
                        customer_id: customer_id,
                        payment_status: payment_status,
                        total_payment: total_payment,
                        due_payment: due_payment,
                        product: product,
                        total_price: total_price
                    },
                    success: function(data) {
                        if (data == "success") {

                            let errorMessage = `
                        <div class="alert alert-success fade-in alert-dismissible alertmsgnew" role="alert">\n\
                            <button type="button" class="close" data-dismiss="alert">\n\
                                <i class="fa fa-times"></i>\n\
                            </button>\n\
                            <strong>Success ! </strong> Order Successfully completed.\n\
                            </div>`;
                            $(".main-row-alert").prepend(errorMessage);
                            setTimeout(() => {
                                $('.alertmsgnew').fadeOut('fast');
                                window.location.href = "/orders";
                            }, 1500);
                        } else {

                            let errorMessage = `
                            <div class="alert alert-danger fade-in alert-dismissible alertmsgnew" role="alert">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                    </button>
                            <strong>Error ! </strong> Order not Completed!
                        </div>`;
                            $(".main-row-alert").prepend(errorMessage);
                            setTimeout(() => {
                                $('.alertmsgnew').fadeOut('fast');
                            }, 3000);
                        }

                        // Handle success

                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                });
            });

            // Add click event for adding more product fields
            $('.addData').click(function() {

                let str =
                    '<hr class="bg-secondary hr-line mt-3 mb-4"> <div class="row productdata"> <div class="form-group col-sm-6"> <label for="exampleInputPassword1">Choose SKU :</label>\n\
                                                        <select class="form-control sku-select productselect" name="sku" required><option value="" selected disabled>Select SKU</option>\n\
                                                            @foreach ($product as $pr) <option value="{{ $pr->id }}" data-name="{{ $pr->name }}"\n\
                                                        data-price="{{ $pr->t_price }}">{{ $pr->sku }}</option> @endforeach </select> </div>\n\
                                                    <div class="form-group col-sm-6"> <label for="exampleInputPassword1">Choose Sub_SKU :</label>\n\
                                                        <select class="form-control sub-sku productselect" name="sub_sku" required> <option value="" selected disabled>Select Sub_SKU</option>\n\
                                                        </select> </div><div class="form-group col-sm-4"><label for="exampleInputPassword1">Product Name :</label>\n\
                                                        <input type="text" class="form-control product-name" name="product_id"\n\
                                                            placeholder="Enter Product Name" data-p_id="" required disabled> </div>\n\
                                            <div class="form-group col-sm-4"><label for="exampleInputPassword1">Price :</label><input type="number" class="form-control tprice" name="price" placeholder="Enter Price" required disabled>\n\
                                            </div><div class="form-group col-sm-4"><label for="exampleInputPassword1">Qty. :</label>\n\
                                            <div class="row"><div class="col-sm-10"><input type="number" class="form-control qty" onkeyup="calculatePrice()" name="qty" placeholder="Enter Quantity"></div><div class="col-sm-2"><a class="btn btn-sm btn-light" onClick="remove_section(this)"><i class="fa fa-close"></i></a></div></div></div></div>';
                $('.chooseproduct').append(str);
                select(); // Reinitialize select2

                // Bind change event for new product select
                $('.productdata:last-child .productselect').change(function() {
                    var id = $(this).val();
                    let url = "{{ url('product/price') }}";
                    let d = $(this);
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            d.closest('.productdata').find('.tprice').val(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });

            });
            $('.productdata:last-child .productselect').change(function() {
                var id = $(this).val();
                let url = "{{ url('product/price') }}";
                let d = $(this);
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        d.closest('.productdata').find('.tprice').val(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
        setTimeout(() => {
            $('.alertmsgnew').fadeOut('fast');
        }, 4000);
        // Function to remove product section
        function remove_section(element) {
            let el = $(element).closest(".productdata");
            el.prev(".hr-line").remove();
            $(element).closest(".productdata").remove();
        }

        // Function to initialize select2



        // $('.addselasdata').click(function() {
        //     let order_no = $('.order_no').val();
        //     let customer_id = $('.customer_id').val();
        //     let payment_status = $('.payment_status').val();
        //     let total_payment = $('.total_payment').val();
        //     let due_payment = $('.due_payment').val();
        //     let product = [];
        //     $('.chooseproduct').each(function() {
        //         $(this).find('.productdata').each(function() {
        //             let obj = {};
        //             let p = $(this).find('select').val();
        //             let pr = $(this).find('.tprice').val();
        //             let qty = $(this).find('.qty').val();
        //             obj['p_id'] = p;
        //             obj['price'] = pr;
        //             obj['qty'] = qty;

        //             product.push(obj);
        //         });
        //     });
        //     let url = "{{ url('orders/save') }}";

        //     $.ajax({
        //         url: url,
        //         method: 'POST',
        //         data: {
        //             order_no: order_no,
        //             customer_id: customer_id,
        //             payment_status: payment_status,
        //             total_payment: total_payment,
        //             due_payment: due_payment,
        //             product: product
        //         },
        //         success: function(data) {
        //             console.log(data);
        //             return false;
        //         }

        //     });


        // });
        // $('.addData').click(function() {
        //     let str =
        //         '<div class="row productdata"><div class="form-group col-sm-4"><label for="exampleInputPassword1">Choose Product :</label>\n\
        //                 <select class="form-control productselect" name="product_id" required><option value="" selected disabled>Select Product</option>\n\
        //                 @foreach ($product as $pr)<option value="{{ $pr->id }}">{{ $pr->name }}</option>@endforeach</select></div>\n\
        //                 <div class="form-group col-sm-4"><label for="exampleInputPassword1">Price :</label><input type="text" class="form-control tprice" name="price" placeholder="Enter Price" required>\n\
        //                 </div><div class="form-group col-sm-4"><label for="exampleInputPassword1">Qty. :</label>\n\
        //                 <div class="row"><div class="col-sm-10"><input type="text" class="form-control qty" name="qty" placeholder="Enter Quantity"></div><div class="col-sm-2"><a class="btn btn-sm btn-light" onClick="remove_section(this)"><i class="fa fa-close"></i></a></div></div></div></div>';
        //     $('.chooseproduct').append(str);
        //     select();
        //     $('.chooseproduct .productdata').on('change', '.productselect', function() {
        //         var id = $(this).closest('select').val();
        //         let url = "{{ url('product/price') }}";
        //         let d = $(this);
        //         $.ajax({
        //             url: url,
        //             method: 'POST',
        //             data: {
        //                 id: id,
        //             },
        //             success: function(data) {
        //                 d.parent().parent().find('.tprice').val(data);
        //             }

        //         });
        //     })
        // });

        // function remove_section(element) {
        //     $(element).closest(".productdata").remove();
        // }

        // function select() {

        //     $('.productselect').select2({});
        // }

        // select();



        // $('.chooseproduct .productdata').on('change', '.productselect', function() {
        //     var id = $(this).closest('select').val();
        //     let url = "{{ url('product/price') }}";
        //     let d = $(this);
        //     $.ajax({
        //         url: url,
        //         method: 'POST',
        //         data: {
        //             id: id,
        //         },
        //         success: function(data) {
        //             d.parent().parent().find('.tprice').val(data);
        //         }

        //     });
        // })
    </script>
@endpush
