<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::create([
            'title' => 'Советы по хранению выпечки',
            'content' => 'Не упаковывайте горячую выпечку сразу: дайте ей остыть. Хлеб храните в бумажном пакете или хлебнице, а десерты с кремом — в холодильнике.',
            'image' => null,
        ]);
    }
}
