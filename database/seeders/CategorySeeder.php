<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik', 'description' => 'Peralatan elektronik'],
            ['name' => 'ATK', 'description' => 'Alat tulis kantor'],
            ['name' => 'Furniture', 'description' => 'Perabotan'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
