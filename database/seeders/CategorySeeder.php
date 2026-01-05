<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Danh mục chính (parent_id = 0 cho category chính)
        $skincare = Category::create([
            'name' => 'Chăm sóc da',
            'slug' => 'cham-soc-da',
            'parent_id' => 0,
        ]);

        $makeup = Category::create([
            'name' => 'Trang điểm',
            'slug' => 'trang-diem',
            'parent_id' => 0,
        ]);

        $haircare = Category::create([
            'name' => 'Chăm sóc tóc',
            'slug' => 'cham-soc-toc',
            'parent_id' => 0,
        ]);

        $bodycare = Category::create([
            'name' => 'Chăm sóc cơ thể',
            'slug' => 'cham-soc-co-the',
            'parent_id' => 0,
        ]);

        $fragrance = Category::create([
            'name' => 'Nước hoa',
            'slug' => 'nuoc-hoa',
            'parent_id' => 0,
        ]);

        // Subcategories cho Chăm sóc da
        Category::create(['name' => 'Sữa rửa mặt', 'slug' => 'sua-rua-mat', 'parent_id' => $skincare->id]);
        Category::create(['name' => 'Toner', 'slug' => 'toner', 'parent_id' => $skincare->id]);
        Category::create(['name' => 'Serum', 'slug' => 'serum', 'parent_id' => $skincare->id]);
        Category::create(['name' => 'Kem dưỡng ẩm', 'slug' => 'kem-duong-am', 'parent_id' => $skincare->id]);
        Category::create(['name' => 'Kem chống nắng', 'slug' => 'kem-chong-nang', 'parent_id' => $skincare->id]);
        Category::create(['name' => 'Mặt nạ', 'slug' => 'mat-na', 'parent_id' => $skincare->id]);

        // Subcategories cho Trang điểm
        Category::create(['name' => 'Kem nền', 'slug' => 'kem-nen', 'parent_id' => $makeup->id]);
        Category::create(['name' => 'Phấn má hồng', 'slug' => 'phan-ma-hong', 'parent_id' => $makeup->id]);
        Category::create(['name' => 'Son môi', 'slug' => 'son-moi', 'parent_id' => $makeup->id]);
        Category::create(['name' => 'Mascara', 'slug' => 'mascara', 'parent_id' => $makeup->id]);
        Category::create(['name' => 'Kẻ mắt', 'slug' => 'ke-mat', 'parent_id' => $makeup->id]);
        Category::create(['name' => 'Phấn mắt', 'slug' => 'phan-mat', 'parent_id' => $makeup->id]);

        // Subcategories cho Chăm sóc tóc
        Category::create(['name' => 'Dầu gội', 'slug' => 'dau-goi', 'parent_id' => $haircare->id]);
        Category::create(['name' => 'Dầu xả', 'slug' => 'dau-xa', 'parent_id' => $haircare->id]);
        Category::create(['name' => 'Mặt nạ tóc', 'slug' => 'mat-na-toc', 'parent_id' => $haircare->id]);
        Category::create(['name' => 'Tinh dầu dưỡng tóc', 'slug' => 'tinh-dau-duong-toc', 'parent_id' => $haircare->id]);

        // Subcategories cho Chăm sóc cơ thể
        Category::create(['name' => 'Sữa tắm', 'slug' => 'sua-tam', 'parent_id' => $bodycare->id]);
        Category::create(['name' => 'Kem dưỡng thể', 'slug' => 'kem-duong-the', 'parent_id' => $bodycare->id]);
        Category::create(['name' => 'Tẩy tế bào chết', 'slug' => 'tay-te-bao-chet', 'parent_id' => $bodycare->id]);

        // Subcategories cho Nước hoa
        Category::create(['name' => 'Nước hoa nữ', 'slug' => 'nuoc-hoa-nu', 'parent_id' => $fragrance->id]);
        Category::create(['name' => 'Nước hoa nam', 'slug' => 'nuoc-hoa-nam', 'parent_id' => $fragrance->id]);
        Category::create(['name' => 'Nước hoa unisex', 'slug' => 'nuoc-hoa-unisex', 'parent_id' => $fragrance->id]);
    }
}
