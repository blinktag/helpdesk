@extends('layouts.admin')

@section('page_title', 'Create New Department')

@section('content')


<div class="card">
    <div class="card-header">
        New Department
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.departments.store') }}" class="form-horizontal">
            {{ csrf_field() }}

            @include('partials._input', [
                'key' => 'name',
                'value' => '',
                'label' => 'Department Name'
            ])

            <button type="submit" class="btn btn-primary">
                Create
            </button>
        </form>
    </div>
</div>
@endsection
