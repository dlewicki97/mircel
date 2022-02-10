@component('mail::message')
Dziękujemy za założenie konta

Kliknij w link, aby aktywować swoje konto. 

@component('mail::button', ['url' => url("/auth/confirm_account/$user->id")])
Aktywuj konto
@endcomponent

{{ config('app.name') }}
@endcomponent
