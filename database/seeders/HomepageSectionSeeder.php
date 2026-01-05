<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomepageSection;
use App\Models\Product;

class HomepageSectionSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();

        // Policy blocks
        $policies = [
            [
                'type' => 'policy',
                'title' => 'Miễn phí vận chuyển từ 499,000đ',
                'description' => 'Áp dụng cho đơn hàng từ 499,000đ trở lên',
                'image' => '/assets/frontend/img/home/home1-policy.png',
                'link' => null,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'type' => 'policy',
                'title' => 'Cam kết hàng chính hãng',
                'description' => '100% sản phẩm chính hãng, có tem chống hàng giả',
                'image' => '/assets/frontend/img/home/home1-policy2.png',
                'link' => null,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'type' => 'policy',
                'title' => 'Đảm bảo hoàn tiền',
                'description' => 'Hoàn tiền 100% nếu sản phẩm không đúng như mô tả',
                'image' => '/assets/frontend/img/home/home1-policy3.png',
                'link' => null,
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($policies as $policy) {
            HomepageSection::create($policy);
        }

        // Banner sections
        $banners = [
            [
                'type' => 'banner',
                'title' => 'Banner 1',
                'image' => '/assets/frontend/img/home/effect1.jpg',
                'link' => '/shop',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'type' => 'banner',
                'title' => 'Banner 2',
                'image' => '/assets/frontend/img/home/effect2.jpg',
                'link' => '/shop',
                'is_active' => true,
                'order' => 2,
            ],
        ];

        foreach ($banners as $banner) {
            HomepageSection::create($banner);
        }

        // Best selling products (nếu có products)
        if ($products->isNotEmpty()) {
            $bestSelling = $products->take(5);
            foreach ($bestSelling as $index => $product) {
                HomepageSection::create([
                    'type' => 'best_selling',
                    'product_id' => $product->id,
                    'is_active' => true,
                    'order' => $index + 1,
                ]);
            }
        }

        // Discounted products
        if ($products->isNotEmpty()) {
            $discounted = $products->where('discount', '>', 0)->take(5);
            foreach ($discounted as $index => $product) {
                HomepageSection::create([
                    'type' => 'discounted',
                    'product_id' => $product->id,
                    'is_active' => true,
                    'order' => $index + 1,
                ]);
            }
        }
    }
}
