@extends('layouts.admin')

@section('page_title', "{$department->name } - $status")

@section('content')
<div class="row">
    <div class="col-sm-3">
        <department-tree></department-tree>
    </div>
    <div class="col-sm-9">

<div class="card">
    <div class="card-header">
        <i class="fa fa-search fa-fw"></i>
        Tickets
    </div>
    <div class="card-body">
        <table class="table table-striped table-small mb0">
            <thead>
                <tr>
                    <th width="1%">Id</th>
                    <th>Subject</th>
                    <th width="15%">Last Update</th>
                    <th width="25%">Last Replier</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>
                        <a href="{{ route('ticket.show', $ticket->id) }}">
                            {{ $ticket->id }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('ticket.show', $ticket->id) }}">
                            {{ $ticket->subject }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('ticket.show', $ticket->id) }}">
                            {{ $ticket->last_reply->diffForHumans() }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('ticket.show', $ticket->id) }}">
                            {{ $ticket->last_replier }}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $tickets->links() }}
    </div>
</div>

    </div>
</div>
@endsection
