<?php

namespace App\Repositories\Cart;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepository implements CartRepository
{
    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get(): Collection
    {
        // if (!$this->items->count()) {
        // # code...
        // $this->items = Cart::with('product')
        // ->where('cookie_id', '=', $this->getCookieId())
        // ->get();
        // }
        // return $this->items;

        return Cart::with('product')
            ->where('cookie_id', '=', $this->getCookieId())
            ->get();
    }

    public function add(Product $product, $quantity = 1)
    {
        $item = Cart::where('product_id', $product->id)
            ->where('cookie_id', '=', $this->getCookieId())
            ->first();

        if (!$item) {
            $cart =  Cart::create([
                'cookie_id' => $this->getCookieId(),
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);

            $this->get()->push($cart);
            return $cart;
        }

        return $item->increment('quantity', $quantity);
    }

    public function update(Product $product, $quantity)
    {
        Cart::where('product_id', '=', $product->id)
            ->where('cookie_id', '=', $this->getCookieId())
            ->update([
                'quantity' => $quantity,
            ]);
    }

    public function delete($id)
    {
        Cart::where('id', '=', $id)
            ->where('cookie_id', '=', $this->getCookieId())
            ->delete();
    }

    public function empty()
    {
        Cart::where('cookie_id', '=', $this->getCookieId())->destroy();
        //Cart::query()->delete();
    }

    public function total()
    {
        return (float) Cart::where('cookie_id', '=', $this->getCookieId())->join(
            'products',
            'products.id',
            '=',
            'carts.product_id'
        )->selectRaw(
            'SUM(products.price * carts.quantity) as total'
        )->value('total');

        // return $this->get()->sum(function ($item) {
        //     // dd($item);
        //     return $item->quantity * $item->product->price;
        // });
    }

    protected function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue(
                'cart_id',
                $cookie_id,
                30 * 24 * 60
                // Carbon::now()->addDays(30) 
            );
        }
        return $cookie_id;
    }
}