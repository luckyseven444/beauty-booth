<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\OrderDetail;

class CategoryController extends Controller
{
    public function fetchProducts($slug, Request $request)
    {
        $sort = $request->query('sort'); // Get the 'sort' query parameter

        switch ($sort) {
            case 'best_sell':
                // Fetch best-selling products for the category
                $products = $this->getBestSellingProducts($slug);
                break;

            case 'top_rated':
                // Fetch top-rated products for the category
                $products = $this->getTopRatedProducts($slug);
                break;

            case 'price_high_to_low':
                // Fetch products sorted by price (high to low)
                $products = $this->getProductsPriceHighToLow($slug);
                break;

            case 'price_low_to_high':
                // Fetch products sorted by price (low to high)
                $products = $this->getProductsPriceLowToHigh($slug);
                break;

            default:
                return response()->json(['error' => 'Invalid sort option'], 400);
        }

        return response()->json($products);
    }

    // Add your logic for fetching the products based on sorting
    private function getBestSellingProducts($slug): JsonResponse
    {
        
        $category = Category::with('products:id')->where('slug', $slug)->first();

        if ($category) {
            // Get only the product IDs as an array
            $productIds = $category->products->pluck('id')->toArray();

            $orderDetailsGrouped = OrderDetail::whereIn('product_id', $productIds)
                ->with('product')
                ->select('product_id', \DB::raw('COUNT(*) as total'))
                ->groupBy('product_id')
                ->orderBy('total', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Order details grouped by product ID successfully',
                'data' => $orderDetailsGrouped,
            ], 200);
        }
    }

    private function getTopRatedProducts($slug)
    {
        // Example: Fetch top-rated products from the database
        return [];
    }

    private function getProductsPriceHighToLow($slug)
    {
        // Example: Fetch products sorted by price (high to low) from the database
        return [];
    }

    private function getProductsPriceLowToHigh($slug)
    {
        // Example: Fetch products sorted by price (low to high) from the database
        return [];
    }
}
