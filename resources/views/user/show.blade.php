
@extends('layouts.appRHSfixed')

@section('main')

    <div class="content-box">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h4>{{$user->fullname()}}</h4>
          <p class="grey"><i class="fa fa-user-tie"></i> {{$user->position()}}</p>
        </div>

        <div class="col-md-4">
          <div class="text-center">
            <h5>Contacts</h5>
            @if($user->email != null)
              <strong class="m-2"><a href="mailto: {{$user->email}}"><i class="fa fa-envelope"></i> {{$user->email}}</a></strong>
            @endif

            @if($user->phone != null)
              <strong class="m-2"><a href="tel: {{$user->phone}}"><i class="fa fa-phone"></i> {{$user->phone}}</a></strong>
            @endif

            @if(auth()->user()->isSuperAdmin() || auth()->user()->isMD() || auth()->user()->isManager() || auth()->user()->isAdmin())
              <div class="text-right">
                @if(!$user->isSuperAdmin())
                  <button class="btn btn-sm btn-warning" data-toggle="collapse" data-target="#edit-delete">edit/delete</button>
                  <div class="collapse" id="edit-delete">
                    <form action="{{route('user.destroy',[$user->id])}}" method="POST">
                      <a href="{{route('user.edit',[$user->id])}}"> <i class="fa fa-pen"></i> Edit</a>
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-link text-danger"><i class="fa fa-trash"></i> delete user</button>
                    </form>
                  </div>
                @endif
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="card">
            <div class="card-header">
              <h5>Supplies created by {{$user->firstname}} - {{$user->supplies->count()}}</h5>
              <a href="{{route('user.supplies',[$user->id])}}">view supplies</a>
            </div>
            <div class="card-body scrollable">
                <?php $supply_collection = $user->supplies ?>
                @include('supply.widgets.default')
            </div>
        </div>
      </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5>Payments recorded by {{$user->firstname}}- {{$user->supplies()->count()}}</h5>
          <a href="{{route('user.payments',[$user->id])}}">view payments</a>
        </div>
        <div class="card-body scrollable">
          <?php $payment_collection = $user->payments ?>
            @include('payment.widgets.default')
        </div>
      </div>
    </div>
  </div>
@endsection

@section('RHS')
<div class="card">
  <div class="card-header">
    <h5>Other users</h5>
  </div>
  <div class="card-body">
    <?php
      $user_collection = $_user::where('id','!=',$user->id)->where('position','!=',1)->get();
    ?>
    @include('user.widget')
  </div>
</div>
@endsection
