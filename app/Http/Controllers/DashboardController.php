<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Customer;
use App\Models\ProductReturn;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard
     */
    public function index()
    {
        // Get statistics
        $totalSuppliers = Supplier::where('is_active', true)->count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalCustomers = Customer::count();
        $totalPurchases = Purchase::count();
        $totalReturns = ProductReturn::count();
        
        // Get stock info
        $lowStockProducts = Product::where('stock', '<', 5)
            ->orWhere('stock', 0)
            ->limit(5)
            ->get();

        $totalStockValue = Product::sum(DB::raw('stock * price'));

        // Get sales info
        $dailySales = Sale::whereDate('created_at', today())
            ->sum('total');

        $monthlySales = Sale::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        // Get recent purchases
        $recentPurchases = Purchase::with(['supplier', 'user'])
            ->latest()
            ->limit(10)
            ->get();

        // Get recent returns
        $recentReturns = ProductReturn::with(['supplier', 'user'])
            ->latest()
            ->limit(5)
            ->get();

        // Get purchase stats by status
        $purchasesByStatus = Purchase::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status');

        // Get sales trend (last 7 days)
        $salesTrend = Sale::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total'),
            DB::raw('COUNT(*) as transactions')
        )
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        // Get top suppliers
        $topSuppliers = Supplier::withCount('purchases')
            ->orderByDesc('purchases_count')
            ->limit(5)
            ->get();

        return view('dashboard.master', compact(
            'totalSuppliers',
            'totalProducts',
            'totalCategories',
            'totalCustomers',
            'totalPurchases',
            'totalReturns',
            'lowStockProducts',
            'totalStockValue',
            'dailySales',
            'monthlySales',
            'recentPurchases',
            'recentReturns',
            'purchasesByStatus',
            'salesTrend',
            'topSuppliers'
        ));
    }
}
