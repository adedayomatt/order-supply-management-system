
@extends('layouts.app')

@section('main')

<div class="content-box">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h5 class="grey">Staff</h5>
        <h4>{{$user->fullname()}}</h4>
        <h5 class="grey">{{$user->position()}}</h5>
        @if(auth()->user()->position === 4)
            <a href="{{route('user.edit',[$user->id])}}">edit</a>
        @endif

      </div>
      <div class="col-md-4">
          <div class="text-center">
          <h5>Contacts</h5>
            <strong class="m-5"><a href="mailto: {{$user->email}}">{{$user->email}}</a></strong>
            <strong class="m-5"><a href="tel: {{$user->phone}}">{{$user->phone}}</a></strong>
          </div>
      </div>
    </div>
  </div>


    <div class="row">
    <div class="col-md-4">
      <div class="content-box">
        <h5>Orders created by {{$user->firstname}} - {{$user->orders->count()}}</h5>
        <a href="{{route('user.orders',[$user->id])}}">view orders</a>
          <div class="scrollable">
            @if($user->orders->count() > 0)
            <?php $orders = $user->orders ?>
              @include('order.widget')
            @else
             
              <div class="grey text-center">
                @if(auth()->user()->id === $user->id)
                  You have not created any order
                <a href="{{route('order.create')}}" class="btn btn-primary">Create order</a>
                @else
                  {{$user->fullname()}} have not created any order
                @endif
              </div>
            @endif
          </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="content-box">
      <h5>Supplies recoded by {{$user->firstname}}- {{$user->supplies()->count()}}</h5>
      <a href="{{route('user.supplies',[$user->id])}}">view supplies</a>
      <div class="scrollable">
        <?php $supplies = $user->supplies ?>
          @include('supply.widget-table')
      </div>
      </div>
    </div>

    <div class="col-md-2">
      <div class="content-box">
        <p>Supplies reverted by {{$user->firstname}} - {{$user->orders->count()}}</p>
          <div class="scrollable">
            @if($user->reverts()->count() > 0)
                <div class="list-group">
                    @foreach($user->reverts() as $supply)
                        <div class="list-group-item">
                            supply #{{$supply->id}} for order <a href="{{route('order.show',[$supply->order->id])}}">{{$supply->order->id()}}</a>
                            <div class="text-right">
                                <small>{{$supply->reverted_at()}}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
              <div class="grey text-center">
                No supply reverted
              </div>
            @endif
          </div>
      </div>
    </div>


  </div>


@endsection

@section('RHS')
<div class="content-box">
    @include('user.widget')
</div>
@endsection

@section('styles')

@endsection
