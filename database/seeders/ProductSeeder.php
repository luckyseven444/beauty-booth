<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $categories = Category::factory()->count(3)->create();
        Product::factory()->count(50)->hasAttached($categories)->create(); // Generate 50 fake products
    }
}
