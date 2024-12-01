<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some top-level categories
        $topLevelCategories = Category::factory(5)->create();

        // Create subcategories for each top-level category
        foreach ($topLevelCategories as $category) {
            Category::factory(rand(2, 4))->create([
                'parent_id' => $category->id,
            ]);
        }
    }
}
