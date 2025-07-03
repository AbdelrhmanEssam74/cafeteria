<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // عرض محتويات السلة
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $total = $this->calculateTotal($cartItems);

        return view('user.cart', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    // إضافة منتج للسلة
    public function add(Product $product, Request $request)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $quantity
            ];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart!',
                'cart_count' => array_sum(array_column($cart, 'quantity')),
                'product_name' => $product->name
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }
    
    // تحديث كمية المنتج
    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity');
        $total = $this->calculateTotal($cart);

        if (!isset($cart[$productId])) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found in cart!'
                ], 404);
            }
            return redirect()->route('cart.index')->with('error', 'Product not found in cart!');
        }

        if ($quantity <= 0) {
            return $this->remove($request, $productId);
        }

        $cart[$productId]['quantity'] = $quantity;
        session()->put('cart', $cart);

        $newTotal = $this->calculateTotal($cart);
        $itemTotal = $cart[$productId]['price'] * $quantity;

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
                'subtotal' => $newTotal,
                'item_price' => $cart[$productId]['price'],
                'item_total' => $itemTotal,
                'cart_count' => array_sum(array_column($cart, 'quantity'))
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    // إزالة منتج من السلة
    public function remove(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$productId])) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found in cart!'
                ], 404);
            }
            return redirect()->route('cart.index')->with('error', 'Product not found in cart!');
        }

        $productName = $cart[$productId]['name'];
        unset($cart[$productId]);
        session()->put('cart', $cart);

        $newTotal = $this->calculateTotal($cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart!',
                'subtotal' => $newTotal,
                'product_name' => $productName,
                'cart_count' => array_sum(array_column($cart, 'quantity'))
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed!');
    }

    // تفريغ السلة
    public function clear(Request $request)
    {
        $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity'));
        session()->forget('cart');

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Cart cleared successfully!',
                'cart_count' => 0,
                'subtotal' => 0
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }

    // حساب المجموع الكلي
    private function calculateTotal($cartItems)
    {
        return array_reduce($cartItems, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }
}