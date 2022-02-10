<?php

use Illuminate\Database\Seeder;

class ValidationRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('validation_rules')->insertOrIgnore(
            ['id' => '1', 'title' => 'Opisy', 'required' => 'To pole jest wymagane!', 'email' => 'Niepoprawny e-mail.', 'password_length' => 'Hasło musi mieć co najmniej 8 liter!', 'file_size' => 'Pliki powinny ważyć mniej niż 5 MB!', 'password_confirm' => 'Hasła muszą być takie same!', 'reservation_min_time' => 'Minimalny czas rezerwacji to 30 minut!', 'reservation_exist' => 'Taka rezerwacja już istnieje!']
        );
    }
}
