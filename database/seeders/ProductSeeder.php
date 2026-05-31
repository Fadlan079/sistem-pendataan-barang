<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();

        $elektronik = Category::where('name', 'Elektronik')->first();
        $atk = Category::where('name', 'ATK')->first();
        $furniture = Category::where('name', 'Furniture')->first();

        $products = [
            [
                'code' => 'PRD-001',
                'category_id' => $elektronik->id,
                'name' => 'Mouse Logitech',
                'price' => 150000,
                'stock' => 10,
                'description' => 'Mouse wireless',
            ],
            [
                'code' => 'PRD-002',
                'category_id' => $elektronik->id,
                'name' => 'Keyboard Mechanical',
                'price' => 450000,
                'stock' => 8,
                'description' => 'Keyboard mechanical RGB',
            ],
            [
                'code' => 'PRD-003',
                'category_id' => $elektronik->id,
                'name' => 'Monitor 24 Inch',
                'price' => 1750000,
                'stock' => 5,
                'description' => 'Monitor Full HD 24 inch',
            ],
            [
                'code' => 'PRD-004',
                'category_id' => $elektronik->id,
                'name' => 'Printer Epson L3210',
                'price' => 2400000,
                'stock' => 3,
                'description' => 'Printer ink tank',
            ],

            [
                'code' => 'PRD-005',
                'category_id' => $atk->id,
                'name' => 'Pulpen Standard',
                'price' => 5000,
                'stock' => 100,
                'description' => 'Pulpen tinta hitam',
            ],
            [
                'code' => 'PRD-006',
                'category_id' => $atk->id,
                'name' => 'Pensil 2B',
                'price' => 3000,
                'stock' => 120,
                'description' => 'Pensil untuk menulis',
            ],
            [
                'code' => 'PRD-007',
                'category_id' => $atk->id,
                'name' => 'Buku Tulis',
                'price' => 8000,
                'stock' => 75,
                'description' => 'Buku tulis 58 lembar',
            ],

            [
                'code' => 'PRD-008',
                'category_id' => $furniture->id,
                'name' => 'Meja Kantor',
                'price' => 1200000,
                'stock' => 4,
                'description' => 'Meja kerja kayu',
            ],
            [
                'code' => 'PRD-009',
                'category_id' => $furniture->id,
                'name' => 'Kursi Kantor',
                'price' => 850000,
                'stock' => 6,
                'description' => 'Kursi ergonomis',
            ],
            [
                'code' => 'PRD-010',
                'category_id' => $furniture->id,
                'name' => 'Lemari Arsip',
                'price' => 1500000,
                'stock' => 2,
                'description' => 'Lemari penyimpanan dokumen',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['code' => $product['code']],
                [
                    'category_id' => $product['category_id'],
                    'created_by' => $user->id,
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'description' => $product['description'],
                ]
            );
        }
    }
}
