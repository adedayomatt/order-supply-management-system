
@extends('layouts.app')

@section('main')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="content-box">
            <h5>Staff</h5>
        </div>
        @if($users->count() > 0)
            @foreach($users as $user)
                <div class="content-box">
                    <div class="d-flex">
                        <div class="text-right">
                            <img src="{{$user->avatar()['src']}}" alt="{{$user->avatar()['alt']}}" class="avatar-sm">
                        </div>
                        <div class="ml-2">
                            <h5><a href="{{route('user.show',[$user->id])}}">{{$user->fullname()}}</a></h5>
                            <div class="grey">
                                <p><i class="fa fa-user"></i>  {{$user->position()}}</p>
                                <div>
                                    <small>Added {{$user->created_at->diffForHumans()}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        <div class="text-center text-danger">
            <i class="fa fa-exclamation-triangle"></i> No user found
        </div>
        @endif
    </div>
</div>
   
@endsection

