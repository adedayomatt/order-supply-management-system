@extends('layouts.app')

@section('main')
<?php $supply_collection = $supplies ?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4">
            @if(isset($customer))
                <h5><a href="{{route('customer.show',[$customer->id])}}">{{$customer->fullname()}}</a><span style="font-size: 14px">'s supplies</span></h5>
                @elseif(isset($user))
                    <h5><span style="font-size: 14px">supplies recorded by </span><a href="{{route('user.show',[$user->id])}}">{{$user->fullname()}}</a></h5>
                @endif
                <h4>Period: <strong>{!!$period!!}</strong> <span class="badge badge-primary figure">{{$supply_collection->count()}} records</span></h4> 
            </div>
            <div class="col-md-8">
                @include('supply.widgets.aggregate')
                <div class="text-right">
                    @if(isset($customer))
                        <a href="{{route('customer.supply.create',[$customer->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add supply for {{$customer->firstname}}</a>
                    @else
                        <a href="{{route('supply.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New supply</a>
                    @endif
                </div>
            </div>
        </div>

        <button data-toggle="collapse" class="btn btn-sm btn-secondary m-3" data-target="#filter"><i class="fa fa-filter"></i> Filter Month</button>
        @if(request()->get('month') != 'all')
            <a href="?month=all&year=all" class="btn btn-sm btn-info m-3"><i class="fa fa-eye-open"></i> view all</a>
        @endif

    </div>
    <div class="card-body">
        <div class="collapse" id="filter">
            <form action="<?php $_PHP_SELF ?>" method="GET">
                @include('widgets.filter')
            </form>
        </div>
        <div class="scrollable">
            @include('supply.widgets.table')
        </div>
    </div>
</div>
@endsection
