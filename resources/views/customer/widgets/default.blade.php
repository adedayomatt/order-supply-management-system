<?php
    $collection = isset($customer_collection) ? $customer_collection: $_customer::orderby('created_at','desc')->get();
?>
            @if($collection->count() >0 )
                <div class="list-group">
                    @foreach($collection as $customer)
                        <div class="list-group-item" >
                            <i class="fa fa-user"></i> <a href="{{route('customer.show',[$customer->id])}}">{{$customer->fullname()}}</a>
                            <div class="d-flex text-center">
                                <div class="mr-auto">
                                   <i class="fa fa-arrow-up"></i> Last Supply
                                   @if($customer->lastSupply() !== null)
                                        <div>
                                        {{number_format($customer->lastSupply()->quantity)}} {{$_unit}} (&#8358;{{number_format($customer->lastSupply()->value)}})
                                        </div>
                                        <small> {{$customer->lastSupply()->created_at->diffForHumans()}}</small>
                                   @else
                                   <div class="text-center grey">
                                        <small><i class="fa fa-exclamation-triangle text-danger"></i> Never supplied</small>
                                   </div>
                                   @endif
                                </div>
                                <div class="ml-auto">
                                    <i class="fa fa-wallet"></i> Wallet
                                    <div class="{{$customer->wallet()->balance < 0 ? 'text-danger' : ''}}">
                                        &#8358; {{number_format($customer->wallet()->balance)}}
                                    </div>
                                    <div>
                                        <small class="ml-3">Last remit: {{$customer->lastPayment() !== null ? $customer->lastPayment()->created_at->diffForHumans(): 'Never paid'}}</small>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center grey" style="padding: 10px">
                   <i class="fa fa-exclamation-triangle"></i>  No customer found
                </div>
            @endif

