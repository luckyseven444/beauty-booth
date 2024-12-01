<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         // Generate random values for totals, shipping, and discount
         $shippingCost = fake()->randomFloat(2, 5, 20); // Shipping cost between $5 and $20
         $discount = fake()->randomFloat(2, 0, 15); // Discount between $0 and $15
         $subtotal = fake()->randomFloat(2, 50, 500); // Subtotal between $50 and $500
         
         // Calculate grand total: subtotal + shipping - discount
         $grandTotal = $subtotal + $shippingCost - $discount;
 
         return [
             'grand_total' => $grandTotal,
             'shipping_cost' => $shippingCost,
             'discount' => $discount,
             'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
         ];
    }
}
