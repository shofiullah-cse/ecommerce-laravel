<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function home(): View
    {
        $categories = Category::where('status', true)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        $featuredProducts = Product::with([
                'category',
                'brand',
            ])
            ->where('status', true)
            ->where('featured', true)
            ->latest()
            ->take(8)
            ->get();

        $latestProducts = Product::with([
                'category',
                'brand',
            ])
            ->where('status', true)
            ->latest()
            ->take(8)
            ->get();

        return view(
            'frontend.home',
            compact(
                'categories',
                'featuredProducts',
                'latestProducts'
            )
        );
    }

    public function shop(Request $request): View
    {
        $products = Product::with([
                'category',
                'brand',
            ])
            ->where('status', true)

            ->when(
                $request->search,
                function ($query, $search) {
                    $query->where(
                        'name',
                        'like',
                        "%{$search}%"
                    );
                }
            )

            ->when(
                $request->category,
                function ($query, $category) {
                    $query->where(
                        'category_id',
                        $category
                    );
                }
            )

            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'frontend.shop',
            compact(
                'products',
                'categories'
            )
        );
    }

    public function product(Product $product): View
    {
        abort_unless(
            $product->status,
            404
        );

        $product->load([
            'category',
            'brand',
            'images',
        ]);

        $relatedProducts = Product::where(
                'category_id',
                $product->category_id
            )
            ->where(
                'id',
                '!=',
                $product->id
            )
            ->where('status', true)
            ->latest()
            ->take(4)
            ->get();

        return view(
            'frontend.product',
            compact(
                'product',
                'relatedProducts'
            )
        );
    }
}