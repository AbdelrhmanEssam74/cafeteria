<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $canceledOrders = Order::where('status', 'canceled')->count();

        $sales = Order::where('status', 'delivered')->with('items')->get()->flatMap->items
        ->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('Admin.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'processingOrders',
            'deliveredOrders',
            'canceledOrders',
            'sales'
        ));
    }
}
