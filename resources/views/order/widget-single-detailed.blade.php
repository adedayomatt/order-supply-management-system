        <div class="list-group-item">
            <a href="{{route('order.show',[$order->id])}}">order {{$order->id()}}</a> <small>{!!$order->status()!!}</small>
            <div class="text-center">
                <table class="table-bordered table table-striped">
                    <tr>
                        <td colspan="2">Order</td>
                    </tr>
                    <tr>
                        <td><strong class="figure">{{number_format($order->quantity)}}</strong> {{$_unit}}</td>
                        <td><strong class="figure">&#8358; {{number_format($order->ammount)}}</strong></td>
                    </tr>
                </table>

                <table class="table-bordered table table-striped">
                    <tr>
                        <td>Supplied</td>
                        <td>Paid</td>
                    </tr>
                    <tr>
                        <td><strong class="figure">{{number_format($order->totalSupplied()['quantity'])}}</strong> {{$_unit}}</td>
                        <td><strong class="figure">&#8358; {{number_format($order->totalSupplied()['ammount'])}}</strong></td>
                    </tr>
                </table>

                <table class="table-bordered table table-striped">
                    <tr>
                        <td>Outstanding</td>
                        <td>Balance</td>
                    </tr>
                    <tr>
                        <td><strong class="figure">{{number_format($order->outstanding()['quantity'])}}</strong> {{$_unit}}</td>
                        <td><strong class="figure">&#8358; {{number_format($order->outstanding()['ammount'])}}</strong></td>
                    </tr>
                </table>
            </div>
            @if($order->isSuppliable())
                <div class="text-right">
                    <small><a href="{{route('supply.create',[$order->id])}}" class="btn btn-sm btn-success">New supply</a></small>
                </div>
            @endif
        </div>
