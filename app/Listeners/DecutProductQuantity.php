<?php

namespace App\Listeners;

use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DecutProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        // Assuming Cart::get() returns the cart items
        $items = Cart::get();

        // Start a database transaction
        DB::beginTransaction();

        try {
            foreach ($items as $item) {
                Product::where('id', '=', $item->product_id)
                    ->update([
                        'quantity' => DB::raw("quantity - {$item->quantity}"),
                    ]);
            }

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            // Handle the exception (e.g., log it, rethrow it, etc.)
            throw $e;


            /////////////
            // $order = $event->order;
            // foreach ($order->products as $product) {
            //     $product->decrement('quantity', $product->pivot->quantity);
            // }

        }
    }
}