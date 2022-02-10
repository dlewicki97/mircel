@component('mail::message')

Nowa rezerwacja w systemie!<br><br>

Imię i nazwisko: {{ $name }} <br>
Telefon: {{ $phone }} <br>
Adres E-mail: {{ $email }} <br><br>
Miejsce: {{ $service_equipment['title'] }} <br>
Czas i data rozpoczęcia: {{ $entry }} <br>
Czas i data zakończenia: {{ $leave }} <br>

@component('mail::button', ['url' => url('/admin-panel/reservations')])
Zaakceptuj rezerwację!
@endcomponent


{{ config('app.name') }}
@endcomponent
