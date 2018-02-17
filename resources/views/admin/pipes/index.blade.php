@extends('layouts.admin')

@section('page_title', 'Configure E-Mail Pipes')

@section('content')

<div class="card">
    <div class="card-header">
        <i class="fa fa-list"></i>
        Pipes

        <a href="{{ route('admin.pipes.create') }}" class="btn btn-primary btn-xs pull-right">
            New Pipe
        </a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-compact mb0">
            <tbody>
                @forelse($pipes as $pipe)
                <tr>
                    <td width="1%">
                        <a href="{{ route('admin.pipes.edit', $pipe->id) }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-pencil"></i>
                            Edit
                        </a>
                    </td>
                    <td>
                        {{ $pipe->email }}
                    </td>
                    <td>
                        {{ $pipe->server }}
                    </td>
                    <td>
                        {{ $pipe->department->name }}
                    </td>
                    <td width="1%">
                        <form method="POST" action="{{ route('admin.pipes.destroy', $pipe->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-sm btn-danger">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">
                        <div class="alert alert-warning">
                            No E-Mail pipes have been created yet
                        </div>
                    </td>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
