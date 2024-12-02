<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\OrderDetail;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Validator;
use Exception;

class CategoryController extends Controller
{
    public function fetchProducts($slug, Request $request)
    {
        $validator = $this->validateSlug($slug);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $category = Category::with('products:id')->where('slug', $slug)->first();

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $sort = $request->query('sort'); // Get the 'sort' query parameter

        switch ($sort) {
            case 'best_sell':
                $response = $this->getBestSellingProducts($category);
                break;

            case 'top_rated':
                $response = $this->getTopRatedProducts($category);
                break;

            case 'price_high_to_low':
                $response = $this->getProductsPriceHighToLow($category);
                break;

            case 'price_low_to_high':
                $response = $this->getProductsPriceLowToHigh($category);
                break;

            default:
                return response()->json(['error' => 'Invalid sort option'], 400);
        }

        return $response;
    }

    private function validateSlug($slug)
    {
        return Validator::make(
            ['slug' => $slug],
            ['slug' => ['required', 'string', 'regex:/^[a-zA-Z0-9-_]+$/']]
        );
    }

    private function getBestSellingProducts($category): JsonResponse
    {
        try {
            $productIds = $category->products->pluck('id')->toArray();

            $orderDetailsGrouped = OrderDetail::whereIn('product_id', $productIds)
                ->with('product')
                ->select('product_id', \DB::raw('COUNT(*) as total'))
                ->groupBy('product_id')
                ->orderBy('total', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Best-selling products fetched successfully',
                'data' => $orderDetailsGrouped,
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function getTopRatedProducts($category): JsonResponse
    {
        try {
            $productIds = $category->products->pluck('id')->toArray();

            $reviewsGrouped = ProductReview::whereIn('product_id', $productIds)
                ->with('product')
                ->select('product_id', \DB::raw('AVG(rating) as avg_rating'))
                ->groupBy('product_id')
                ->orderBy('avg_rating', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Top-rated products fetched successfully',
                'data' => $reviewsGrouped,
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function getProductsPriceHighToLow($category): JsonResponse
    {
        try {
            $productIds = $category->products->pluck('id')->toArray();

            $products = Product::whereIn('id', $productIds)
                ->orderBy('price', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Products sorted by price (high to low) fetched successfully',
                'data' => $products,
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function getProductsPriceLowToHigh($category): JsonResponse
    {
        try {
            $productIds = $category->products->pluck('id')->toArray();

            $products = Product::whereIn('id', $productIds)
                ->orderBy('price', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Products sorted by price (low to high) fetched successfully',
                'data' => $products,
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
