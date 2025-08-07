<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Lamps and lightning',
            'Cables',
            'Electricity essentials',
            'EV chargers',
            'Connectors',
            'Inverters',
            'Batteries',
            'UPS',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(
                ['name' => $name],
                [] 
            );
        }
    }
}
