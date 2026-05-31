<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the landing page with statistics and recent products.
     */
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $recentProducts = Product::with('category')->latest()->take(3)->get();

        return view('pages.home', compact('totalProducts', 'totalCategories', 'recentProducts'));
    }
}
