@extends('layouts.admin')

@section('page_title', 'Editing Department')

@section('content')
<div class="card">
    <div class="card-header">
        Editing {{ $department->name }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.departments.update', $department->id) }}" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            @include('partials._input', [
                'key' => 'name',
                'value' => $department->name,
                'label' => 'Department Name'
            ])

            <button type="submit" class="btn btn-primary">
                Create
            </button>
        </form>
    </div>
</div>
@endsection
