<?php
    $collection = isset($supply_collection) ? $supply_collection: $_supply::orderby('supplied_at','desc')->get();
?>
@if($collection->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Quantity</th>
                <th>Supplied on</th>
                <th></th>
                <!-- <th></th> -->
                
            </tr>
        </thead>
        <tbody>
            @foreach($collection as $supply)
                <tr>
                    <td >
                        <i class="fa fa-user"></i> <strong><a href="{{route('customer.show',[$supply->customer()->id])}}" class="{{$supply->customer()->isDeleted() ? 'text-danger' : ''}}">{{$supply->customer()->fullname()}}</a></strong>
                        <div>
                            <small><a href="mailto: {{$supply->customer()->email}}">{{$supply->customer()->email}}</a></small>
                        </div>
                        <div>
                            <small><a href="tel: {{$supply->customer()->phone}}">{{$supply->customer()->phone}}</a></small>
                        </div>
                    </td>
                    <td>{{number_format($supply->quantity)}}</td>
                    <td>{{$supply->supplied_at()}}</td>
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
                    <!-- <td>
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
                    </td> -->
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
