
@extends('layouts.app')

@section('main')
<div class="card">
    <div class="card-header">
        <h4>Customers</h4>
    </div>
    <div class="card-body scrollable">
        @if($customers->count() > 0)
            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th>Contact</th>
                        <th>Wallet Bal</th>
                        <th>Last supply</th>
                        <th>Total Supplies</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td class="text-left"><i class="fa fa-user"></i> <strong><a href="{{route('customer.show',[$customer->id])}}">{{$customer->fullname()}}</a></strong></td>
                            <td>
                                @if($customer->email != null)
                                    <div class="text-center">
                                        <a href="mailto: {{$customer->email}}">{{$customer->email}}</a>
                                    </div>
                                @endif
                                @if($customer->phone != null)
                                    <div class="text-center">
                                        <a href="tel: {{$customer->phone}}">{{$customer->phone}}</a>
                                    </div>
                                @endif
                            </td>
                            <td class="{{$customer->wallet()->balance < 0 ? 'text-danger' : ''}}">
                            &#8358; {{number_format($customer->wallet()->balance)}}
                            </td>
                            <td>
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
                            </td>
                            <td>
                                {{number_format($customer->totalSupplies()['quantity'])}} {{$_unit}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center grey">
                No Customer found 
                <a href="{{route('customer.create')}}" class="btn btn-primary">Add one now</a>
            </div>
        @endif
    </div>
</div>
@endsection

