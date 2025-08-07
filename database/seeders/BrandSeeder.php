<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str; 

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::truncate(); 

        $brands = [
            ['name' => 'Panasonic', 'image' => 'panasonic.png'],
            ['name' => 'Felicity', 'image' => 'felicity.png'],
            ['name' => 'Osram', 'image' => 'osram.png'],
            ['name' => 'Hyundai', 'image' => 'hyundai2.png'],
            ['name' => 'Schneider', 'image' => 'schneider.png'],
            ['name' => 'Foshan Ouyad', 'image' => 'foshan.png'], 
            ['name' => 'Other Brands', 'image' => 'unknown.png'], 
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'slug' => Str::slug($brand['name']),  
                'image' => $brand['image'],
            ]);
        }
    }
}
