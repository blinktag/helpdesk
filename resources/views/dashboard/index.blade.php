@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Open Tickets

            <a href="{{ route('ticket.create') }}" class="btn btn-primary btn-xs pull-right">Open New Ticket</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-sm mb0">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="50%">Subject</th>
                        <th>Last Replier</th>
                        <th class="text-right">Last Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                    <tr>
                        <td>
                            <a href="{{ route('ticket.show', $ticket->id) }} ">
                                {{ $ticket->id }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('ticket.show', $ticket->id) }} ">
                                {{ $ticket->subject }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('ticket.show', $ticket->id) }} ">
                                {{ $ticket->last_replier }}
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('ticket.show', $ticket->id) }} ">
                                {{ $ticket->last_reply->diffForHumans() }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>
@endsection
