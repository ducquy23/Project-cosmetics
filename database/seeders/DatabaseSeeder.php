<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Tạo Admin trước
        \App\Models\Admin::create([
            'name' => 'Admin',
            'email' => 'admin@yomail.com',
            'password' => bcrypt(123456),
            'role' => 'Quản trị viên',
        ]);

        // Chạy các seeder theo thứ tự
        $this->call([
            // Cơ bản
            CategorySeeder::class,
            BrandSeeder::class,
            OriginSeeder::class,
            
            // Sản phẩm
            ProductSeeder::class,
            ProductImageSeeder::class,
            
            // Banner và nội dung
            BannerSeeder::class,
            PostTypeSeeder::class,
            PostSeeder::class,
            
            // Trang và sections
            HomepageSectionSeeder::class,
            PageSeeder::class,
            
            // Settings
            ContactSettingsSeeder::class,
            FooterSettingsSeeder::class,
            SeoSettingsSeeder::class,
            
            // User
            UserSeeder::class,
            
            // Menu (đã có sẵn)
            MenuItemsSeeder::class,
        ]);
    }
}
