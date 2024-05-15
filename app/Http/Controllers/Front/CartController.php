<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    public function index(CartRepository $cart)
    {
        return view("front.cart", [
            "cart" => $cart
        ]);
    }

    public function store(Request $request, CartRepository $cart)
    {
        $request->validate(Cart::cart_validate());

        $product = Product::findOrFail(
            $request->post('product_id')
        );
        $cart->add(
            $product,
            $request->post('quantity')
        );
    }

    public function update(Request $request, CartRepository $cart)
    {
        $request->validate(Cart::cart_validate());

        $product = Product::findOrFail(
            $request->post('product_id')
        );
        $cart->update(
            $product,
            $request->post('quantity')
        );
    }

    public function destroy(CartRepository $cart, string $id)
    {
        $cart->delete($id);
    }
}