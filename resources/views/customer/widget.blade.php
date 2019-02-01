<?php
    $title = isset($w_title) ? $w_title: 'Customers';
    $collection = isset($w_collection) ? $w_collection: $_customers::all();
?>
<div class="content-box">
        <h5>{{$title}}</h5>
       <div class="mt-2">
            @if($collection->count() >0 )
                <div class="list-group">
                    @foreach($collection as $customer)
                        <div class="list-group-item" >
                            <strong>
                                <a href="{{route('customer.show',[$customer->id])}}">{{$customer->fullname()}}</a>
                            </strong>
                            <div class="grey">
                                <small >Added {{$customer->created_at->diffForHumans()}}</small>
                                <small class="ml-3">Last supplied: {{$customer->lastSupply() !== null ? $customer->lastSupply()->created_at->diffForHumans(): 'Never supplied'}}</small>
                            </div>
                            <div>
                                <span><span class="badge badge-secondary">{{$customer->orders->count()}}</span> Orders</span>
                                <span class="ml-3"><span class="badge badge-secondary">{{$customer->supplies()->count()}}</span> Supplies</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center" style="padding: 10px">
                    <small class="text-danger"><i class="fa fa-exclamation-triangle"></i>  No customer found</small>
                </div>
            @endif
       </div>
   </div>
  

