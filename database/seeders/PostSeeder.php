<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostType;
use App\Models\Admin;

class PostSeeder extends Seeder
{
    public function run()
    {
        $postTypes = PostType::all();
        $admin = Admin::first();

        if ($postTypes->isEmpty() || !$admin) {
            $this->command->warn('Vui lòng chạy PostTypeSeeder và tạo Admin trước!');
            return;
        }

        $posts = [
            [
                'title' => '10 bước chăm sóc da buổi sáng đúng cách',
                'content' => '<p>Chăm sóc da buổi sáng là bước quan trọng để có làn da khỏe mạnh. Hãy cùng tìm hiểu 10 bước chăm sóc da buổi sáng đúng cách.</p><p>Bước 1: Rửa mặt với sữa rửa mặt phù hợp...</p>',
                'post_type_id' => $postTypes->where('name', 'Hướng dẫn')->first()?->id ?? $postTypes->random()->id,
                'admin_id' => $admin->id,
                'thumbnail' => 'posts/post-1.jpg',
            ],
            [
                'title' => 'Review kem dưỡng ẩm Laneige Water Bank',
                'content' => '<p>Kem dưỡng ẩm Laneige Water Bank là một trong những sản phẩm được yêu thích nhất hiện nay...</p>',
                'post_type_id' => $postTypes->where('name', 'Review')->first()?->id ?? $postTypes->random()->id,
                'admin_id' => $admin->id,
                'thumbnail' => 'posts/post-2.jpg',
            ],
            [
                'title' => 'Xu hướng làm đẹp 2024',
                'content' => '<p>Năm 2024 mang đến nhiều xu hướng làm đẹp mới, từ skincare đến makeup...</p>',
                'post_type_id' => $postTypes->where('name', 'Tin tức')->first()?->id ?? $postTypes->random()->id,
                'admin_id' => $admin->id,
                'thumbnail' => 'posts/post-3.jpg',
            ],
            [
                'title' => 'Khuyến mãi lớn - Giảm giá lên đến 50%',
                'content' => '<p>Chương trình khuyến mãi đặc biệt, giảm giá lên đến 50% cho tất cả sản phẩm...</p>',
                'post_type_id' => $postTypes->where('name', 'Khuyến mãi')->first()?->id ?? $postTypes->random()->id,
                'admin_id' => $admin->id,
                'thumbnail' => 'posts/post-4.jpg',
            ],
            [
                'title' => 'Cách chọn son môi phù hợp với màu da',
                'content' => '<p>Việc chọn son môi phù hợp với màu da sẽ giúp bạn trông rạng rỡ và tự tin hơn...</p>',
                'post_type_id' => $postTypes->where('name', 'Hướng dẫn')->first()?->id ?? $postTypes->random()->id,
                'admin_id' => $admin->id,
                'thumbnail' => 'posts/post-5.jpg',
            ],
        ];

        foreach ($posts as $postData) {
            Post::create($postData);
        }

        // Tạo thêm một số bài viết ngẫu nhiên
        for ($i = 0; $i < 10; $i++) {
            Post::create([
                'title' => 'Bài viết ' . ($i + 1),
                'content' => '<p>Nội dung bài viết ' . ($i + 1) . '...</p>',
                'post_type_id' => $postTypes->random()->id,
                'admin_id' => $admin->id,
                'thumbnail' => 'posts/post-' . ($i + 6) . '.jpg',
            ]);
        }
    }
}
