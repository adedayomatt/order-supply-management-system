@extends('layouts.app')

@section('main')
<div class="content-box grey">
        <p>Supplies: <strong>{!!$period!!}</strong>  <span class="badge badge-secondary figure">{{$supplies->count()}}</span></p> 
    </div>

<div class="content-box">
    @if($supplies->count() > 0)
        @include('supply.widget-table')
    @else
        <div class="grey text-center">
            No supply found
        </div>
    @endif
</div>
@endsection
