<?php
    $collection = isset($w_collection) ? $w_collection: $_orders::orderby('created_at','desc')->get();
?>
            @if($collection->count() >0 )
                <div class="list-group">
                    @foreach($collection as $order)
                        <div class="list-group-item" >
                            Order 
                            <strong>
                                <a href="{{route('order.show',[$order->id])}}">{{$order->id()}}</a>
                            </strong>
                            <small> For <a href="{{route('customer.show',[$order->customer->id])}}">{{$order->customer->fullname()}}</a></small>
                            
                            <div class="d-flex my-2">
                                <div class="mr-auto">
                                    Type: <span class="type">{{$order->type}}</span>
                                </div>
                                <div class="mr-auto">
                                    Quantity: <strong class="figure">{{number_format($order->quantity)}}</strong>{{$_unit}}
                                </div>
                                <div class="ml-auto">
                                    <span class="grey">Supplied</span>
                                    <strong class="figure">{{number_format($order->totalSupplied()['quantity'])}}</strong> {{$_unit}}
                                </div>
                            </div>

                            <div class="d-flex my-2">
                                <div class="mr-auto">
                                    Outstanding: <strong class="figure">{{number_format($order->outstanding()['quantity'])}}</strong>{{$_unit}}
                                </div>
                                <div class="ml-auto">
                                    <span class="grey">Balance</span>
                                    <strong class="figure">&#8358; {{number_format($order->outstanding()['ammount'])}}</strong>
                                </div>
                            </div>

                            <div class="text-center">
                                {!!$order->status()!!}
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center grey" style="padding: 10px">
                   <i class="fa fa-exclamation-triangle"></i>  No order found
                </div>
            @endif

