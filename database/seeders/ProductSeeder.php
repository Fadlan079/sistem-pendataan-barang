<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::first();
        $user = User::first() ?? User::factory()->create();

        Product::create([
            'category_id' => $category->id,
            'created_by' => $user->id,
            'code' => 'PRD-001',
            'name' => 'Mouse Logitech',
            'price' => 150000,
            'stock' => 10,
            'description' => 'Mouse wireless',
        ]);
    }
}
