@component('mail::message')
    Imię i nazwisko: {{ $name }}
    <br>
    Adres e-mail: {{ $email }}
    <br>
    Zgoda na przetwarzanie danych: {{ $rodo1 }}
    <br>
    Zgoda na kontakt telefoniczny lub email: {{ $rodo2 }}
    <br>
    <br>
    Temat maila: {{ $subject }}
    <br>
    Treść wiadomości:
    <br>
    {{ $message }}


    {{ config('app.name') }}
@endcomponent
