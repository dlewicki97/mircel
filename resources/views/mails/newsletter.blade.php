@component('mail::message')
Tytuł: {{ $subject }}
<br>
Wiadomość:<br> {{ $message }}



{{ config('app.name') }}
@endcomponent
