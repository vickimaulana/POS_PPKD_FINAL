<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $SalesToday = Order::whereDate('order_date', $today)->count();
        $AmountToday = Order::whereDate('order_date', $today)->sum('order_amount');
        $LastOrders = Order::whereDate('order_date', $today)
            ->orderBy('order_date', 'desc')
            ->limit(5)
            ->get();
        $LowStock = Product::active()->notDelete()->orderBy('product_qty', 'asc')
            ->limit(10)
            ->get();

        return view('dashboard.dashboard-kasir', compact('SalesToday', 'AmountToday', 'LastOrders', 'LowStock'));

        // if (auth()->user()->role_id == 1) {
        //     return view('dashboard.dashboard-admin');
        // }
        // if (auth()->user()->role_id == 2) {
        //     return view('dashboard.dashboard-pimpinan');
        // }
        // if (auth()->user()->role_id == 3) {
        //     return view('dashboard.dashboard-kasir', compact('SalesToday', 'AmountToday', 'LastOrders', 'LowStock'));
        // }
    }
}
