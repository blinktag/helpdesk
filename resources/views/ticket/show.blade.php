@extends('layouts.app')

@section('page_title', $ticket->subject)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ticket {{ $ticket->id }} - {{ $ticket->subject }}
                </div>
                <div class="panel-body">
                    
                </div>
            </div>
        </div>
    </div>
@endsection
