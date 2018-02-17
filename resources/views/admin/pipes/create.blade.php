@extends('layouts.admin')

@section('page_title', 'Create New E-Mail Pipe')

@section('content')
<div class="card">
    <div class="card-header">
        New Pipe
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.pipes.store') }}" class="form-horizontal">
            {{ csrf_field() }}

            @include('partials._input', [
                'key' => 'server',
                'value' => '',
                'label' => 'IMAP Server'
            ])

            @include('partials._input', [
                'key' => 'username',
                'value' => '',
                'label' => 'E-Mail Address'
            ])

            @include('partials._input', [
                'key' => 'password',
                'value' => '',
                'label' => 'IMAP Password'
            ])

            @include('partials._select', [
                'key' => 'department_id',
                'value' => 1,
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
