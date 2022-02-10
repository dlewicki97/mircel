<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call($this->getSeedersClasses());
    }

    private function getSeedersClasses()
    {
        return array_map(function ($class) {
            return str_replace('.php', '', $class);
        }, array_diff(scandir(__DIR__), array('..', '.', 'DatabaseSeeder.php')));
    }
}
