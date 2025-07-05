<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class PageController extends Controller
{
    public function menu(Request $request)
    {
        // Start with base query including category relationship
        $query = Product::with(['category' => function ($query) {
            $query->select('id', 'name', 'slug'); // Only select needed columns
        }]);

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by price range
        if ($request->filled('min_price') && is_numeric($request->min_price)) {
            $query->where('price', '>=', (float)$request->min_price);
        }

        if ($request->filled('max_price') && is_numeric($request->max_price)) {
            $query->where('price', '<=', (float)$request->max_price);
        }

        // Filter by category
        $category_id = $request->category;
        if ($category_id && is_numeric($category_id)) {
            $query->where('category_id', $category_id);
        }

        // Paginate results with 9 items per page
        $products = $query->paginate(9)->appends($request->query());

        // Get all categories for filter dropdown
        $categories = Category::select('id', 'name', 'slug', 'description')->get();

        return view('user.menu', [
            'products' => $products,
            'categories' => $categories,
            'category_id' => $category_id
        ]);
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
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('user.cart', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function showProduct(Product $product)
    {
        // Verify the product has a category
        if (!$product->category) {
            return response()->json([
                'error' => 'Category not found for this product'
            ], 404);
        }

        // Verify the image exists
        $imagePath = public_path('assets/images/' . $product->image);
        $imageExists = file_exists($imagePath);

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'description' => $product->description,
            'image' => $product->image,
            'image_exists' => $imageExists,
            'category' => [
                'name' => $product->category->name,
                'slug' => $product->category->slug ?? 'slug'
            ]
        ]);
    }
}
