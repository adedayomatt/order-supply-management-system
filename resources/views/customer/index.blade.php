
@extends('layouts.app')

@section('main')
<div class="content-box">
    @if($customers->count() > 0)
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Orders</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>#{{$customer->id}}</td>
                        <td><i class="fa fa-user"></i> <strong><a href="{{route('customer.show',[$customer->id])}}">{{$customer->fullname()}}</a></strong></td>
                        <td><a href="mailto: {{$customer->email}}">{{$customer->email}}</a></td>
                        <td><a href="tel: {{$customer->phone}}">{{$customer->phone}}</a></td>
                        <td>
                            @if($customer->orders->count() > 0)
                               <span class="grey">{{$customer->orders->count()}} orders:</span>
                               @foreach($customer->orders as $order)
                                    <small><a href="{{route('order.show',[$order->id])}}">{{$order->id()}}</a> [{!!$order->status()!!}]</small>, 
                               @endforeach
                            @else
                                <small class="grey"><i class="fa fa-exclamation-triangle"></i> No order yet.</small>
                            @endif

                        </td>
                        <td>
                            <a href="{{route('customer.order',[$customer->id])}}" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> New order</a>
                            @if($customer->hasOutstandingOrders())
                                <span class="animated flash infinite slow" data-toggle="tooltip" title="{{$customer->outstanding()['quantity']}} outstanding orders"><i class="fa fa-exclamation-triangle"></i></span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-center grey">
            No Customer found 
            <a href="{{route('customer.create')}}" class="btn btn-primary">Add one now</a>
        </div>
    @endif
</div>
@endsection

