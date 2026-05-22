<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ContactSeeder::class,
            ProductSeeder::class,
            PostSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
