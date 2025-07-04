<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Verify the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $order->load('orderItems.product');

        return view('user.orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($order->status === 'pending') {
            $order->update(['status' => 'canceled']);
            return redirect()->back()
                ->with('success', 'Order #' . $order->order_number . ' has been cancelled successfully');
        }

        return redirect()->back()
            ->with('error', 'Order #' . $order->order_number . ' cannot be cancelled at this stage');
    }

    public function destroy(Order $order)
    {
        // Check if user owns the order or is admin
        if (auth()->id() !== $order->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully');
    }

    public function deleteAll()
    {
        // Delete all orders for the current user
        Order::where('user_id', auth()->id())->delete();

        return redirect()->route('orders.index')
            ->with('success', 'All orders deleted successfully');
    }
}
