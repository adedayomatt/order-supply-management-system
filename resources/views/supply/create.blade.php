@extends('layouts.appLHSfixed')

@section('LHS')
<div class="content-box">
    <h5>Order Info</h5>
    @include('order.widget-info')
</div>
@endsection
@section('main')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="content-box">
            <div class="text-center">
               <h5>New Transaction</h5>
                    For  <a href="{{route('order.show',[$order->id])}}">order {{$order->id()}}</a> by <a href="{{route('customer.show',[$order->customer->id])}}">{{$order->customer->fullname()}}</a>
            </div>
            
        </div>


        <div class="content-box">

            @if($order->closed())
                <div class="text-center">
                    <h1 class="text-danger">
                        <i class="fa fa-lock"></i> 
                        <br>
                        Order closed
                     </h1>
                    <h5>Oops Sorry <strong>{{auth()->user()->firstname}}</strong>, 
                        You can't add supply to this order 
                        <a href="{{route('order.show',[$order->id])}}">{{$order->id()}}</a> for 
                        <a href="{{route('customer.show',[$order->customer->id])}}">{{$order->customer->fullname()}}</a>
                    </h5>
                    <p>This order is already closed by <a href="#">{{$order->closed_by()->fullname()}}</a> on {{$order->closed_at()}}</p>
                    
                </div>
            @else
                <form action="{{route('supply.store',[$order->id])}}" method="POST">
                    @csrf

                <input type="hidden" name="order" value="{{$order->id}}">

                    <div class="card my-1">
                        <div class="card-header" data-toggle="collapse" data-target="#record-supply"><h4><i class="fa fa-upload"></i> Supply</h4></div>
                        <div class="collapse card-body" id="record-supply">
                            @if($order->outstanding()['quantity'] > 0)
                                <div class="form-group">
                                    <label for="quantity">Quantity supplied</label>
                                    <input type="number" class="form-control" name="quantity" placeholder="quantity supplied..." value="{{old('quantity')}}" autofocus >
                                </div>
                                <div class="form-group">
                                    <label for="date_supplied">Date supplied</label>
                                    <input type="date" class="form-control" name="date_supplied" value="{{old('date_supplied')}}">
                                </div>
                            @else
                                <div class="grey text-center">
                                    <h5><i class="fa fa-exclamation-triangle"></i> No outstanding supply for this order. Total <span class="figure">{{$order->totalSupplied()['quantity']}}</span> {{$_unit}} of <span class="figure">{{$order->quantity}}</span> {{$_unit}} ordered have been supplied</h5>
                                </div>
                            @endif
                        </div>
                    </div>

                        <div class="card my-1">
                            <div class="card-header" data-toggle="collapse" data-target="#record-payment"><h4><i class="fa fa-hand-holding-usd"></i> Payment</h4></div>
                            <div id="record-payment" class="collapse card-body">
                                @if($order->outstanding()['ammount'] > 0)
                                    <div class="form-group">
                                        <label for="ammount">Ammount Paid</label>
                                        <input type="number" class="form-control" name="ammount" placeholder="ammount paid..." value="{{old('ammount')}}" autofocus >
                                    </div>

                                    <div class="form-group">
                                        <label for="bank">Bank</label><br>
                                        <select name="bank" id="bank" class="form-control" style="width: 200px">
                                            <option value="First Bank">First Bank</option>
                                            <option value="EcoBank">EcoBank</option>
                                            <option value="GTBank">GTBank</option>
                                            <option value="Fidelity Bank">Fidelity Bank</option>
                                            <option value="Zenith Bank">Zenith Bank</option>
                                            <option value="Union Bank">Union Bank</option>
                                            <option value="UBA">UBA</option>
                                            <option value="Polaris Bank">Polaris Bank</option>
                                            <option value="Diamond Bank">Diamond Bank</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="transaction_id">Transaction ID</label>
                                        <input type="text" class="form-control" name="transaction_id" value="{{old('transaction_id')}}" >
                                    </div>
                                    @else
                                        <div class="grey">
                                            <h5>No outstanding payment for this order. Total N <span class="figure">{{$order->totalSupplied()['ammount']}}</span> of N <span class="figure">{{$order->ammount}}</span> paid</h5>
                                        </div>
                                    @endif
                            </div>
                        </div>
                   
                @if($order->outstanding()['quantity'] > 0 || $order->outstanding()['ammount'] > 0)
                    
                    <div class="card my-1">
                        <div class="card-header" data-toggle="collapse" data-target="#transaction-note"><h4><i class="fa fa-pen"></i> Note</h4></div>
                        <div id="transaction-note" class="collapse card-body">
                            <div class="form-group">
                                <label for="note">Note <small><i>(optional)</i></small></label>
                                <p class="grey">Important information to note down regarding this transaction</p>
                                <textarea name="note" id="note"  class="ckeditor form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Add Transaction Record">
                    </div>
                @endif
                </form>
            @endif
            
        </div>
    </div>
</div>

@endsection
@section('RHS')
    @include('order.widget')
@endsection