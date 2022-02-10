@component('mail::message')

Twoje hasło to {{ $token }}<br><br>



@component('mail::button', ['url' => url('/')])
Zaloguj się!
@endcomponent

Serdecznie Pozdrawiamy,<br>
{{ config('app.name') }}
@endcomponent
