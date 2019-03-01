
@extends('layouts.app')

@section('main')

<div class="row justify-content-center">
    <div class="col-md-8">
        
        
            <form method="POST" action="{{ route('user.update',$user->id) }}" class="has-image-upload" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="content-box">
                        <div class="p-3">
                            Update User: <strong>{{$user->fullname()}}</strong>
                        </div>
                            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label for="firstname" class="control-label">First Name</label>

                                <div class="">
                                    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" placeholder="user's first name" required autofocus>

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
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->lastname }}" placeholder="user's last name" required autofocus>

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
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="user's email address" required autofocus>

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
                                    <input id="phone" type="phone" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="user's phone number" required autofocus>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                                <label for="position" class="control-label">Position</label>

                                <div class="">
                                    <select name="position" id="position" class="form-control" required>
                                        <option value="1" {{$user->position == 1 ? 'selected' : ''}}>Customer Service</option>
                                        <option value="2" {{$user->position == 2 ? 'selected' : ''}}>Marketer</option>
                                        <option value="3" {{$user->position == 3 ? 'selected' : ''}}>Manager</option>
                                        <option value="4" {{$user->position == 4 ? 'selected' : ''}}>Managing Director</option>
                                    </select>
                                    @if ($errors->has('position'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('position') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- <div class="col-sm-4">
                        <div class="content-box">
                            <div class="text-center">
                                    <img id="user-avatar-preview" src="{{$user->avatar()['src']}}" alt="{{$user->avatar()['alt']}}" width="100%"> 
                            </div>
                            <div class="image-preview-container text-center" replace="#user-avatar-preview"></div>
                            <div class="form-group">
                                <label for="avatar" class="control-label grey">User Avatar</label>
                                <input type="file" name="avatar" id="avatar">
                            </div>
                        </div>
                    </div>
                     -->

                    <div class="col-8">
                        <div class="form-group">
                            <div class="text-center" >
                                <button type="submit" class="btn btn-primary btn-block">
                                    Update {{$user->firstname}}
                                </button>
                            </div>
                        </div>
                    </div>
            </form>

        </div>
    </div>
</div>
   
@endsection

@section('scripts')
    <script src="{{ asset('js/b/image-preview.js') }}"></script>
@endsection
