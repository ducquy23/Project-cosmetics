<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostType;

class PostTypeSeeder extends Seeder
{
    public function run()
    {
        $postTypes = [
            ['name' => 'Tin tức'],
            ['name' => 'Hướng dẫn'],
            ['name' => 'Review'],
            ['name' => 'Khuyến mãi'],
        ];

        foreach ($postTypes as $postType) {
            PostType::create($postType);
        }
    }
}
