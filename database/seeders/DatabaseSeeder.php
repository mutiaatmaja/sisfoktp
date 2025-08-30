<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seeder user pertama
        \App\Models\User::firstOrCreate([
            'email' => 'keiser.form@gmail.com'
        ], [
            'name' => 'Mutia Atmaja',
            'password' => bcrypt('1234567890'),
        ]);

        $this->call([
            KelasSeeder::class,
            JurusanSeeder::class,
            MuridSeeder::class,
        ]);
    }
}
