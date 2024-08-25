@extends('layout.app')
@section('content')
    @php

// Chart data....
        $jan = 0;
        $feb = 0;
        $mar = 0;
        $apr = 0;
        $may = 0;
        $jun = 0;
        $jul = 0;
        $aug = 0;
        $sep = 0;
        $oct = 0;
        $nov = 0;
        $dec = 0;

        $year = date('Y');
        $month = date('M');
        $amount = 0;
        $yamount = 0;
    @endphp
    {{-- @if (Auth::user()->role == 1) --}}
        @php  $data=App\Models\Sales::select('total_price','created_at')->get(); @endphp
    {{-- @else
        @php
            $data = App\Models\Sales::select('total_price', 'created_at')
                ->where('user_id', Auth::user()->id)
                ->get();
        @endphp
    @endif --}}


    @if (isset($loan))
        @foreach ($loan as $item)
            @php
                if (date('M', strtotime($item->created_at)) == 'Jan') {
                    $jan += $item->total_price;
                }
                if (date('M', strtotime($item->created_at)) == 'Feb') {
                    $feb += $item->total_price;
                }
                if (date('M', strtotime($item->created_at)) == 'Mar') {
                    $mar += $item->total_price;
                }
                if (date('M', strtotime($item->created_at)) == 'Apr') {
                    $apr += $item->total_price;
                }
                if (date('M', strtotime($item->created_at)) == 'May') {
                    $may += $item->total_price;
                }
                if (date('M', strtotime($item->created_at)) == 'Jun') {
                    $jun += $item->total_price;
                }
                if (date('M', strtotime($item->created_at)) == 'Jul') {
                    $jul += $item->total_price;
                }
                if (date('M', strtotime($item->created_at)) == 'Aug') {
                    $aug += $item->total_price;
                }
                if (date('M', strtotime($item->created_at)) == 'Sep') {
                    $sep += $item->total_price;
                }
                if (date('M', strtotime($item->created_at)) == 'Oct') {
                    $oct += $item->total_price;
                }
                if (date('M', strtotime($item->created_at)) == 'Nov') {
                    $nov += $item->total_price;
                }
                if (date('M', strtotime($item->created_at)) == 'Dec') {
                    $dec += $item->total_price;
                }
            @endphp
        @endforeach
    @endif
    <input type="hidden" value='<?php echo $jan; ?>' id="jan">
    <input type="hidden" value='<?php echo $feb; ?>' id="feb">
    <input type="hidden" value='<?php echo $mar; ?>' id="mar">
    <input type="hidden" value='<?php echo $apr; ?>' id="apr">
    <input type="hidden" value='<?php echo $may; ?>' id="may">
    <input type="hidden" value='<?php echo $jun; ?>' id="jun">
    <input type="hidden" value='<?php echo $jul; ?>' id="jul">
    <input type="hidden" value='<?php echo $aug; ?>' id="aug">
    <input type="hidden" value='<?php echo $sep; ?>' id="sep">
    <input type="hidden" value='<?php echo $oct; ?>' id="oct">
    <input type="hidden" value='<?php echo $nov; ?>' id="nov">
    <input type="hidden" value='<?php echo $dec; ?>' id="dec">
    {{-- Chart data end --}}


    @include('common.alert')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$dbproduct=  count(DB::table('users')->get()) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Suppliers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count(DB::table('Suppliers')->get()) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Products
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalpr}}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-product-hunt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count(DB::table('Sales')->get()) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-1">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart" jdata="0" fdata="10000"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('common.script_alert')
@endsection
