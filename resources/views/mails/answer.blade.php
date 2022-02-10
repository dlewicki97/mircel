@component('mail::message')
Odpowiedź na mail o temacie: {{ $subject }} 
<br>
<br>
Treść wiadomości: 
<br>
{{ $answer_message }}


<br>
{{ config('app.name') }}
@endcomponent
