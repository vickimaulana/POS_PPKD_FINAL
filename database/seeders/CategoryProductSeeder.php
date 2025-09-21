<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'id' => 1,
                'category_name' => 'Makanan Berat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'category_name' => 'Makanan Ringan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'category_name' => 'Minuman Dingin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'category_name' => 'Minuman Panas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'category_name' => 'Dessert',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'category_name' => 'Fast Food',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'category_name' => 'Seafood',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'category_name' => 'Asian Food',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'category_name' => 'Western Food',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'category_name' => 'Italian Food',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Product::factory()->count(50)->create();
    }
}
