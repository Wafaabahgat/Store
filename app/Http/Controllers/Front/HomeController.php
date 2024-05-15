<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //  $products = Product::with('category')->active()->latest()->limit(8)->get();
        //  return view('front.home', compact('products'));

        $products30 = Product::withoutGlobalScope('store')->with('category')->active()->limit(11)->get();
        $products60 = Product::withoutGlobalScope('store')->with('category')->active()->limit(11)->get();
        $products100 = Product::withoutGlobalScope('store')->with('category')->active()->limit(11)->get();
        return view('front.home', compact('products30', 'products60', 'products100'));
    }

    // public function products(Request $request)
    // {
    // $products = Product::with('category')->filter($request->query())->latest()->paginate();
    // return view('front.products.index', compact('products'));
    // }
}