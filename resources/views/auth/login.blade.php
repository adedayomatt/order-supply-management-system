@extends('layouts.plain')

@section('main')
    @if(Auth::guest())
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-sm-6  col-md-4">
                <div class="content-box mt-5 py-5">
                    <h5 class="text-center mb-3">{{ __('Login') }}</h5>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="">{{ __('E-Mail Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="">{{ __('Password') }}</label>
                            <div class="">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @else
    <div class="row justify-content-center">
            <div class="col-md-6">
                <div style="padding-top: 3%">
                    <div class="p-5 text-center bg-white" >
                        <h1 style="font-size: 60px">Global 50-50</h1>
                            <h4>How is going today <strong>{{auth()->user()->fullname()}} ???</strong></h4>
                            <div>
                                <iframe src="https://free.timeanddate.com/clock/i6m40vau/n1972/szw210/szh210/hocfff/hbw0/cf100/hgr0/fas28/facfff/fdi90/mqc000/mqs2/mql3/mqw4/mqd70/mhc000/mhs2/mhl3/mhw4/mhd70/mmv0/hwm2/hhs3/hms3/hsc00f" frameborder="0" width="210" height="210"></iframe>
                            </div>
                            <div>
                            <iframe src="https://free.timeanddate.com/clock/i6m40vau/n1972/fn7/fs20/fcfff/tct/pct/ftb/th2" frameborder="0" width="128" height="30" allowTransparency="true"></iframe>
                            </div>
                            <a href="{{route('index')}}" class="btn btn-lg btn-primary">Get back to work <i class="fa fa-play-circle" style="font-size: 30px"></i></a>
                    </div>
                </div>

            </div>
        </div>

    @endif

@endsection
