@extends('layouts.appRHSfixed')

@section('main')

<div class="content-box">
   Update <strong>{{$order->customer->fullname()}}</strong>'s order
</div>

<div class="content-box">
    @if(!$order->closed())
        <form action="{{route('demand.create')}}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="quantity">Quantity ordering for</label>
                <input type="number" class="form-control" name="quantity" placeholder="quantity requesting for..." value="{{$order->quantity}}" autofocus required>
            </div>

            <div class="form-group">
                <label for="ammount">Ammount</label>
                <input type="number" class="form-control" name="ammount" placeholder="how much is it worth?" value="{{$order->ammount}}" autofocus required>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" value="Update Order">
            </div>

        </form>
    @else
        <div class="grey text-center">
            <h4>This order has already been closed since <strong>{{$order->closed_at()}}</strong></h4>
            <p>You can create another for <strong>{{$order->customer->firstname}}</strong></p>
            <a href="{{route('order.create',[$order->customer->id])}}" class="btn btn-primary">Create new order</a>
        </div>
    @endif
</div>

@endsection
@section('RHS')
    <?php
    $w_collection = $order->customer->orders()->where('id','!=',$order->id)->get();
    ?>
    <div class="content-box">
        <h5>Also ordered by {{$order->customer->firstname}}</h5> 
        @include('order.widget')
    </div>
@endsection