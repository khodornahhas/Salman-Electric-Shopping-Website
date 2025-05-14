<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::truncate(); 

        $brands = [
            ['name' => 'Panasonic', 'image' => 'panasonic.png'],
            ['name' => 'Felicity', 'image' => 'felicity.png'],
            ['name' => 'Osram', 'image' => 'osram.png'],
            ['name' => 'Hyundai', 'image' => 'hyundai2.png'],
            ['name' => 'Schneider', 'image' => 'schneider.png'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
