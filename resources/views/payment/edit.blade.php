@extends('layouts.appRHSfixed')
@section('main')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
               <h5>Edit Payment by {{$payment->customer()->fullname()}}</h5>
            </div>
            <div class="card-body">

                @if($payment->customer()->isDeleted())
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle"></i>NOTE: This customer has ben delete since {{$supply->customer()->deleted_at->toDayDateTimeString()}}
                    </div>
                @endif
                <form action="{{route('payment.update',[$payment->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                       
                    <div class="form-group">
                        <label for="ammount">Ammount</label>
                        <input type="number" class="form-control" name="ammount" placeholder="ammount paid..." value="{{$payment->ammount}}" autofocus >
                    </div>

                    <div class="form-group">
                        <label for="bank">Bank</label><br>
                        <select name="bank" id="bank" class="form-control" style="width: 200px">
                            <option value="Cash" {{$payment->bank == 'Cash' ? 'selected' : ''}}>Cash</option>
                            <option value="First Bank" {{$payment->bank == 'First Bank' ? 'selected' : ''}}>First Bank</option>
                            <option value="EcoBank" {{$payment->bank == 'EcoBank' ? 'selected' : ''}}>EcoBank</option>
                            <option value="GTBank" {{$payment->bank == 'GTBank' ? 'selected' : ''}}>GTBank</option>
                            <option value="Fidelity Bank" {{$payment->bank == 'Fidelity Bank' ? 'selected' : ''}}>Fidelity Bank</option>
                            <option value="Zenith Bank" {{$payment->bank == 'Zenith Bank' ? 'selected' : ''}}>Zenith Bank</option>
                            <option value="Union Bank" {{$payment->bank == 'Union Bank' ? 'selected' : ''}}>Union Bank</option>
                            <option value="UBA" {{$payment->bank == 'UBA' ? 'selected' : ''}}>UBA</option>
                            <option value="Polaris Bank" {{$payment->bank == 'Polaris Bank' ? 'selected' : ''}}>Polaris Bank</option>
                            <option value="Diamond Bank" {{$payment->bank == 'Diamond Bank' ? 'selected' : ''}}>Diamond Bank</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date_paid">Date paid: {{$payment->paid_on()}}</label>
                        <input type="date" class="form-control" name="date_paid" value="{{$payment->paid_on->format('Y-m-d')}}">
                    </div>

                    <div class="form-group">
                        <label for="note">Note <small><i>(optional)</i></small></label>
                        <p class="grey">Important information to note down regarding this transaction</p>
                        <textarea name="note" id="note"  class="ckeditor form-control">{{$payment->note}}</textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="update payment">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('RHS')
     <div class="card">
        <div class="card-header">
            <h5>Other payments by {{$payment->customer()->firstname}}</h5>
        </div>
        <div class="card-body">
            <?php $payment_collection = $payment->customer()->payments()->where('id','!=',$payment->id)->get() ?>
            @include('payment.widgets.default')
        </div>
     </div>
@endsection