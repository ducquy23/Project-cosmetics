<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Origin;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::where('parent_id', '>', 0)->get();
        $brands = Brand::all();
        $origins = Origin::all();

        if ($categories->isEmpty() || $brands->isEmpty() || $origins->isEmpty()) {
            $this->command->warn('Vui lòng chạy CategorySeeder, BrandSeeder và OriginSeeder trước!');
            return;
        }

        $products = [
            [
                'name' => 'Kem dưỡng ẩm Laneige Water Bank',
                'product_code' => 'SP001',
                'price' => 450000,
                'discount' => 15,
                'quantity' => 50,
                'description' => 'Kem dưỡng ẩm chứa thành phần nước khoáng từ núi lửa, cung cấp độ ẩm sâu cho da, giúp da mềm mịn và căng bóng suốt cả ngày.',
                'category_id' => $categories->where('slug', 'kem-duong-am')->first()?->id ?? $categories->random()->id,
                'brand_id' => $brands->where('name', 'Laneige')->first()?->id ?? $brands->random()->id,
                'origin_id' => $origins->where('name', 'Hàn Quốc')->first()?->id ?? $origins->random()->id,
                'sold' => 120,
            ],
            [
                'name' => 'Serum The Ordinary Niacinamide 10%',
                'product_code' => 'SP002',
                'price' => 320000,
                'discount' => 10,
                'quantity' => 75,
                'description' => 'Serum chứa 10% Niacinamide giúp kiểm soát dầu, thu nhỏ lỗ chân lông và làm đều màu da.',
                'category_id' => $categories->where('slug', 'serum')->first()?->id ?? $categories->random()->id,
                'brand_id' => $brands->where('name', 'The Ordinary')->first()?->id ?? $brands->random()->id,
                'origin_id' => $origins->where('name', 'Mỹ')->first()?->id ?? $origins->random()->id,
                'sold' => 89,
            ],
            [
                'name' => 'Son môi MAC Ruby Woo',
                'product_code' => 'SP003',
                'price' => 680000,
                'discount' => 0,
                'quantity' => 30,
                'description' => 'Son môi matte màu đỏ cổ điển, lâu trôi, không khô môi.',
                'category_id' => $categories->where('slug', 'son-moi')->first()?->id ?? $categories->random()->id,
                'brand_id' => $brands->where('name', 'MAC')->first()?->id ?? $brands->random()->id,
                'origin_id' => $origins->where('name', 'Mỹ')->first()?->id ?? $origins->random()->id,
                'sold' => 156,
            ],
            [
                'name' => 'Kem chống nắng Innisfree Perfect UV Protection',
                'product_code' => 'SP004',
                'price' => 280000,
                'discount' => 20,
                'quantity' => 100,
                'description' => 'Kem chống nắng SPF50+ PA+++, không gây bóng nhờn, phù hợp cho da dầu.',
                'category_id' => $categories->where('slug', 'kem-chong-nang')->first()?->id ?? $categories->random()->id,
                'brand_id' => $brands->where('name', 'Innisfree')->first()?->id ?? $brands->random()->id,
                'origin_id' => $origins->where('name', 'Hàn Quốc')->first()?->id ?? $origins->random()->id,
                'sold' => 203,
            ],
            [
                'name' => 'Sữa rửa mặt CeraVe Foaming Facial Cleanser',
                'product_code' => 'SP005',
                'price' => 350000,
                'discount' => 12,
                'quantity' => 80,
                'description' => 'Sữa rửa mặt dạng bọt, làm sạch sâu, không làm khô da, phù hợp cho da dầu và da hỗn hợp.',
                'category_id' => $categories->where('slug', 'sua-rua-mat')->first()?->id ?? $categories->random()->id,
                'brand_id' => $brands->where('name', 'CeraVe')->first()?->id ?? $brands->random()->id,
                'origin_id' => $origins->where('name', 'Mỹ')->first()?->id ?? $origins->random()->id,
                'sold' => 178,
            ],
            [
                'name' => 'Kem nền Maybelline Fit Me',
                'product_code' => 'SP006',
                'price' => 220000,
                'discount' => 25,
                'quantity' => 60,
                'description' => 'Kem nền matte, che phủ tự nhiên, lâu trôi, có nhiều tone màu.',
                'category_id' => $categories->where('slug', 'kem-nen')->first()?->id ?? $categories->random()->id,
                'brand_id' => $brands->where('name', 'Maybelline')->first()?->id ?? $brands->random()->id,
                'origin_id' => $origins->where('name', 'Mỹ')->first()?->id ?? $origins->random()->id,
                'sold' => 245,
            ],
            [
                'name' => 'Mặt nạ đất sét Innisfree Super Volcanic Pore Clay Mask',
                'product_code' => 'SP007',
                'price' => 380000,
                'discount' => 15,
                'quantity' => 45,
                'description' => 'Mặt nạ đất sét núi lửa, làm sạch sâu lỗ chân lông, kiểm soát dầu.',
                'category_id' => $categories->where('slug', 'mat-na')->first()?->id ?? $categories->random()->id,
                'brand_id' => $brands->where('name', 'Innisfree')->first()?->id ?? $brands->random()->id,
                'origin_id' => $origins->where('name', 'Hàn Quốc')->first()?->id ?? $origins->random()->id,
                'sold' => 134,
            ],
            [
                'name' => 'Dầu gội Dove Dưỡng ẩm sâu',
                'product_code' => 'SP008',
                'price' => 95000,
                'discount' => 0,
                'quantity' => 120,
                'description' => 'Dầu gội dưỡng ẩm, phục hồi tóc hư tổn, mềm mượt tự nhiên.',
                'category_id' => $categories->where('slug', 'dau-goi')->first()?->id ?? $categories->random()->id,
                'brand_id' => $brands->where('name', 'Dove')->first()?->id ?? $brands->random()->id,
                'origin_id' => $origins->where('name', 'Mỹ')->first()?->id ?? $origins->random()->id,
                'sold' => 312,
            ],
            [
                'name' => 'Nước hoa L\'Oreal Paris Scent',
                'product_code' => 'SP009',
                'price' => 850000,
                'discount' => 30,
                'quantity' => 25,
                'description' => 'Nước hoa nữ tính, hương thơm quyến rũ, lưu hương lâu.',
                'category_id' => $categories->where('slug', 'nuoc-hoa-nu')->first()?->id ?? $categories->random()->id,
                'brand_id' => $brands->where('name', 'L\'Oreal')->first()?->id ?? $brands->random()->id,
                'origin_id' => $origins->where('name', 'Pháp')->first()?->id ?? $origins->random()->id,
                'sold' => 67,
            ],
            [
                'name' => 'Kem dưỡng thể Nivea Soft',
                'product_code' => 'SP010',
                'price' => 150000,
                'discount' => 18,
                'quantity' => 90,
                'description' => 'Kem dưỡng thể mềm mịn, thấm nhanh, không nhờn rít.',
                'category_id' => $categories->where('slug', 'kem-duong-the')->first()?->id ?? $categories->random()->id,
                'brand_id' => $brands->where('name', 'Nivea')->first()?->id ?? $brands->random()->id,
                'origin_id' => $origins->where('name', 'Đức')->first()?->id ?? $origins->random()->id,
                'sold' => 189,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        // Tạo thêm một số sản phẩm ngẫu nhiên
        for ($i = 0; $i < 20; $i++) {
            Product::create([
                'name' => 'Sản phẩm ' . ($i + 1),
                'product_code' => 'SP' . str_pad(11 + $i, 3, '0', STR_PAD_LEFT),
                'price' => rand(100000, 1000000),
                'discount' => rand(0, 30),
                'quantity' => rand(20, 200),
                'description' => 'Mô tả sản phẩm ' . ($i + 1) . '. Đây là sản phẩm chất lượng cao, được nhiều khách hàng tin dùng.',
                'category_id' => $categories->random()->id,
                'brand_id' => $brands->random()->id,
                'origin_id' => $origins->random()->id,
                'sold' => rand(0, 500),
            ]);
        }
    }
}
