
<div class="content-box">
            <p>
                Customer: <strong><a href="{{route('customer.show',[$order->customer->id])}}">{{$order->customer->fullname()}}</a></strong>
            </p>
            <p>
                Outstanding: <strong class="figure">{{number_format($order->outstanding()['quantity'])}}</strong> {{$_unit}} 
            </p>
            <p>
                Balance: <strong class="figure">(&#8358; {{number_format($order->outstanding()['ammount'])}})</strong>
            </p>
            <p>
                status: {!!$order->status()!!}
            </p>
</div>


