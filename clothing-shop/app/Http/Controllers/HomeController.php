<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('home', compact('categories', 'products'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = Category::withCount('products')->get();
        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('category', compact('category', 'categories', 'products'));
    }

    public function product($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        $relatedProducts = $product->getRelatedProducts(4);

        return view('product', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $categories = Category::withCount('products')->get();
        
        $products = Product::where('is_active', true)
            ->where(function($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                      ->orWhere('description', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(12);

        return view('search', compact('keyword', 'categories', 'products'));
    }
}