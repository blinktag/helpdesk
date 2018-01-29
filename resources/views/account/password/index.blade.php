@extends('account.layouts.default')
@section('page_title', 'Change Password')
@section('account.content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('account.password.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label" for="name">Current Password</label>
                    <input type="password" name="password_current" class="form-control{{ $errors->has('password_current') ? ' is-invalid' : '' }}" value="{{ old('password_current') }}" />

                    @if ($errors->has('password_current'))
                        <span class="invalid-feedback">
                            <b>{{ $errors->first('password_current') }}</b>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="control-label" for="password">New Password</label>
                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" />

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <b>{{ $errors->first('password') }}</b>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="control-label" for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" value="{{ old('password_confirmation') }}" />

                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback">
                            <b>{{ $errors->first('password_confirmation') }}</b>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">
                    Update Password
                </button>
            </form>
        </div>
    </div>
@endsection
