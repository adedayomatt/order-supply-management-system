
@extends('layouts.app')

@section('main')
<div class="row justify-content-center">
    <div class="col-md-4 col-sm-6">
            <form method="POST" action="{{ route('user.password.update',[$user->id]) }}" class="has-image-upload" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                        <div class="content-box">
                            <h5 class="text-center">Update password</h5>
                            
                            <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                <label for="old_password" class="control-label">Old password</label>
                                <div class="">
                                    <input id="old_password" type="password" class="form-control" name="old_password" placeholder="old password" required>

                                    @if ($errors->has('old_password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">New password</label>
                                <div class="">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="new password" required>

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
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirm new password" required>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="text-center" >
                                <button type="submit" class="btn btn-primary btn-block">
                                    Update password
                                </button>
                            </div>
                        </div>
            </form>

    </div>
</div>
   
@endsection

@section('scripts')
    <script src="{{ asset('js/b/image-preview.js') }}"></script>
@endsection
