<?php
    $title = isset($w_title) ? $w_title: 'Users';
    $collection = isset($w_collection) ? $w_collection: $_users::all();
?>
<div class="content-box">
        <h5>{{$title}}</h5>
            @if($collection->count() >0 )
                <div class="list-group">
                    @foreach($collection as $user)
                        <div class="list-group-item" >
                            <div class="d-flex">
                                <img src="{{$user->avatar()['src']}}" alt="{{$user->avatar()['alt']}}" class="avatar avatar-sm">
                                <div class="ml-3">
                                    <strong>
                                        <a href="{{route('user.show',[$user->id])}}">{{$user->fullname()}}</a>
                                    </strong>
                                    <br>
                                    <small class="grey">{{$user->position()}}</small>       
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center" style="padding: 10px">
                    <small class="text-danger"><i class="fa fa-exclamation-triangle"></i>  No user found</small>
                </div>
            @endif
   </div>
  

