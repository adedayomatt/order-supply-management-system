
@extends('layouts.app')

@section('main')

  <div class="content-box">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h5 class="grey"><i class="fa fa-user"></i> Customer</h5>
        <h4>{{$customer->fullname()}}</h4>
        @if(Auth::user()->isMD() || Auth::user()->isManager())
          <a href="{{route('customer.edit',[$customer->id])}}"><i class="fa fa-pen"></i> Edit</a>
        @endif

      </div>
      <div class="col-md-4">
          <div class="text-center">
          <h5>Contacts</h5>
           <strong class="m-2"><a href="mailto: {{$customer->email}}"><i class="fa fa-envelope"></i> {{$customer->email}}</a></strong>
            <strong class="m-2"><a href="tel: {{$customer->phone}}"><i class="fa fa-phone"></i> {{$customer->phone}}</a></strong>
          </div>
          <div class="text-right">
            <a href="{{route('customer.order',[$customer->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New order</a>
          </div>
      </div>
    </div>
  </div>

  <div class="content-box">
    <div class="text-center">
    <h5><i class="fa fa-info-circle"></i> Overview</h5>
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
              <div class="text-danger text-center">
               <i class="fa fa-exclamation-triangle"></i> {{$customer->fullname()}} does not have any order record
               <br><br>
                <a href="{{route('customer.order',[$customer->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create order</a>
              </div>
            @endif
          </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="content-box">
      <h5>Supplies/Payments - {{$customer->supplies()->count()}}</h5>
      <a href="{{route('customer.supplies',[$customer->id])}}">view supplies</a>
      <div class="scrollable">
          @include('supply.widget-customer-supplies')
      </div>
      </div>
    </div>

  </div>

@endsection


@section('styles')

@endsection
