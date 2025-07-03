<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class UserController extends Controller
{
   
 public function home()
    {
        $products = Product::latest()->take(10)->get(); 
        return view('user.home', compact('products'));
    }
    
}
