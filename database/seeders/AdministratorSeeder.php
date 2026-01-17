<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;  // Adjust to App\Models\User if using Laravel 8+
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new User;
        $administrator->name = "Administrator";
        $administrator->email = "sumbermaju@gmail.com";
        $administrator->password = Hash::make("password");
        $administrator->save();
        $this->command->info("User Admin berhasil diinsert");
    }
}