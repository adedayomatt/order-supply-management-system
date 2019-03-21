@extends('layouts.appLHSfixedRHSfixed')

@section('LHS')
    <div class="card">
        <div class="card-header">
            <h5>Customers</h5>
        </div>
        <div class="card-body scrollable p-0">
            @include('customer.widgets.default')
        </div>
    </div>
@endsection


@section('main')
    <div class="card">
    <?php 
        $month = date('m',time());
        $year = date('Y',time());    
    $supply_collection = $_supply::orderBy('supplied_at','desc')->get() ?>
        <div class="card-header">
            <h5>Supplies</h5>
            @include('supply.widgets.aggregate')
            <div class="content-box">
                <p>This Month: {{date('F',time()).', '.$year}}</p>
                <div>
                    <button class="btn btn-sm btn-secondary" data-toggle="collapse" data-target="#supply-filter"><i class="fa fa-filter"></i> view other months</button>
                    <div id="supply-filter" class="collapse">
                        <form action="{{route('supplies')}}" method="GET">
                            @include('widgets.filter')
                        </form>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <a href="{{route('supplies')}}"><i class="fa fa-eye-open"></i> view all</a>
            </div>
        </div>
        <div class="card-body scrollable  p-0">
            @include('supply.widgets.default')
        </div>
       
    </div>
@endsection


@section('RHS')
    <div class="card">
    <?php
    $payment_collection = $_payment::whereMonth('paid_on',$month)->whereYear('paid_on',$year)->orderBy('paid_on','desc')->get() ?>
        <div class="card-header">
            <h5>Payments</h5>
            @include('payment.widgets.aggregate')
            <div class="content-box">
                <p>This Month: {{date('F',time()).', '.$year}}</p>
                <div>
                    <button class="btn btn-sm btn-secondary" data-toggle="collapse" data-target="#payment-filter"><i class="fa fa-filter"></i> Filter other months</button>
                    <div id="payment-filter" class="collapse">
                        <form action="{{route('payments')}}" method="GET">
                            @include('widgets.filter')
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body scrollable  p-0">
            @include('payment.widgets.default')
        </div>
    </div>
@endsection

