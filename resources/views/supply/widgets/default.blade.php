<?php
    $collection = isset($supply_collection) ? $supply_collection: $_supply::orderby('created_at','desc')->get();
?>
            @if($collection->count() >0 )
                <div class="list-group">
                    @foreach($collection->sortByDesc('created_at') as $supply)
                        <div class="list-group-item" >
                           {{$supply->quantity}} {{$_unit}} <i class="fa fa-arrow-right"></i> <a href="{{route('customer.show',[$supply->customer()->id])}}" class="{{$supply->customer()->isDeleted() ? 'text-danger' : ''}}">{{$supply->customer()->fullname()}}</a>
                            <div class="d-flex my-2">
                                <div class="mr-auto">
                                    Type: <span class="type">{{$supply->type}}</span>
                                </div>
                                <div class="ml-auto">
                                    Value: {{number_format($supply->value)}}
                                </div>
                            </div>
                            <small class="grey">{{$supply->supplied_at()}}</small>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <h1 class="text-danger"><i class="fa fa-ban"></i></h1>
                    <h4 class="grey">No supply found</h4> 
                </div>
            @endif

