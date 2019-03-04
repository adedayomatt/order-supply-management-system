
@extends('layouts.app')

@section('main')

<div class="row justify-content-center">
    <div class="col-md-4 col-sm-6">
        <div class="content-box">
            <div class="p-3">
                Update customer: <strong><a href="{{route('customer.show',[$customer->id])}}">{{$customer->fullname()}}</a></strong>
            </div>
            <form method="POST" action="{{ route('customer.update',[$customer->id]) }}" >
                @csrf
                @method('PUT')

                <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                    <label for="firstname" class="control-label">First Name</label>

                    <div class="">
                        <input id="firstname" type="text" class="form-control" name="firstname" value="{{ $customer->firstname }}" placeholder="customer's first name" required autofocus>

                        @if ($errors->has('firstname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                    <label for="lastname" class="control-label">Last Name</label>

                    <div class="">
                        <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $customer->lastname }}" placeholder="customer's last name" required autofocus>

                        @if ($errors->has('lastname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">E-Mail Address</label>

                    <div class="">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $customer->email }}" placeholder="customer's email address" autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone" class="control-label">Phone</label>

                    <div class="">
                        <input id="phone" type="phone" class="form-control" name="phone" value="{{ $customer->phone }}" placeholder="customer's phone address" required autofocus>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group">
                    <div class="text-center" >
                        <button type="submit" class="btn btn-primary btn-block">
                            Update Customer
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
   
@endsection

