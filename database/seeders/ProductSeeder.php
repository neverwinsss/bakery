<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'name');

        Product::insert([
            ['name' => 'Сэндвич с курицей', 'info' => 'Копченая куриная грудка, сыр моцарелла, помидоры, салат и чесночный соус.', 'image' => 'image/1.png', 'category_id' => $categories['Выпечка'], 'price' => 499, 'weight' => '200 г', 'is_available' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Круассан сливочный', 'info' => 'Воздушный круассан на натуральном сливочном масле.', 'image' => null, 'category_id' => $categories['Выпечка'], 'price' => 190, 'weight' => '90 г', 'is_available' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Бородинский хлеб', 'info' => 'Ржаной хлеб с кориандром и плотной ароматной корочкой.', 'image' => null, 'category_id' => $categories['Хлеб'], 'price' => 120, 'weight' => '450 г', 'is_available' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Чизкейк ванильный', 'info' => 'Нежный десерт с творожно-сливочной начинкой.', 'image' => null, 'category_id' => $categories['Десерты'], 'price' => 260, 'weight' => '130 г', 'is_available' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
