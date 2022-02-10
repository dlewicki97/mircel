<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact')->insertOrIgnore([
            'id' => 1,
            'email_1' => "",
            'email_2' => "",
            'phone_1' => "",
            'phone_2' => "",
            'zip_code' => "",
            'city' => "",
            'address' => "",
            'name' => "",
            'title' => "",
            'fb' => "",
            'ig' => "",
            'yt' => "",
            'tw' => "",
            'map' => "",
        ]);
    }
}
