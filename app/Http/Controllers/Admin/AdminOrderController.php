<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;


class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'user')->get();
        $products = Product::where('availability', true)->get();

        return view('admin.orders.create', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array',
        ]);

        $totalPrice = 0;

        foreach ($request->products as $item) {
            if (empty($item['quantity']) || $item['quantity'] < 1) {
                continue;
            }

            $product = Product::find($item['id']);
            if (!$product) {
                continue;
            }

            $totalPrice += $product->price * $item['quantity'];
        }

        if(auth()->check() && auth()->user()->role === 'admin'){
            $order = Order::create([
                'user_id' => $request->user_id,
                'status' => 'Processing',
                'total_price' => $totalPrice,
            ]);
        }else{
            $order = Order::create([
                'user_id' => $request->user_id,
                'status' => 'pending',
                'total_price' => $totalPrice,
            ]);
        }


        foreach ($request->products as $item) {
            if (empty($item['quantity']) || $item['quantity'] < 1) {
                continue;
            }

            $product = Product::find($item['id']);
            if (!$product) {
                continue;
            }

            $order->items()->create([
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with(['user', 'items.product.category'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,delivered,canceled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('orders.show', $id)->with('success', 'Order status updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
