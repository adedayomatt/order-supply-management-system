@extends('layouts.app')

@section('main')
<?php $payment_collection = $payments ?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-7">
                @if(isset($customer))
                <h5>{{$customer->fullname()}}</h5>
                @endif
                <h4>Period: <strong>{!!$period!!}</strong><span class="badge badge-primary figure">{{$payment_collection->count()}} records</span></h4> 
            </div>
            <div class="col-md-5">
                @include('payment.widgets.aggregate')
                <div class="text-right">
                    @if(isset($customer))
                        <a href="{{route('customer.payment.create',[$customer->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add payment for {{$customer->firstname}}</a>
                    @else
                        <a href="{{route('payment.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New payment</a>
                    @endif
                </div>
            </div>
        </div>
        <button data-toggle="collapse" class="btn btn-sm btn-secondary m-3" data-target="#filter"><i class="fa fa-filter"></i> Filter Month</button>
        @if(request()->get('month') != 'all')
        <a href="?month=all&year=all" class="btn btn-sm btn-info m-3"><i class="fa fa-eye-open"></i> view all</a>
         @endif
    </div>
    <div class="card-body" >
        <div class="collapse" id="filter">
            <form action="<?php $_PHP_SELF ?>" method="GET">
                @include('widgets.filter')
            </form>
        </div>
        <div class="scrollable">
            @include('payment.widgets.table')
        </div>
    </div>
</div>
@endsection
