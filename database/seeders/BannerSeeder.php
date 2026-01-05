<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run()
    {
        $banners = [
            [
                'title' => 'Banner chính 1',
                'image' => '/assets/frontend/img/home/slide1.jpg',
                'link' => '/shop',
                'type' => 'slide',
                'status' => 'active',
                'order' => 1,
            ],
            [
                'title' => 'Banner chính 2',
                'image' => '/assets/frontend/img/home/slide2.jpg',
                'link' => '/shop',
                'type' => 'slide',
                'status' => 'active',
                'order' => 2,
            ],
            [
                'title' => 'Banner chính 3',
                'image' => '/assets/frontend/img/home/slide3.jpg',
                'link' => '/shop',
                'type' => 'slide',
                'status' => 'active',
                'order' => 3,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
