<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
class ProductsTableSeeder extends Seeder
{
    public function run()
    {
       
        $lamps = Category::where('name', 'Lamps and lightning')->firstOrFail();
        $cables = Category::where('name', 'Cables')->firstOrFail();
        $essentials = Category::where('name', 'Electricity essentials')->firstOrFail();
        $ev = Category::where('name', 'EV charging')->firstOrFail();
        $connectors = Category::where('name', 'Connectors')->firstOrFail();


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
                'is_latest' => false,
                'category_id' => $cables->id,

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
                'is_latest' => false,
                'category_id' => $cables->id,

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
                'is_latest' => false,
                'category_id' => $cables->id,

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
                'is_latest' => false,
                'category_id' => $connectors->id,

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
                'is_latest' => false,
                'category_id' => $connectors->id,

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
                'is_latest' => false,
                'category_id' => $essentials->id,

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
                'is_latest' => false,
                'category_id' => $essentials->id,

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
                'is_latest' => false,
                'category_id' => $essentials->id,

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
                'is_latest' => false,
                'category_id' => $lamps->id,

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
                'is_latest' => false,
                'category_id' => $lamps->id,

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
                'is_latest' => false,
                'category_id' => $lamps->id,

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
                'is_latest' => false,
                'category_id' => $lamps->id,

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
                'is_on_sale' => false,
                'is_latest' => true,
                'category_id' => $ev->id,

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
                'is_on_sale' => false,
                'is_latest' => true,
                'category_id' => $ev->id,

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
                'is_on_sale' => false,
                'is_latest' => true,
                'category_id' => $ev->id,

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
                'is_on_sale' => false,
                'is_latest' => true,
                'category_id' => $ev->id,

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
                'is_on_sale' => false,
                'is_latest' => true,
                'category_id' => $ev->id,

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
                'is_on_sale' => false,
                'is_latest' => true,
                'category_id' => $ev->id,

            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}