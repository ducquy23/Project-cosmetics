<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FooterSettings;

class FooterSettingsSeeder extends Seeder
{
    public function run()
    {
        FooterSettings::updateOrCreate(
            ['id' => 1],
            [
                'company_name' => 'Cửa hàng mỹ phẩm',
                'company_description' => 'Cửa hàng mỹ phẩm uy tín, chuyên cung cấp các sản phẩm làm đẹp chính hãng từ các thương hiệu nổi tiếng.',
                'address' => '123 Đường ABC, Quận XYZ, TP. Hồ Chí Minh',
                'email' => 'contact@cosmetics.com',
                'hotline' => '19001234',
                'opening_hours' => 'Thứ 2 - Chủ nhật: 8:00 - 22:00',
                'newsletter_description' => 'Đăng ký nhận thông tin khuyến mãi và sản phẩm mới',
                'facebook_url' => 'https://facebook.com/cosmetics',
                'instagram_url' => 'https://instagram.com/cosmetics',
                'twitter_url' => 'https://twitter.com/cosmetics',
                'google_url' => 'https://plus.google.com/cosmetics',
                'copyright_text' => '© 2024 Cửa hàng mỹ phẩm. Tất cả quyền được bảo lưu.',
            ]
        );
    }
}
