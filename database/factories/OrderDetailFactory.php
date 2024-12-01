<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();
        $quantity = fake()->numberBetween(1, 10); // Random quantity between 1 and 10
        $unitPrice = $product->price ?? fake()->randomFloat(2, 5, 100); // Use product price or generate random price

        return [
            'product_id' => $product->id,
            'order_id' => Order::inRandomOrder()->first()->id ?? Order::factory(),
            'unit_price' => $unitPrice,
            'quantity' => $quantity,
        ];
        
    }
}
