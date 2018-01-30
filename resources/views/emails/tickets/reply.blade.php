@component('mail::message')
# Hello {{ $ticket->user->name }},

Your ticket {{ $ticket->id }} has been updated

@component('mail::button', ['url' => route('ticket.show', $ticket->id)])
View Ticket
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
