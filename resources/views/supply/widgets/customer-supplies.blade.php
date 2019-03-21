@if($customer->supplies()->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th >Quantity</th>
                <th>Date supplied</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($customer->supplies()->sortByDesc('supplied_at') as $supply)
                <tr>
                    <td>{{number_format($supply->quantity)}}</td>
                    <td>{{$supply->supplied_on()}}</td>
                    <td>
                        <small><i class="fa fa-pen"></i> Recorded by <a href="{{route('user.show',[$supply->user()->id])}}"  class="{{$supply->user()->isDeleted() ? 'text-danger' : ''}}">{{$supply->user()->fullname()}}</a> on {{$supply->created_at()}}, {{$supply->created_at->diffForHumans()}} </small>
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
                        <a href="{{route('order.show',[$supply->order->id])}}" class="btn btn-sm btn-primary m-1"><i class="fa fa-eye"></i> view order</a>
                        @if($supply->reverted())
                        <div>
                            <small class="text-warning"><i class="fa fa-undo"></i> Reverted on {{$supply->reverted_at()}} by <strong><a href="{{route('user.show',[$supply->reverted_by()->id])}}">{{$supply->reverted_by()->fullname()}}</a></strong></small>
                        </div>
                        @else
                            <form action="{{route('supply.revert',[$supply->id])}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm m-1"><i class="fa fa-undo"></i> Revert</button>
                            </form>
                        @endif
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="text-center">
        <h1 class="text-danger"><i class="fa fa-ban"></i></h1>
        <h4 class="grey">No supply found</h4> 
    </div>
@endif
