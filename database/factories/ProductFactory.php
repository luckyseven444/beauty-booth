<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->generateCosmeticName();
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'price' => fake()->randomFloat(2, 5, 100)
        ];
    }

    // Generate a fake cosmetic product name
    function generateCosmeticName() {
        $adjectives = ['Radiant', 'Flawless', 'Glowing', 'Silky', 'Velvety', 'Fresh'];
        $products = ['Lipstick', 'Foundation', 'Serum', 'Cream', 'Lotion', 'Mascara', 'Blush', 'Perfume'];
        
        $brandName = fake()->company; // Use a random company name
        $adjective = fake()->randomElement($adjectives); // Random adjective
        $product = fake()->randomElement($products); // Random product

        return "{$brandName} {$adjective} {$product}";
    }
}
