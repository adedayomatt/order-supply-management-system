@extends('layouts.appRHSfixed')

@section('main')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="content-box text-center">
            <h5>New Order</h5>
            @if(isset($customer))
                for <a href="{{route('customer.show',[$customer->id])}}"><strong>{{$customer->fullname()}}</a></strong>
            @endif 
        </div>

        <div class="content-box">
            <form action="{{route('order.store')}}" method="POST">
                @csrf
                @if(isset($customer))
                    <input type="hidden" name="customer" value="{{$customer->id}}">
                @else
                    <div class="form-group">
                        <label for="customer">Select customer</label>
                        <select name="customer" id="customer" class="form-control" required>
                            <?php $customers = $_customers::all() ?>
                            @foreach($customers as $customer)
                                <option value="{{$customer->id}}" {{old('customer') === $customer->id ? 'selected' : ''}}>{{$customer->fullname()}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="form-group">
                    <label for="quantity">Quantity ordering for</label>
                    <input type="number" class="form-control" name="quantity" placeholder="quantity requesting for..." value="{{old('quantity')}}" autofocus required>
                </div>

                <div class="form-group">
                    <label for="ammount">Ammount</label>
                    <input type="number" class="form-control" name="ammount" placeholder="how much is it worth?" value="{{old('ammount')}}" autofocus required>
                </div>

                <div class="form-group">
                    <label for="ammount">Note</label>
                    <small class="grey">Important notes about this order</small>
                    <textarea name="note" id="note" class="ckeditor form-control"></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Create Order">
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
@section('RHS')
    <div class="content-box">
        <h5>Recent Orders</h5>
        <?php $w_collection = $_orders::orderby('created_at','desc')->get(); ?>
        @include('order.widget')

    </div>
@endsection