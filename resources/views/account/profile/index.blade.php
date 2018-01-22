@extends('account.layouts.default')

@section('account.content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('account.profile.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="control-label" for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" />

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <b>{{ $errors->first('name') }}</b>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label" for="email">E-Mail</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" />

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <b>{{ $errors->first('email') }}</b>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">
                    Update Profile
                </button>
            </form>
        </div>
    </div>
@endsection
