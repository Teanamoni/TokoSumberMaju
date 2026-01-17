<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdministratorSeeder;
use Database\Seeders\AboutSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdministratorSeeder::class,
            AboutSeeder::class,
        ]);
    }
}
