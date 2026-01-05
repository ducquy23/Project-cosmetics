<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeoSettings;

class SeoSettingsSeeder extends Seeder
{
    public function run()
    {
        SeoSettings::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Cửa hàng mỹ phẩm',
                'meta_title' => 'Cửa hàng mỹ phẩm - Sản phẩm làm đẹp chính hãng',
                'meta_description' => 'Cửa hàng mỹ phẩm uy tín, chuyên cung cấp các sản phẩm làm đẹp chính hãng từ các thương hiệu nổi tiếng trên thế giới.',
                'meta_keywords' => 'mỹ phẩm, làm đẹp, skincare, makeup, son môi, kem dưỡng da',
                'google_analytics_id' => '',
                'google_search_console' => '',
                'facebook_pixel' => '',
                'enable_sitemap' => true,
            ]
        );
    }
}
