@extends('layouts.appLHSfixedRHSfixed')

@section('LHS')
    <div class="card">
        <div class="card-header">
            <h5><i class="fa fa-user"></i> Customers</h5>
        </div>
        <div class="card-body scrollable p-0">
            @include('customer.widgets.default')
        </div>
    </div>
@endsection


@section('main')
    <div class="card">
        <div class="card-header">
            
        <div class="d-flex justify-content-center">
            <div>
                Total Supplies
                <h1>{{number_format($_supply::all()->sum('quantity'))}} <span style="font-size: 14px">{{$_unit}}</span></h1> 
            </div>
            <div class="ml-auto">
                Total Value
                <h1>&#8358; {{number_format($_supply::all()->sum('value'))}} <span style="font-size: 14px"></span></h1> 
            </div>
        </div>
        <?php 
        $supply_collection = $_supply::orderBy('supplied_at','desc')->take(20)->get() 
        ?>
            <h5><i class="fa fa-arrow-up"></i> Recent Supplies</h5>
            <div class="content-box">
                <div>
                    <button class="btn btn-sm btn-secondary" data-toggle="collapse" data-target="#supply-filter"><i class="fa fa-filter"></i> Filter month</button>
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
    $payment_collection = $_payment::orderBy('paid_on','desc')->take(20)->get() ?>
        <div class="card-header">
            <div class="text-right">
                Aggregate Payment
                <h1>&#8358;{{number_format($_payment::all()->sum('ammount'))}} </h1> 
            </div>

            <h5><i class="fa fa-hand-holding-usd"></i> Recent Payments</h5>
            <div class="content-box">
                <div>
                    <button class="btn btn-sm btn-secondary" data-toggle="collapse" data-target="#payment-filter"><i class="fa fa-filter"></i> Filter month</button>
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

