
@extends('layouts.app')

@section('main')
<div class="row justify-content-center">
    <div class="col-md-8">
            
            <form method="POST" action="{{ route('user.store') }}" class="has-image-upload" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="content-box">
                            <h5 class="text-center">New User</h5>
                            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label for="firstname" class="control-label">First Name</label>

                                <div class="">
                                    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="user's first name" required autofocus>

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
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="user's last name" required autofocus>

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
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="user's email address" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                                <label for="position" class="control-label">Position</label>

                                <div class="">
                                    <select name="position" id="position" class="form-control" required>
                                        <option value="1" {{old('position') == 1 ? 'selected' : ''}}>Customer Service</option>
                                        <option value="2" {{old('position') == 2 ? 'selected' : ''}}>Marketer</option>
                                        <option value="3" {{old('position') == 3 ? 'selected' : ''}}>Manager</option>
                                        <option value="4" {{old('position') == 4 ? 'selected' : ''}}>Managing Director</option>
                                    </select>
                                    @if ($errors->has('position'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('position') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="control-label">Phone</label>

                                <div class="">
                                    <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="user's phone number" required autofocus>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">Password</label>
                                <p class="grey"><small>Create password for the new user. He/She may change it later</small></p>
                                <div class="">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="user's default password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="control-label">Confirm Password</label>

                                <div class="">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="repeat password" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-sm-4">
                        <div class="content-box">
                            <div class="text-center">
                                    <img id="user-avatar-preview" src="{{asset('storage/images/users/default.png')}}" alt="User Avatar" width="100%"> 
                            </div>
                            <div class="image-preview-container text-center" replace="#user-avatar-preview"></div>
                            <div class="form-group">
                                <label for="avatar" class="control-label grey">User Avatar</label>
                                <input type="file" name="avatar" id="avatar">
                            </div>
                        </div>
                    </div> -->

                    <div class="col-8">
                        <div class="form-group">
                            <div class="text-center" >
                                <button type="submit" class="btn btn-primary btn-block">
                                    Add User
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

    </div>
</div>
   
@endsection

@section('scripts')
    <script src="{{ asset('js/b/image-preview.js') }}"></script>
@endsection
