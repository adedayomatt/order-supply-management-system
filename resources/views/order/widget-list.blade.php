<?php
    $collection = isset($w_collection) ? $w_collection: $_orders::orderby('created_at','desc')->get();
?>
@if($collection->count() > 0)
    <div class="list-group">
        @foreach($collection as $order)
            @include('order.widget-single-detailed')
        @endforeach
    </div>
@else
    <div class="grey text-center">
       No order found
    </div>
@endif