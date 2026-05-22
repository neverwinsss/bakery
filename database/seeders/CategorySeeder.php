<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Выпечка', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Десерты', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Хлеб',   'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
