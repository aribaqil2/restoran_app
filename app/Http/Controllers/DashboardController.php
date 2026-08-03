<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Ringkasan (Cards)
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('grandtotal');

        $todayOrders = Order::whereDate('created_at', now())->count();
        $todayRevenue = Order::whereDate('created_at', now())->sum('grandtotal');

        // 2. Data Grafik Pemasukan per Bulan (Tahun Ini)
$monthlyRevenue = Order::select(
        DB::raw('MONTH(created_at) as bulan'),
        DB::raw('SUM(grandtotal) as total')
    )
    ->whereYear('created_at', date('Y'))
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->pluck('total', 'bulan')
    ->toArray();

// Menyusun array 12 bulan dan konversi tegas ke tipe angka (float)
$chartData = [];
for ($i = 1; $i <= 12; $i++) {
    // Memastikan jika nilainya null/kosong diganti 0, dan dikonversi ke Angka (float)
    $chartData[] = isset($monthlyRevenue[$i]) ? (float) $monthlyRevenue[$i] : 0;
}

        // 3. Kirim semua data ke View admin.dashboard
        return view('admin.dashboard', compact(
            'totalOrders', 
            'totalRevenue', 
            'todayOrders', 
            'todayRevenue', 
            'chartData'
        ));
    }
}
