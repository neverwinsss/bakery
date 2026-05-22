<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contacts')->insert([
            ['name' => 'Адрес',   'info' => 'ул. Пекарская, д. 1, Москва', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Телефон', 'info' => '+7 (999) 123-45-67',           'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Email',   'info' => 'hello@bakery-dom.ru',           'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Режим работы', 'info' => 'Пн-Вс: 07:00 — 21:00',  'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
