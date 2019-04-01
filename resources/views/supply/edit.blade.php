@extends('layouts.appRHSfixed')


@section('main')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
               <h5>Edit Supply for {{$supply->customer()->fullname()}}</h5>
            </div>
            <div class="card-body">
                @if($supply->customer()->isDeleted())
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle"></i>NOTE: This customer has ben delete since {{$supply->customer()->deleted_at->toDayDateTimeString()}}
                    </div>
                @endif
                <form action="{{route('supply.update',[$supply->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Product type</label>
                        <select name="product_type" class="form-control" required>
                            <option value="unicem" {{$supply->type == 'unicem' ? 'selected' : ''}}>Unicem</option>
                            <option value="superset" {{$supply->type == 'supaset' ? 'selected' : ''}}>Supaset</option>
                            <option value="elephant" {{$supply->type == 'elephant' ? 'selected' : ''}}>Elephant</option>
                            <option value="dangote" {{$supply->type == 'dangote' ? 'selected' : ''}}>Dangote</option>
                            <option value="dua" {{$supply->type == 'bua' ? 'selected' : ''}}>Bua</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity supplied</label>
                        <input type="number" class="form-control" name="quantity" placeholder="quantity supplied..." value="{{$supply->quantity}}" autofocus required>
                    </div>

                    <div class="form-group">
                        <label for="ammount">Value</label>
                        <input type="number" class="form-control" name="quantity_value" placeholder="how much is it worth?" value="{{$supply->value}}" autofocus required>
                    </div>

                    <div class="form-group">
                        <label for="date_supplied">Date supplied: {{$supply->supplied_at()}}</label>
                        <input type="date" class="form-control" name="date_supplied" value="{{$supply->supplied_at->format('Y-m-d')}}">
                    </div>

                    <div class="form-group">
                        <label for="note">Note <small><i>(optional)</i></small></label>
                        <p class="grey">Important information to note down regarding this transaction</p>
                        <textarea name="note" id="note"  class="ckeditor form-control">{{$supply->note}}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">update supply</button>
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
            <h5>other supplies for {{$supply->customer()->firstname}}</h5>
        </div>
        <div class="card-body">
            <?php $supply_collection = $supply->customer()->supplies()->where('id','!=',$supply->id)->get() ?>
            @include('supply.widgets.default')
        </div>
     </div>
@endsection