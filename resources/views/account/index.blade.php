@extends('account.layouts.default')

@section('account.content')

<table class="table">
    <tbody>
        <tr>
            <td width="33%">Name</td>
            <td>{{ auth()->user()->name }}</td>
        </tr>
        <tr>
            <td width="33%">Primary E-Mail</td>
            <td>{{ auth()->user()->email }}</td>
        </tr>
    </tbody>
</table>

@endsection
