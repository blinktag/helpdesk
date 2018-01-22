@extends('account.layouts.default')

@section('account.content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('account.password.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('password_current') ? ' has-error' : '' }}">
                    <label class="control-label" for="name">Current Password</label>
                    <input type="password" name="password_current" class="form-control" value="{{ old('password_current') }}" />

                    @if ($errors->has('password_current'))
                        <span class="help-block">
                            <b>{{ $errors->first('password_current') }}</b>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label" for="password">New Password</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}" />

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <b>{{ $errors->first('password') }}</b>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label class="control-label" for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" />

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
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
