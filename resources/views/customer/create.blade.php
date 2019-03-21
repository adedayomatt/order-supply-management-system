
@extends('layouts.appRHSfixed')

@section('main')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">New Customer</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('customer.store') }}" >
                    @csrf
                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                        <label for="firstname" class="control-label">First Name</label>

                        <div class="">
                            <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="customer's first name" required autofocus>

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
                            <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="customer's last name" autofocus>

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
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="customer's email address" autofocus>
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
                            <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="customer's phone address" required autofocus>
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
                                Add Customer
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
   
@endsection

@section('RHS')
    <div class="card">
        <div class="card-header">
            <h4>Customers</h4>
        </div>
        <div class="card-body">
            @include('customer.widgets.default')
        </div>
    </div>
@endsection
