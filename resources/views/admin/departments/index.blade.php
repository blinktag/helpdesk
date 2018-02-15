@extends('layouts.admin')

@section('page_title', 'Configure Departments')

@section('content')

<div class="card">
    <div class="card-header">
        <i class="fa fa-list"></i>
        Departments

        <a href="{{ route('admin.departments.create') }}" class="btn btn-primary btn-xs pull-right">
            New Department
        </a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-compact mb0">
            <tbody>
                @foreach($departments as $department)
                <tr>
                    <td width="1%">
                        <a href="{{ route('admin.departments.edit', $department->id) }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-pencil"></i>
                            Edit
                        </a>
                    </td>
                    <td>
                        {{ $department->name }}
                    </td>
                    <td width="1%">
                        <form method="POST" action="{{ route('admin.departments.destroy', $department->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-sm btn-danger">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
