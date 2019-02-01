
@extends('layouts.app')

@section('main')

  <div class="content-box">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h5 class="grey">Customer</h5>
        <h4>{{$customer->fullname()}}</h4>
        <a href="{{route('customer.edit',[$customer->id])}}">edit</a>

      </div>
      <div class="col-md-4">
          <div class="text-center">
          <h5>Contacts</h5>
            <strong class="m-5"><a href="mailto: {{$customer->email}}">{{$customer->email}}</a></strong>
            <strong class="m-5"><a href="tel: {{$customer->phone}}">{{$customer->phone}}</a></strong>
          </div>
          <div class="text-right">
            <a href="{{route('customer.order',[$customer->id])}}" class="btn btn-sm btn-primary">New order</a>

          </div>
      </div>
    </div>
  </div>

  <div class="content-box">
    <div class="text-center">
    <h5>Overview</h5>
      <span class="m-3">Total Orders:  <strong><span class="figure">{{$customer->totalOrders()['quantity']}} {{$_unit}} (&#8358; {{number_format($customer->totalOrders()['ammount'])}})</span></strong></span>
      <span class="m-3"> Total Supplies: <strong> <span class="figure">{{number_format($customer->totalSupplies()['quantity'])}} {{$_unit}}</span></strong></span>
      <span class="m-3"> Total Payment: <strong> <span class="figure">&#8358; {{number_format($customer->totalSupplies()['ammount'])}}</span></strong></span>
      <span class="m-3"> Total Outstanding: <strong> <span class="figure">{{number_format($customer->outstanding()['quantity'])}} {{$_unit}}</span></strong></span>
      <span class="m-3"> Balance: <strong> <span class="figure {{$customer->outstanding()['ammount'] < 0 ? 'text-danger' : ''}}">&#8358; {{number_format($customer->outstanding()['ammount'])}}</span></strong></span>
    </div>
   
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="content-box">
        <h5>Orders - {{$customer->orders->count()}}</h5>
        <a href="{{route('customer.orders',[$customer->id])}}">view orders</a>
          <div class="scrollable">
            @if($customer->orders->count() > 0)
            <?php $w_collection = $customer->orders ?>
              @include('order.widget-list')
            @else
              <div class="grey text-center">
               {{$customer->fullname()}} does not have any order record
                <a href="{{route('customer.order',[$customer->id])}}" class="btn btn-primary">Create order</a>
              </div>
            @endif
          </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="content-box">
      <h5>Supplies - {{$customer->supplies()->count()}}</h5>
      <a href="{{route('customer.orders',[$customer->id])}}">view supplies</a>
      <div class="scrollable">
          @include('supply.widget-customer-supplies')
      </div>
      </div>
    </div>

  </div>

@endsection


@section('styles')

@endsection
