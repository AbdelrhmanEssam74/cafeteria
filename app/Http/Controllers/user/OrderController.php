<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $query = Order::with('orderItems.product')
            ->where('user_id', Auth::id());

        // Add date filter if provided
        if (request()->has('filter_date') && request('filter_date') != '') {
            $filterDate = request('filter_date');
            $query->whereDate('created_at', $filterDate);
        }

        // Handle sorting
        if (request()->has('sort')) {
            switch (request('sort')) {
                case 'date_asc':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'date_desc':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $orders = $query->get();

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
        if (Auth::id() !== $order->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $order->delete();

        return redirect()->route('user.orders.index')
            ->with('success', 'Order deleted successfully');
    }

    public function deleteAll()
    {
        // Delete all orders for the current user
        $orderCount = Order::where('user_id', Auth::id())->count();

        if ($orderCount > 0) {
            Order::where('user_id', Auth::id())->delete();
            return redirect()->route('user.orders.index')
                ->with('success', 'All ' . $orderCount . ' orders deleted successfully');
        }

        return redirect()->route('user.orders.index')
            ->with('info', 'No orders found to delete');
    }
}
