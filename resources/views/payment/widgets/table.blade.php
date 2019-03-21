<?php
    $collection = isset($payment_collection) ? $payment_collection: $_payment::orderby('paid_on','desc')->get();
?>
@if($collection->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Ammount(&#8358;)</th>
                <th>Bank</th>
                <th>Date Paid</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                @foreach($collection as $payment)
                    <tr>
                        <td >
                            <i class="fa fa-user"></i> <strong><a href="{{route('customer.show',[$payment->customer()->id])}}" class="{{$payment->customer()->isDeleted() ? 'text-danger' : ''}}">{{$payment->customer()->fullname()}}</a></strong>
                            @if($payment->customer()->email != null)
                                <div>
                                    <small><a href="mailto: {{$payment->customer()->email}}">{{$payment->customer()->email}}</a></small>
                                </div>
                            @endif
                            @if($payment->customer()->phone != null)
                                <div>
                                    <small><a href="tel: {{$payment->customer()->phone}}">{{$payment->customer()->phone}}</a></small>
                                </div>
                            @endif
                        </td>
                        <td>{{number_format($payment->ammount)}}</td>
                        <td>{{$payment->bank}}</td>
                        <td>{{$payment->paid_on()}}</td>
                        <td >
                            <small class="grey"><i class="fa fa-pen"></i> Recorded by <a href="{{route('user.show',[$payment->user()->id])}}" class="{{$payment->user()->isDeleted() ? 'text-danger' : ''}}">{{$payment->user()->fullname()}}</a> on {{$payment->created_at->toDayDateTimeString()}}, {{$payment->created_at->diffForHumans()}} </small>
                            <hr>
                            @if($payment->note === null)
                            <div class="text-center">
                                <small class="text-danger">No Note</small>
                            </div>
                            @else
                                <div>
                                    {!!$payment->note!!}
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach

        </tbody>
    </table>
    @else
        <div class="text-center">
            <h1 class="text-danger"><i class="fa fa-ban"></i></h1>
            <h4 class="grey">No payment found</h4> 
        </div>
    @endif
