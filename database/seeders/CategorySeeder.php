<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {    
         Category::truncate();

        $categories = [
            'Lamps and lightning',
            'Cables',
            'Electricity essentials',
            'EV charging',
            'Connectors',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
