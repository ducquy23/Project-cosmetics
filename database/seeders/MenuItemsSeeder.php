<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Trang chủ',
                'route' => 'home',
                'url' => null,
                'order' => 1,
                'is_active' => 1,
                'is_visible' => 1,
            ],
            [
                'name' => 'Cửa hàng',
                'route' => 'shop',
                'url' => null,
                'order' => 2,
                'is_active' => 1,
                'is_visible' => 1,
            ],
            [
                'name' => 'Danh mục',
                'route' => 'category',
                'url' => '#',
                'order' => 3,
                'is_active' => 1,
                'is_visible' => 1,
            ],
            [
                'name' => 'Tin tức',
                'route' => 'blog',
                'url' => null,
                'order' => 4,
                'is_active' => 1,
                'is_visible' => 1,
            ],
            [
                'name' => 'Giới thiệu',
                'route' => 'about',
                'url' => null,
                'order' => 5,
                'is_active' => 1,
                'is_visible' => 1,
            ],
            [
                'name' => 'Liên hệ',
                'route' => 'contact',
                'url' => null,
                'order' => 6,
                'is_active' => 1,
                'is_visible' => 1,
            ],
        ];

        foreach ($menus as $menu) {
            MenuItem::firstOrCreate(
                ['name' => $menu['name']],
                $menu
            );
        }
    }
}
