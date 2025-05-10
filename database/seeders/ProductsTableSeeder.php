<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        Product::truncate();

        $products = [
            [
                'name' => 'PSS Slim Console',
                'description' => 'Compact console for professional audio mixing',
                'price' => 25.00,
                'sale_price' => null,
                'quantity' => 15,
                'image' => 'images/pack1.png',
                'is_available' => true,
                'is_featured' => true,
                'is_on_sale' => false,
            ],
            [
                'name' => 'Ibanez Professional Classical Guitar',
                'description' => 'High-quality classical guitar with rich tone',
                'price' => 150.00,
                'sale_price' => null,
                'quantity' => 8,
                'image' => 'images/pack2.png',
                'is_available' => true,
                'is_featured' => true,
                'is_on_sale' => false,
            ],
            [
                'name' => 'Moon Aroma Diffuser',
                'description' => 'Elegant ultrasonic essential oil diffuser',
                'price' => 10.00,
                'sale_price' => null,
                'quantity' => 25,
                'image' => 'images/Pack-charge.png',
                'is_available' => true,
                'is_featured' => true,
                'is_on_sale' => false,
            ],
            [
                'name' => 'Vintage Vinyl Record Player',
                'description' => 'Retro-style turntable with modern features',
                'price' => 60.00,
                'sale_price' => null,
                'quantity' => 5,
                'image' => 'images/pack1.png',
                'is_available' => true,
                'is_featured' => true,
                'is_on_sale' => false,
            ],
            [
                'name' => 'Ibanez Professional Classical Guitar',
                'description' => 'High-quality classical guitar with rich tone',
                'price' => 150.00,
                'sale_price' => null,
                'quantity' => 8,
                'image' => 'images/pack2.png',
                'is_available' => true,
                'is_featured' => true,
                'is_on_sale' => false,
            ],
            [
                'name' => 'Vintage Vinyl Record Player',
                'description' => 'Retro-style turntable with modern features',
                'price' => 60.00,
                'sale_price' => null,
                'quantity' => 5,
                'image' => 'images/pack1.png',
                'is_available' => true,
                'is_featured' => true,
                'is_on_sale' => false,
            ],
            [
                'name' => ' Vinyl Record Player',
                'description' => 'Retro-style turntable with modern features',
                'price' => 60.00,
                'sale_price' => 45.00,
                'quantity' => 5,
                'image' => 'images/pack1.png',
                'is_available' => true,
                'is_featured' => false,
                'is_on_sale' => true,
            ],
              [
                'name' => ' Aroma Diffuser',
                'description' => 'Elegant ultrasonic essential oil diffuser',
                'price' => 10.00,
                'sale_price' => 5.00,
                'quantity' => 25,
                'image' => 'images/Pack-charge.png',
                'is_available' => true,
                'is_featured' => false,
                'is_on_sale' => true,
            ],
            [
                'name' => ' Vinyl Record Player',
                'description' => 'Retro-style turntable with modern features',
                'price' => 60.00,
                'sale_price' => 40.00,
                'quantity' => 5,
                'image' => 'images/pack1.png',
                'is_available' => true,
                'is_featured' => false,
                'is_on_sale' => true,
            ],
            [
                'name' => ' Professional Classical Guitar',
                'description' => 'High-quality classical guitar with rich tone',
                'price' => 150.00,
                'sale_price' => 135.00,
                'quantity' => 8,
                'image' => 'images/pack2.png',
                'is_available' => true,
                'is_featured' => false,
                'is_on_sale' => true,
            ],
            [
                'name' => ' Professional Classical Guitar',
                'description' => 'High-quality classical guitar with rich tone',
                'price' => 150.00,
                'sale_price' => 135.00,
                'quantity' => 8,
                'image' => 'images/pack2.png',
                'is_available' => true,
                'is_featured' => false,
                'is_on_sale' => true,
            ],
            [
                'name' => ' Professional Classical Guitar',
                'description' => 'High-quality classical guitar with rich tone',
                'price' => 150.00,
                'sale_price' => 135.00,
                'quantity' => 8,
                'image' => 'images/pack2.png',
                'is_available' => true,
                'is_featured' => false,
                'is_on_sale' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}