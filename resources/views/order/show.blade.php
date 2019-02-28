@extends('layouts.appRHSfixed')

@section('main')

    <div class="row align-items-center">
        <div class="col-sm-4">
            <div class="content-box">
                <h4>Order {{$order->id()}}</h4>
                @include('order.widget-info')
                <p class="grey">created by <a href="{{route('user.show',[$order->user->id])}}">{{$order->user->fullname()}}</a> {{$order->created_at()}}, {{$order->created_at->diffForHumans()}} </p>
                @if(!$order->closed())
                    <div class="text-center">
                        <form action="{{route('order.close',[$order->id])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-lock"></i> Close order</button>
                        </form>
                    </div>
                    @else
                    <div class="text-center">
                        <form action="{{route('order.open',[$order->id])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-lock-open"></i> Re-open order</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-sm-8">
            @include('order.widget-single-detailed')
        </div>
    </div>


<div class="content-box">
    <h5><i class="fa fa-history"></i> Supply/Payment History</h5>
    @if($order->supplies->count() > 0)
        <?php $supplies = $order->supplies ?>
        @include('supply.widget-table')
    @else
        <div class="grey text-center p-2">
           No supply/payment recorded for this order yet
            <a href="{{route('supply.create',[$order->id])}}" class="btn btn-success">Record supply</a>
        </div>
    @endif
</div>



@endsection
@section('RHS')
    <?php
    $w_collection = $order->customer->orders()->where('id','!=',$order->id)->get();
    ?>
    <div class="content-box d-print-none">
        <h5>Also ordered by  {{$order->customer->firstname}}</h5> 
        @include('order.widget')
    </div>
@endsection