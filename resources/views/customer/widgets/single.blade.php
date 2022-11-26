<h4>{{$customer->fullname()}}</h4>
<div class="d-flex text-center">
    <div class="mr-auto">
        <i class="fa fa-arrow-up"></i> Last Supply
        @if($customer->lastSupply() !== null)
            <div>
            {{number_format($customer->lastSupply()->quantity)}} {{$_unit}} (&#8358;{{number_format($customer->lastSupply()->value)}})
            </div>
            <small> {{$customer->lastSupply()->supplied_at->format('d M, Y')}}. {{$customer->lastSupply()->created_at->diffForHumans()}}</small>
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
