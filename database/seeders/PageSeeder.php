<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run()
    {
        $pages = [
            [
                'type' => 'about',
                'title' => 'Giới thiệu',
                'content' => '<h1>Giới thiệu về chúng tôi</h1><p>Chúng tôi là cửa hàng mỹ phẩm uy tín, chuyên cung cấp các sản phẩm làm đẹp chính hãng từ các thương hiệu nổi tiếng trên thế giới.</p>',
                'meta_title' => 'Giới thiệu - Cửa hàng mỹ phẩm',
                'meta_description' => 'Giới thiệu về cửa hàng mỹ phẩm của chúng tôi',
            ],
            [
                'type' => 'privacy',
                'title' => 'Chính sách bảo mật',
                'content' => '<h1>Chính sách bảo mật</h1><p>Chúng tôi cam kết bảo vệ thông tin cá nhân của khách hàng...</p>',
                'meta_title' => 'Chính sách bảo mật',
                'meta_description' => 'Chính sách bảo mật thông tin của chúng tôi',
            ],
            [
                'type' => 'terms',
                'title' => 'Điều khoản sử dụng',
                'content' => '<h1>Điều khoản sử dụng</h1><p>Khi sử dụng website của chúng tôi, bạn đồng ý với các điều khoản sau...</p>',
                'meta_title' => 'Điều khoản sử dụng',
                'meta_description' => 'Điều khoản sử dụng website',
            ],
            [
                'type' => 'shipping',
                'title' => 'Chính sách vận chuyển',
                'content' => '<h1>Chính sách vận chuyển</h1><p>Chúng tôi giao hàng toàn quốc với nhiều phương thức vận chuyển...</p>',
                'meta_title' => 'Chính sách vận chuyển',
                'meta_description' => 'Thông tin về chính sách vận chuyển',
            ],
            [
                'type' => 'return',
                'title' => 'Chính sách đổi trả',
                'content' => '<h1>Chính sách đổi trả</h1><p>Khách hàng có thể đổi trả sản phẩm trong vòng 7 ngày...</p>',
                'meta_title' => 'Chính sách đổi trả',
                'meta_description' => 'Thông tin về chính sách đổi trả hàng',
            ],
        ];

        foreach ($pages as $pageData) {
            Page::create($pageData);
        }
    }
}
