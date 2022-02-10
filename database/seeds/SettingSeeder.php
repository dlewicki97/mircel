<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insertOrIgnore([
            'id' => 1,
            'rodo_1' => "„Wyrażam zgodę na przetwarzanie danych osobowych podanych w formularzu. Podanie danych jest dobrowolne. Administratorem podanych przez Pana/ Panią danych osobowych jest {NAZWA_FIRMY} z siedzibą o adresie {ADRES_FIRMY}. Pana/Pani dane będą przetwarzane w celach związanych z udzieleniem odpowiedzi, przedstawieniem oferty usług {NAZWA_FIRMY} oraz świadczeniem usług przez administratora danych. Przysługuje Panu/Pani prawo dostępu do treści swoich danych oraz ich poprawiania.”",
            'rodo_2' => "„Wyrażam zgodę na otrzymywanie informacji handlowych od {NAZWA_FIRMY} dotyczących jej oferty w szczególności poprzez połączenia telefoniczne lub sms z wykorzystaniem numeru telefonu podanego w formularzu, a także zgodę na przetwarzanie moich danych osobowych w tym celu przez {NAZWA_FIRMY} oraz w celach promocji, reklamy i badania rynku.”",
            'privace_policy' => "",
            'photo' => "",
            'photo_alt' => "",
            'description' => "",
            'cookies' => "Ta strona używa plików cookie w celach statystycznych oraz marketingowych. Możesz zablokować zapisywanie plików cookie na swoim dysku twardym zmieniając ustawienia swojej przeglądarki internetowej. Kontynuując korzystanie z tej strony bez zablokowania plików cookie zgadzasz się na ich zapisywanie na swoim dysku twardym. Dowiedz się więcej w naszej",
            'cookies_button' => "OK",
            'cookies_privace_button' => "Polityce Prywatności.",
            'company' => "",
            'title' => "Ustawienia",
        ]);
    }
}
