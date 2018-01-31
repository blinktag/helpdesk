@component('mail::message')
# Hello {{ $ticket->user->name }},

Your ticket **{{ $ticket->subject }}** has been created and a technician will respond shortly

@component('mail::button', ['url' => route('ticket.show', $ticket->id)])
View Ticket
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
