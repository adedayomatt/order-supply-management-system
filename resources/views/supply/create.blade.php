@extends('layouts.appRHSfixed')


@section('main')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
               <h5>New Supply</h5>
            </div>
            <div class="card-body">
                <form action="{{route('supply.store')}}" method="POST">
                    @csrf
                    @if(isset($customer))
                        <p>For  <a href="{{route('customer.show',[$customer->id])}}">{{$customer->fullname()}}</a></p>
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
                        <label for="">Product type</label>
                        <select name="product_type" class="form-control" required>
                            <option value="unicem" {{old('product_type') == 'unicem' ? 'selected' : ''}}>Unicem</option>
                            <option value="superset" {{old('product_type') == 'supaset' ? 'selected' : ''}}>Supaset</option>
                            <option value="elephant" {{old('product_type') == 'elephant' ? 'selected' : ''}}>Elephant</option>
                            <option value="dangote" {{old('product_type') == 'dangote' ? 'selected' : ''}}>Dangote</option>
                            <option value="dua" {{old('product_type') == 'bua' ? 'selected' : ''}}>Bua</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity supplied</label>
                        <input type="number" class="form-control" name="quantity" placeholder="quantity supplied..." value="{{old('quantity')}}" autofocus required>
                    </div>

                    <div class="form-group">
                        <label for="ammount">Value</label>
                        <input type="number" class="form-control" name="quantity_value" placeholder="how much is it worth?" value="{{old('quantity_value')}}" autofocus required>
                    </div>

                    <div class="form-group">
                        <label for="date_supplied">Date supplied</label>
                        <input type="date" class="form-control" name="date_supplied" value="{{old('date_supplied')}}">
                    </div>

                    <div class="form-group">
                        <label for="note">Note <small><i>(optional)</i></small></label>
                        <p class="grey">Important information to note down regarding this transaction</p>
                        <textarea name="note" id="note"  class="ckeditor form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add supply</button>
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
            <h5>{{$customer->firstname}} prev. supplies</h5>
        </div>
        <div class="card-body">
            <?php $supply_collection = $customer->supplies ?>
            @include('supply.widgets.default')
        </div>
     </div>
    @else
    <div class="card">
        <div class="card-header">
            <h5>Recent Supplies</h5>
        </div>
        <div class="card-body">
           @include('supply.widgets.default')
        </div>
     </div>
    @endif
@endsection