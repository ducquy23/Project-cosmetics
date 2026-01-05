<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Origin;

class OriginSeeder extends Seeder
{
    public function run()
    {
        $origins = [
            ['name' => 'Việt Nam'],
            ['name' => 'Hàn Quốc'],
            ['name' => 'Nhật Bản'],
            ['name' => 'Pháp'],
            ['name' => 'Mỹ'],
            ['name' => 'Thái Lan'],
            ['name' => 'Đức'],
            ['name' => 'Anh'],
            ['name' => 'Ý'],
            ['name' => 'Trung Quốc'],
        ];

        foreach ($origins as $origin) {
            Origin::create($origin);
        }
    }
}
