<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('images/favicon.png') }}" rel="icon" />
    <title>General Invoice -4 - Koice</title>
    <meta name="author" content="harnishdesign.net">

    <!-- Web Fonts
======================= -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900'
        type='text/css'>

    <!-- Stylesheet
======================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('pdf/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('pdf/vendor/font-awesome/css/all.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('pdf/css/stylesheet.css') }}" />
</head>

<body>
    <!-- Container -->
    @inject('alldata', 'App\Http\Controllers\MasterController')
    <div class="container-fluid invoice-container">
        <!-- Main Content -->
        <main>
            <div class="table-responsive">
                <table class="table table-bordered border border-secondary mb-0">
                    <tbody>
                        <tr>
                            <td colspan="2" class="bg-light text-center">
                                <h3 class="mb-0">THE COZYCREATIONS</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center text-uppercase">shop no 3, Newta, Near Mahindra
                                Sez,</br>
                                Jaipur, 302029</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="py-1">
                                <div class="row">
                                    <div class="col">Debit Memo</div>
                                    <div class="col text-center fw-600 text-3 text-uppercase">Tax Invoice</div>
                                    <div class="col text-end">Original</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-7">
                                <div class="row gx-2 gy-2">
                                    <div class="col-auto"><strong>M/s. :</strong></div>
                                    <div class="col">
                                        <address>
                                            <strong><?php $add = $alldata::getcustomername1($data['customer_id']);
                                            echo $add['name']; ?></strong><br />
                                            {{ $add['address'] }}
                                        </address>
                                    </div>
                                </div>
                            </td>
                            <td class="col-5 bg-light">
                                <div class="row gx-2 gy-1 fw-600">
                                    <div class="col-5">Invoice No <span class="float-end">:</span></div>
                                    <div class="col-7">{{ $data->order_no }}</div>

                                    <div class="col-5">Date <span class="float-end">:</span></div>
                                    <div class="col-7">{{ date('d-m-Y', strtotime($data->created_at)) }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="p-0">
                                <table class="table table-sm mb-0">
                                    <thead>
                                        <tr class="bg-light">
                                            <td class="col-1 text-center"><strong>SrNo</strong></td>
                                            <td class="col-6 "><strong>Product Name</strong></td>
                                            <td class="col-1 text-center"><strong>Qty</strong></td>
                                            <td class="col-2 text-end"><strong>Rate</strong></td>
                                            <td class="col-2 text-end"><strong>Amount</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        $TotalAmount = 0;
                                        ?>

                                        @foreach ($product as $orderData)
                                        
                                            <tr>
                                                <td class="col-1 text-center"><?php echo $i++; ?></td>
                                                <?php 
                                                     if(!empty($orderData['sub_sku']) && $orderData['sub_sku']!="Not Found"  && $orderData['sub_sku']!="none") {    
                                                        echo '<td class="col-6">'.$alldata::getproductname1($orderData['p_id']) .'</td>';
                                                    }else {
                                                         echo '<td class="col-6">'.$alldata::getproductname2($orderData['sku']) .'</td>';
                                                    }
                                                ?>
                                                <td class="col-1 text-center">{{ $orderData['qty'] }}</td>
                                                <td class="col-2 text-end">₹{{ $orderData['price'] }}</td>
                                                <td class="col-2 text-end">₹<?php
                                                $amount = $orderData['qty'] * $orderData['price'];
                                                $TotalAmount += $amount;
                                                echo $amount . '.0';
                                                ?></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr class="bg-light fw-600">
                            <td class="col-7 py-1">GSTIN No.: 08BCDPC8992D1ZI</td>
                            <td class="col-5 py-1 pe-1">Sub Total: <span
                                    class="float-end">₹{{ $TotalAmount }}.0</span></td>
                        </tr>
                        <?php 
                        $cgst = $TotalAmount * 0.09;
                        $sgst = $TotalAmount * 0.09;
                        $grand_total = $cgst+$sgst+$TotalAmount;
                        ?>
                        <tr>
                            <td class="col-7 text-1"><span class="fw-600" >Bill Amount:</span> <i id="datassss"> </i></td>
                            <td class="col-5 pe-1">
                                Central Tax: <small>(9.00%)</small> <span
                                    class="float-end">₹<?php 
                                    echo $cgst; ?></span><br> State Tax:
                                <small>(9.00%)</small> <span class="float-end">₹<?php 
                                echo $sgst; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-7 text-1">Note :</td>
                            <td class="col-5 pe-1 bg-light fw-600">
                                Grand Total:<span class="float-end total">₹<?php echo $grand_total ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-7 text-1">
                                <div class="fw-600">Terms & Condition :</div>
                                <ol>
                                    <li>Goods once sold will not be taken back.</li>
                                    <li>Our risk and responsibility ceases as soon</li>
                                </ol>
                            </td>
                            <td class="col-5 pe-1 text-end">
                                For, THE COZYCREATIONS
                                <div class="text-1 fst-italic mt-5">(Authorised Signatory)</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
        <footer class="text-center mt-4">
            <div class="btn-group btn-group-sm d-print-none">
                <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i
                        class="fa fa-print"></i> Print &
                    Download</a>
            </div>
        </footer>
    </div>
</body>
<script>
 /**
 * Function to convert a given number into words.
 * @param {number} n - The number to be converted into words.
 * @returns {string} - The word representation of the given number.
 */
function convertNumberToWords(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    return words_string;
    
    // Get the result by translating the given number
    // let result = translate(amount);
    // return result.trim() + ' ' + '<b>rupees only.</b>';
}

let val="{{$grand_total}}";
amount = Number(val);
document.getElementById('datassss').innerHTML=convertNumberToWords(amount) + " " + "<b>rupees only.</b>";
// console.log(convertNumberToWords('15623455.6715456655'));


</script>
</html>
