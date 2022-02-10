<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SnackbarAlertsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('snackbar_alerts')->insertOrIgnore(
            ['id' => '1', 'error' => 'Błąd serwera, przepraszamy...', 'delete_comment' => 'Pomyślnie usunięto komentarz!', 'add_comment' => 'Pomyślnie dodano komentarz!', 'mail_error' => 'Przepraszamy, nie udało się wysłać maila...', 'attachments_error' => 'Przepraszamy, nie udało się wysłać załączników...', 'recaptcha_error' => 'System twierdzi, że jesteś robotem...', 'login_require' => 'Musisz się zalogować!', 'reservation_to_accept' => 'Twoja rezerwacja czeka na akceptację!', 'add_to_cart' => 'Pomyślnie dodano do koszyka!', 'shop_items_error' => 'Nie udało się załadować wariantów...', 'photo_error' => 'Przepraszamy, nie udało się dodać zdjęcia...', 'edit_account_success' => 'Pomyślnie edytowano użytkownika!', 'delete_from_cart_question' => 'Czy na pewno usunąć z koszyka przedmiot:', 'order_success' => 'Pomyślnie złożono zamówienie!', 'login_success' => 'Pomyślnie zalogowano!', 'register_success' => 'Pomyślnie zarejestrowano! Wysłano link aktywacyjny!', 'created_at' => NULL, 'updated_at' => '2021-03-27 16:53:43', 'validate' => 'Niepoprawne dane!', 'non_activated_account' => 'Proszę aktywować konto!', 'blocked_user' => 'Przepraszamy, Twoje konto zostało zablokowane!', 'user_exist' => 'Taki użytkownik już istnieje!', 'mail_success' => 'Pomyślnie wysłano wiadomość!', 'title' => 'Komunikaty', 'activated_account_success' => 'Pomyślnie aktywowano konto!', 'user_does_not_exist' => 'Użytkownik nie istnieje!', 'password_reminder_success' => 'Pomyślnie wysłano nowe hasło!', 'password_error' => 'Hasło nieprawidłowe!', 'change_password_success' => 'Pomyślnie zmieniono hasło!', 'lucky_number' => 'Wylosowano szczęśliwca o identyfikatorze {id}']
        );
    }
}
