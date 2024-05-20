<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{

    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view("front.cart", [
            "cart" => $this->cart
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(Cart::cart_validate());

        $product = Product::findOrFail(
            $request->post('product_id')
        );
        $this->cart->add(
            $product,
            $request->post('quantity')
        );

        return redirect()
            ->route('cart.index')
            ->with('success', 'Product Add To Cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate(Cart::cart_validate());
        $this->cart->update(
            $id,
            $request->post('quantity')
        );
        return [
            'message' => 'Item Updated!'
        ];
    }

    public function destroy(string $id)
    {
        $this->cart->delete($id);
        return [
            'message' => 'Item Deleted!'
        ];
    }
}