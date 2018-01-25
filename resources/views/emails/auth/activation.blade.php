@component('mail::message')
Please confirm your email.

@component('mail::button', ['url' => route('activation.activate', $token)])
Confirm E-Mail
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
