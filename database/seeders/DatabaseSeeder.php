<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductReview;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            CategorySeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            ProductReviewSeeder::class
        ]);
    }
}
