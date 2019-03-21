@if($customer->payments()->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ammount(&#8358;)</th>
                <th>Bank</th>
                <th>Date Paid</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                @foreach($customer->payments()->sortByDesc('created_at') as $payment)
                    <tr>
                        <td>{{number_format($payment->ammount)}}</td>
                        <td>{{$payment->bank}}</td>
                        <td>{{$payment->paid_on}}</td>
                        <td>
                            <small ><i class="fa fa-pen"></i> Recorded by <a href="{{route('user.show',[$payment->user()->id])}}" class="{{$payment->user()->isDeleted() ? 'text-danger' : ''}}">{{$payment->user()->fullname()}}</a> on {{$payment->created_at()}}, {{$payment->created_at->diffForHumans()}} </small>
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
