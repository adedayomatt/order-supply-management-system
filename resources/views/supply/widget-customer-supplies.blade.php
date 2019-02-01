    <table class="table table-striped table-hovered">
        <thead>
            <tr>
                <th>Order</th>
                <th >Quantity</th>
                <th>Supplied</th>
                <th>Payment <br>(&#8358; )</th>
                <th>Bank</th>
                <th>Transaction ID</th>
                <th></th>
                <th></th>
                
            </tr>
        </thead>
        <tbody>
        @if($customer->supplies()->count() > 0)
            @foreach($customer->supplies() as $supply)
                <tr>
                    <td><a href="{{route('order.show',[$supply->order->id])}}">{{$supply->order->id()}}</a></td>
                    <td>{{number_format($supply->quantity)}}</td>
                    <td>{{$supply->supplied_at()}}</td>
                    <td>{{number_format($supply->ammount)}}</td>
                    <td>{{$supply->bank}}</td>
                    <td>{!!$supply->transaction_id === null ? '<small class="text-danger">No transaction ID</small>' : $supply->transaction_id!!}</td>
                    <td>
                        <small class="grey">Recorded by <a href="{{route('user.show',[$supply->user->id])}}">{{$supply->user->fullname()}}</a> on {{$supply->created_at()}}, {{$supply->created_at->diffForHumans()}} </small>
                        <hr>
                        @if($supply->note === null)
                        <div class="text-center">
                            <small class="text-danger">No Note</small>
                        </div>
                        @else
                            <div>
                               
                                {!!$supply->note!!}
                            </div>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('order.show',[$supply->order->id])}}" class="small">view order</a>
                        @if($supply->reverted())
                        <div>
                            <small class="text-danger">Reverted on {{$supply->reverted_at()}} by <strong><a href="{{route('user.show',[$supply->reverted_by()->id])}}">{{$supply->reverted_by()->fullname()}}</a></strong></small>
                        </div>
                        @else
                            <form action="{{route('supply.revert',[$supply->id])}}" method="POST">
                                @csrf
                                <input type="submit" class="btn btn-link small text-warning" value="revert">
                            </form>
                        @endif
                        
                    </td>
                </tr>
            @endforeach
            @else
                <tr class="grey text-center">
                    <td colspan="8">
                        {{$customer->fullname()}} does not have any supply record
                    </td>
                </tr>
            @endif

        </tbody>
    </table>
