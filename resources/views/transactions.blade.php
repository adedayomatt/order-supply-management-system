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
    <?php 
        $supply_collection = $_supply::orderBy('supplied_at','desc')->take(20)->get() ?>
        <div class="card-header">
            <h5><i class="fa fa-arrow-up"></i> Recent Supplies</h5>
            @include('supply.widgets.aggregate')
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
            <h5><i class="fa fa-hand-holding-usd"></i> Recent Payments</h5>
            <div class="text-right">
                @include('payment.widgets.aggregate')
            </div>
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

