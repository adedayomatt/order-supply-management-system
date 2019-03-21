@extends('layouts.appRHSfixed')
@section('main')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
               <h5>New Payment</h5>
            </div>
            <div class="card-body">
                <form action="{{route('payment.store')}}" method="POST">
                    @csrf
                    @if(isset($customer))
                        <p>Add Money to <a href="{{route('customer.show',[$customer->id])}}">{{$customer->fullname()}}</a> wallet</p>
                        <input type="hidden" name="customer" value="{{$customer->id}}">
                    @else
                        <div class="form-group">
                            <label for="">Select Customer</label>
                            <select name="customer" class="form-control" required>
                                <?php $customers = $_customer::all() ?>
                                @if($customers->count() > 0)
                                    @foreach($customers as $c)
                                        <option value="{{$c->id}}">{{$c->fullname()}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif
                       
                    <div class="form-group">
                        <label for="ammount">Ammount</label>
                        <input type="number" class="form-control" name="ammount" placeholder="ammount paid..." value="{{old('ammount')}}" autofocus >
                    </div>

                    <div class="form-group">
                        <label for="bank">Bank</label><br>
                        <select name="bank" id="bank" class="form-control" style="width: 200px">
                            <option value="Cash">Cash</option>
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
                        <label for="date_supplied">Date paid</label>
                        <input type="date" class="form-control" name="date_paid" value="{{old('date_paid')}}">
                    </div>

                    <div class="form-group">
                        <label for="note">Note <small><i>(optional)</i></small></label>
                        <p class="grey">Important information to note down regarding this transaction</p>
                        <textarea name="note" id="note"  class="ckeditor form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Add Payment">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('RHS')
    @if(isset($customer))
     <div class="card">
        <div class="card-header">
            <h5>{{$customer->firstname}} prev. payments</h5>
        </div>
        <div class="card-body">
            <?php $payment_collection = $customer->payments ?>
            @include('payment.widgets.default')
        </div>
     </div>
    @else
    <div class="card">
        <div class="card-header">
            <h5>Recent Payments</h5>
        </div>
        <div class="card-body">
           @include('payment.widgets.default')
        </div>
     </div>
    @endif
@endsection