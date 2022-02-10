<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insertOrIgnore(
            ['id' => '1', 'name' => 'Moderator', 'email' => 'dany97971@gmail.com', 'email_verified_at' => '2020-09-27 10:46:39', 'password' => '$2y$10$6XXh0PLYfKnPpNlUzciOOe7vdnObdN7xGcF8Opc4UqE9h23ndkZO.', 'type' => 'Moderator', 'remember_token' => 'EfTdygXp8YPcbmUqfAtt3tZ9NCbCaVoqGgst8CLhc7xpPY8TVBH4II79jqNb', 'photo' => '', 'active' => '1', 'blocked' => '0']
        );
    }
}
