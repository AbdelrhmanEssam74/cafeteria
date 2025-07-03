<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function menu(Request $request)
    {
        // Start building the query
        $query = Product::query();
        
        // Search by name if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        // Filter by price range
        if ($request->has('min_price') && is_numeric($request->min_price)) {
            $query->where('price', '>=', (float)$request->min_price);
        }
        
        if ($request->has('max_price') && is_numeric($request->max_price)) {
            $query->where('price', '<=', (float)$request->max_price);
        }
        
        // Get results with pagination
        $products = $query->paginate(9);
        
        return view('user.menu', compact('products'));
    }

    public function about()
    {
        return view('user.about');
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function cart()
    {
        $cartItems = session()->get('cart', []);
        
        $total = 0;
        foreach($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('user.cart', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }
}