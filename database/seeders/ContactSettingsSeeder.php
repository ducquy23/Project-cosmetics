<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactSettings;

class ContactSettingsSeeder extends Seeder
{
    public function run()
    {
        ContactSettings::updateOrCreate(
            ['id' => 1],
            [
                'address' => '123 Đường ABC, Quận XYZ, TP. Hồ Chí Minh',
                'emails' => "contact@cosmetics.com\ninfo@cosmetics.com\nsupport@cosmetics.com",
                'hotlines' => "19001234\n0123456789\n0987654321",
                'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=..." width="100%" height="400"></iframe>',
                'intro_text' => 'Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn. Hãy liên hệ với chúng tôi qua form bên dưới hoặc các thông tin liên hệ.',
            ]
        );
    }
}
