<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    // Laporan harian
    public function daily()
    {
        $date = request('date', Carbon::today());
        
        $sales = Sale::whereDate('created_at', $date)
                     ->with('items.product', 'user')
                     ->orderBy('created_at', 'desc')
                     ->get();

        $total = $sales->sum('total');
        $count = $sales->count();

        return view('reports.daily', compact('sales', 'total', 'count', 'date'));
    }

    // Laporan bulanan
    public function monthly()
    {
        $month = request('month', Carbon::now()->format('Y-m'));
        $start = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $sales = Sale::whereBetween('created_at', [$start, $end])
                     ->with('items.product', 'user')
                     ->orderBy('created_at', 'desc')
                     ->get();

        $total = $sales->sum('total');
        $count = $sales->count();

        // Data untuk chart
        $chartData = Sale::whereBetween('created_at', [$start, $end])
                         ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
                         ->groupBy('date')
                         ->orderBy('date')
                         ->get();

        return view('reports.monthly', compact('sales', 'total', 'count', 'month', 'chartData'));
    }

    // API untuk chart grafik
    public function chartData(Request $request)
    {
        $period = $request->get('period', 'daily'); // daily, weekly, monthly
        $date = $request->get('date', Carbon::today());

        $start = Carbon::parse($date);
        
        if ($period === 'daily') {
            $start = $start->startOfDay();
            $end = $start->endOfDay();
            $groupBy = 'HOUR(created_at)';
        } elseif ($period === 'weekly') {
            $start = $start->startOfWeek();
            $end = $start->copy()->addDays(6)->endOfDay();
            $groupBy = 'DATE(created_at)';
        } else { // monthly
            $start = $start->startOfMonth();
            $end = $start->copy()->endOfMonth();
            $groupBy = 'DATE(created_at)';
        }

        $data = Sale::whereBetween('created_at', [$start, $end])
                    ->select(DB::raw("{$groupBy} as label"), DB::raw('SUM(total) as total'), DB::raw('COUNT(*) as count'))
                    ->groupBy(DB::raw($groupBy))
                    ->orderBy(DB::raw($groupBy))
                    ->get();

        return response()->json([
            'labels' => $data->pluck('label'),
            'data' => $data->pluck('total'),
            'count' => $data->pluck('count')
        ]);
    }

    // Summary dashboard admin
    public function dashboard()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();

        $todayTotal = Sale::whereDate('created_at', $today)->sum('total');
        $todayCount = Sale::whereDate('created_at', $today)->count();
        
        $monthTotal = Sale::where('created_at', '>=', $thisMonth)->sum('total');
        $monthCount = Sale::where('created_at', '>=', $thisMonth)->count();

        // Top 5 produk terlaris
        $topProducts = DB::table('sale_items')
                         ->join('products', 'sale_items.product_id', '=', 'products.id')
                         ->select('products.name', DB::raw('SUM(sale_items.qty) as total_qty'), DB::raw('SUM(sale_items.subtotal) as total_amount'))
                         ->where('sale_items.created_at', '>=', $thisMonth)
                         ->groupBy('products.id', 'products.name')
                         ->orderByDesc('total_qty')
                         ->limit(5)
                         ->get();

        return view('dashboard', compact('todayTotal', 'todayCount', 'monthTotal', 'monthCount', 'topProducts'));
    }
}
