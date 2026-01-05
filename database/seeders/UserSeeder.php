<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Tạo user mẫu
        User::create([
            'name' => 'Nguyễn Văn A',
            'email' => 'user@example.com',
            'phone' => '0987654321',
            'address' => '123 Đường ABC, Quận XYZ, TP. Hồ Chí Minh',
            'password' => bcrypt('123456'),
        ]);

        // Tạo thêm một số user
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'phone' => '098765432' . $i,
                'address' => 'Địa chỉ ' . $i . ', Quận ' . $i . ', TP. Hồ Chí Minh',
                'password' => bcrypt('123456'),
            ]);
        }
    }
}
