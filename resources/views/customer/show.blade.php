
@extends('layouts.app')

@section('main')

  <div class="content-box">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h5 class="grey"><i class="fa fa-user"></i> Customer</h5>
        <h4>{{$customer->fullname()}}</h4>
      </div>
      <div class="col-md-4">
        <div class="text-center">
          <h5>Contacts</h5>
          @if($customer->email != null)
          <strong class="m-2"><a href="mailto: {{$customer->email}}"><i class="fa fa-envelope"></i> {{$customer->email}}</a></strong>
          @endif
          @if($customer->phone != null)
            <strong class="m-2"><a href="tel: {{$customer->phone}}"><i class="fa fa-phone"></i> {{$customer->phone}}</a></strong>
          @endif
          @if(auth()->user()->isSuperAdmin() || auth()->user()->isMD() || auth()->user()->isManager() || auth()->user()->isAdmin())
            <div class="text-right">
              <button class="btn btn-sm btn-warning" data-toggle="collapse" data-target="#edit-delete">edit/delete</button>
              <div class="collapse" id="edit-delete">
                <form action="{{route('customer.destroy',[$customer->id])}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <a href="{{route('customer.edit',[$customer->id])}}"><i class="fa fa-pen"></i> Edit</a>
                  <button type="submit" class="btn btn-link text-danger"><i class="fa fa-trash"></i> delete customer</button>
                </form>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div>

  <div class="d-flex">
    <div>
      <h4><i class="fa fa-calendar"></i> {{$wallet->period}}</h4>
    </div>
    <div class="ml-auto">
      @if(request()->get('month') != 'all')
        <a href="{{route('customer.show',[$customer->id])}}?month=all&year=all" class="btn btn-sm btn-info m-3"><i class="fa fa-eye-open"></i> view all</a>
      @endif
      <a class="m-3 btn btn-sm btn-secondary" href="#" data-toggle="collapse" data-target="#filter"> <i class="fa fa-filter"></i> Monthly Transaction</a>
      <div class="collapse" id="filter">
          <form action="{{route('customer.show',[$customer->id])}}" method="GET">
            @include('widgets.filter')
          </form>
      </div>
    </div>
  </div>
 

  <div class="row">
    <div class="col-md-6 text-center">
      <div class="card">
        <div class="card-header">
          <h5><i class="fa fa-upload"></i> Supplies</h5>
          <div class="text-right">
            <a href="{{route('customer.supplies',[$customer->id,'month' => request()->get('month'), 'year' => request()->get('year')])}}">view supplies</a>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-center">
            <div>
              Total Quantity
              <h1>{{number_format($supplies->sum('quantity'))}} <span style="font-size: 14px">{{$_unit}}</span></h1> 
            </div>
            <div class="ml-auto">
              Total Value
              <h1>&#8358; {{number_format($supplies->sum('value'))}} <span style="font-size: 14px"></span></h1> 
            </div>
          </div>
          <div class="text-right">
            <a href="{{route('customer.supply.create',[$customer->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New supply</a>
          </div>

          <div class="scrollable mt-3 text-left">
            <?php $supply_collection = $supplies ?>
            @include('supply.widgets.default')
          </div>

        </div>
      </div>
    </div>

    <div class="col-md-6 text-center">
      <div class="card">
        <div class="card-header">
          <h5><i class="fa fa-wallet"></i> Wallet</h5>
          <div class="text-right">
            <a href="{{route('customer.payments',[$customer->id,'month' => request()->get('month'), 'year' => request()->get('year')])}}">view payments</a>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-center">
            <div>
              Total Paid
              <h1 class="text-primary">&#8358; {{number_format($wallet->total)}}</h1>
            </div>
            <div class="ml-auto">
                Debited
                <h1 class="text-secondary">&#8358; {{number_format($wallet->spent)}}</h1>
            </div>
            <div class="ml-auto">
                Balance
                <h1 class="{{$wallet->balance > 0 ? 'text-success' : 'text-danger'}}">&#8358; {{number_format($wallet->balance)}}</h1>
            </div>
          </div>
          <div class="text-right">
            <a href="{{route('customer.payment.create',[$customer->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add money to wallet</a>
          </div>

          <div class="scrollable mt-3 text-left">
            <?php $payment_collection = $payments ?>
            @include('payment.widgets.default')
          </div>

        </div>
      </div>
    </div>
  </div>  

  <!-- <div class="row">

    <div class="col-md-6">
      <div class="content-box">
        <h5>Supplies - {{$customer->supplies()->count()}}</h5>
      </div>
    </div>

    <div class="col-md-6">
      <div class="content-box">
        <h5>Payments - {{$customer->payments->count()}}</h5>
      </div>
    </div>

  </div> -->

@endsection

