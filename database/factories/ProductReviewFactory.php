<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductReview>
 */
class ProductReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id ?? Product::factory(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'comment' => fake()->boolean(70) ? fake()->sentence(10) : null, // 70% chance to have a comment
            'rating' => fake()->numberBetween(1, 5), // Rating between 1 and 5
        ];
    }
}
