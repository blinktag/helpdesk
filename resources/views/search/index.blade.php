@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fa fa-search fa-fw"></i>
        Search Results
    </div>
    <div class="card-body">
        <table class="table table-striped mb0">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Subject</th>
                    <th>Last Update</th>
                    <th>Last Replier</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($response_results as $response)
                <tr>
                    <td>{{ $response->id }}</td>
                    <td>{{ $response->ticket->subject }}</td>
                    <td>{{ $response->ticket->last_reply->diffForHumans() }}</td>
                    <td>{{ $response->ticket->last_replier }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
