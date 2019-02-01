@extends('layouts.appLHSfixed')

@section('LHS')
<div class="content-box">
    <h5>Orders</h5>
    <div class="scrollable">
        @include('order.widget')
    </div>
</div>
@endsection

@section('main')
    <div class="content-box">
        <h5>Supplies</h5>
        @include('supply.widget-table')
    </div>
@endsection
