@component('mail::message')
Witaj, {{ $name }}<br><br>

Twoja Rezerwacja została zaakceptowana!<br><br>

Miejsce: {{ $service_equipment['title'] }} <br>
Czas i data rozpoczęcia: {{ $entry }} <br>
Czas i data zakończenia: {{ $leave }} <br>

@component('mail::button', ['url' => url('/rezerwacja')])
Zobacz swoją rezerwację!
@endcomponent

Serdecznie Pozdrawiamy,<br>
{{ config('app.name') }}
@endcomponent
