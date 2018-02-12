@extends('layouts.admin')

@section('page_title', "Ticket {$ticket->id} - {$ticket->subject}")

@section('content')

    <nav class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-ticket-tab" data-toggle="tab" href="#nav-ticket" role="tab" aria-controls="home" aria-expanded="true">Ticket</a>
        <a class="nav-item nav-link" id="nav-notes-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="profile" aria-expanded="false">Notes</a>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade active show" id="nav-ticket" role="tabpanel" aria-labelledby="nav-ticket-tab" aria-expanded="true">
            <responses ticketid="{{ $ticket->id }}"></responses>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-notes-tab" aria-expanded="false">
            <notes id="{{ $ticket->id }}" product="ticket"></notes>
        </div>
    </div>
    <br />
    @include('admin.ticket.partials._reply')
@endsection
