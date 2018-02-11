@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fa fa-search fa-fw"></i>
        Search Results
    </div>
    <div class="card-body">
        <table class="table table-striped table-small mb0">
            <thead>
                <tr>
                    <th width="1%">Id</th>
                    <th>Subject</th>
                    <th width="15%">Last Update</th>
                    <th width="15%">Last Replier</th>
                    <th width="10%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($response_results as $response)
                <tr>
                    <td>
                        <a href="{{ route('admin.ticket.show', $response->ticket_id) }}">
                            {{ $response->ticket_id }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.ticket.show', $response->ticket_id) }}">
                            {{ $response->ticket->subject }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.ticket.show', $response->ticket_id) }}">
                            {{ $response->ticket->last_reply->diffForHumans() }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.ticket.show', $response->ticket_id) }}">
                            {{ $response->ticket->last_replier }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.ticket.show', $response->ticket_id) }}">
                            @include('ticket.partials._status', ['status' => $response->ticket->status])
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $response_results->links() }}
    </div>
</div>
@endsection
