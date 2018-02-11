@extends('layouts.admin')

@section('page_title', 'Users')

@section('content')

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>E-Mail</th>
            <th>Is Active</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>
                <a href="{{ route('admin.users.show', $user->id) }}">
                    {{ $user->name }}
                </a>
            </td>
            <td>
                <a href="{{ route('admin.users.show', $user->id) }}">
                    {{ $user->email }}
                </a>
            </td>
            <td>
                <a href="{{ route('admin.users.show', $user->id) }}">
                    @if($user->activated)
                        <span class="badge badge-success">Yes</span>
                    @else
                        <span class="badge badge-danger">No</span>
                    @endif
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$users->render("pagination::bootstrap-4")}}
@endsection
