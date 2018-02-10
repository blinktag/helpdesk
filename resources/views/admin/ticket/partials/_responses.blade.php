<div class="col-md-12">
    @foreach($ticket->responses as $response)
        @include('ticket.partials._response')
    @endforeach
</div>
