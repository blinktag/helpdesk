@extends('layouts.app')

@section('page_title', 'Create New Ticket')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Create New Ticket
                </div>
                <div class="card-body">
                    <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label" for="name">Department</label>
                            <select name="department_id" id="department_id" class="form-control{{ $errors->has('department_id') ? ' is-invalid' : '' }}">
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : ''}}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                            </select>
                            @if ($errors->has('department_id'))
                                <span class="invalid-feedback">
                                    <b>{{ $errors->first('department_id') }}</b>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="subject">Subject</label>
                            <input type="text" name="subject" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" value="{{ old('subject') }}" />

                            @if ($errors->has('subject'))
                                <span class="invalid-feedback">
                                    <b>{{ $errors->first('subject') }}</b>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="body">Body</label>
                            <textarea rows="15" name="body" id="body" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}">{{ old('body') }}</textarea>

                            @if ($errors->has('body'))
                                <span class="invalid-feedback">
                                    <b>{{ $errors->first('body') }}</b>
                                </span>
                            @endif
                        </div>
                        @include('ticket.partials._attachment_field')
                        <button type="submit" class="btn btn-primary">
                            Submit New Ticket
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
