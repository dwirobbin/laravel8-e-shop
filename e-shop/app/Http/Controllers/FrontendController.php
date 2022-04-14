<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function indexHome()
    {
        $trendingProducts = Product::where('seen_in_trending_products', 1)->get();
        $popularCategories = Category::where('seen_in_popular_categories', 1)->get();

        return view('frontend.home', compact(
            'trendingProducts',
            'popularCategories'
        ));
    }

    public function indexCategories()
    {
        $categories = Category::where('seen_in_all_category', 1)->get();
        return view('frontend.categories', compact('categories'));
    }

    public function indexProductByCategory($slug)
    {
        if (Category::where('slug', $slug)->exists()) {
            $category = Category::where('slug', $slug)->first();

            $products = Product::where('category_id', $category->id)
                ->where('seen_in_all_product', 1)->get();

            return view('frontend.show-product-by-category', compact(
                'category',
                'products'
            ));
        } else {
            return back()->with('failed', "Slug doesn't exists");
        }
    }

    public function indexProductDetailByCategory($category_slug, $product_slug)
    {
        if (Category::where('slug', $category_slug)->exists()) {

            if (Product::where('slug', $product_slug)->exists()) {
                $product = Product::where('slug', $product_slug)->first();

                return view('frontend.show-product-detail-by-category', compact(
                    'product'
                ));
            } else {
                return back()->with('failed', 'The link was broken');
            }
        } else {
            return back()->with('failed', 'No such category found');
        }
    }
}
