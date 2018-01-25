@component('mail::message')
Please confirm your email.

@component('mail::button', ['url' => ''])
Confirm E-Mail
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
