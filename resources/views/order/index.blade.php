@extends('layouts.app')

@section('main')
    <div class="content-box">
        <p class="grey">Orders: <strong>{!!$period!!}</strong> <span class="badge badge-secondary figure">{{$orders->count()}}</span></p>
    </div>

    <div class="content-box">
    @if($orders->count() > 0)
            <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Quantity</th>
                    <th>Ammount</th>
                    <th>status</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr class="{{$order->closed() ? 'closed' : 'open'}}">
                        <td>{{$order->id()}}</td>
                        <td>
                            <strong><a href="{{route('customer.show',[$order->customer->id])}}">{{$order->customer->fullname()}}</a></strong>
                            <div>
                                <small><a href="mailto: {{$order->customer->email}}">{{$order->customer->email}}</a>, <a href="tel: {{$order->customer->phone}}">{{$order->customer->phone}}</a></small>
                            </div>
                        </td>
                        <td>{{number_format($order->quantity)}}</td>
                        <td>&#8358; {{number_format($order->ammount)}}</td>
                        <td>
                            {!!$order->status()!!}
                        </td>                               
                        <td>
                            <small class="grey">created by <a href="{{route('user.show',[$order->user->id])}}">{{$order->user->fullname()}}</a> {{$order->created_at()}}, {{$order->created_at->diffForHumans()}} </small> 
                            <div>
                                {!!$order->note!!}
                            </div>
                        </td>
                        <td>
                            <p class="grey">
                                Supplied <strong>{{$order->supplies->count()}}</strong> time(s)
                            </p>
                        </td>
                        <td>
                            <a href="{{route('order.show',[$order->id])}}">View Order</a>
                            @if(!$order->closed())
                                <a href="{{route('supply.create',[$order->id])}}" class=" ">supply</a>
                            @endif                          
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <div class="grey text-center">
           No order found
            <a href="{{route('order.create')}}" class="btn btn-primary">Create one now</a>
        </div>
    @endif
    </div>
@endsection

