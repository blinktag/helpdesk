@extends('layouts.admin')

@section('page_title', 'Editing E-Mail Pipe')

@section('content')
<div class="card">
    <div class="card-header">
        Edit {{ $pipe->username }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.pipes.update', $pipe->id) }}" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            @include('partials._input', [
                'key' => 'server',
                'value' => $pipe->server,
                'label' => 'IMAP Server'
            ])

            @include('partials._input', [
                'key' => 'username',
                'value' => $pipe->username,
                'label' => 'E-Mail Address'
            ])

            @include('partials._input', [
                'key' => 'password',
                'value' => decrypt($pipe->password),
                'label' => 'IMAP Password'
            ])

            @include('partials._select', [
                'key' => 'department_id',
                'value' => $pipe->department_id,
                'options' => $departments,
                'label' => 'Create Tickets in Department'
            ])

            <button type="submit" class="btn btn-primary">
                Create
            </button>
        </form>
    </div>
</div>
@endsection
