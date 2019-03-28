<?php
    $collection = isset($payment_collection) ? $payment_collection: $_payment::orderby('created_at','desc')->get();
?>
            @if($collection->count() >0 )
                <div class="list-group ">
                    @foreach($collection->sortByDesc('created_at') as $payment)
                        <div class="list-group-item has-hidden-action" >
                            <a class="{{$payment->customer()->isDeleted() ? 'text-danger' : ''}}" href="{{route('customer.show',[$payment->customer()->id])}}">{{$payment->customer()->fullname()}}</a> <i class="fa fa-arrow-right"></i>  &#8358; {{number_format($payment->ammount)}}
                            <div class="d-flex my-2">
                                <div class="mr-auto">
                                    Bank: <span class="type">{{$payment->bank}}</span>
                                </div>
                                <small class="ml-auto">paid: {{$payment->paid_on()}}</small>
                            </div>
                            <div class=>
                                <small><i class="fa fa-user-tie"></i> <a href="{{route('user.show',[$payment->user()->id])}}"  class="{{$payment->user()->isDeleted() ? 'text-danger' : ''}}">{{$payment->user()->fullname()}}</a>. {{$payment->created_at()}}, {{$payment->created_at->diffForHumans()}} </small>
                            </div>
                            <div class="hidden-action text-right">
                                @include('payment.widgets.delete')
                            </div>
                        </div>
                        
                    @endforeach
                </div>
            @else
            <div class="text-center">
                <h1 class="text-danger"><i class="fa fa-ban"></i></h1>
                <h4 class="grey">No payment found</h4> 
            </div>
            @endif

