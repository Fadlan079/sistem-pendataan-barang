<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $role = $user->role;

        $metrics = [
            'product_count'  => Product::count(),
            'category_count' => Category::count(),
        ];

        $categories = Category::withCount('products')->get();
        $categoryChart = [
            'labels' => $categories->pluck('name')->toArray(),
            'data'   => $categories->pluck('products_count')->toArray(),
        ];

        if ($role === 'admin') {
            $metrics['user_count'] = User::count();

            $users = User::select('created_at')->get();
            $userRegistrations = $users->groupBy(function($u) {
                return Carbon::parse($u->created_at)->format('M Y');
            })->map->count()->take(-6);

            $adminChart = [
                'labels' => $userRegistrations->keys()->toArray(),
                'data'   => $userRegistrations->values()->toArray(),
            ];

            return view("{$role}.dashboard", compact('metrics', 'categoryChart', 'adminChart', 'user'));
        }

        $recentProducts = Product::with('category')->latest()->take(5)->get();

        return view("{$role}.dashboard", compact('metrics', 'categoryChart', 'recentProducts', 'user'));
    }
}
