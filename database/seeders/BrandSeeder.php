<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            ['name' => 'L\'Oreal'],
            ['name' => 'Maybelline'],
            ['name' => 'Revlon'],
            ['name' => 'MAC'],
            ['name' => 'Estée Lauder'],
            ['name' => 'Clinique'],
            ['name' => 'Laneige'],
            ['name' => 'Innisfree'],
            ['name' => 'The Ordinary'],
            ['name' => 'CeraVe'],
            ['name' => 'Neutrogena'],
            ['name' => 'Olay'],
            ['name' => 'Garnier'],
            ['name' => 'Nivea'],
            ['name' => 'Dove'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
