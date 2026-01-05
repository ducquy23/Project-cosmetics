<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->warn('Vui lòng chạy ProductSeeder trước!');
            return;
        }

        foreach ($products as $product) {
            // Tạo 2-4 ảnh cho mỗi sản phẩm
            $imageCount = rand(2, 4);
            
            for ($i = 0; $i < $imageCount; $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'products/product-' . $product->id . '-' . ($i + 1) . '.jpg',
                ]);
            }
        }
    }
}
