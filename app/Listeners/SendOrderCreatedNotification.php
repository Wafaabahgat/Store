<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;


class SendOrderCreatedNotification
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
    public function handle(object $event): void
    {
        $order = $event->order;
        $user = User::where('store_id', $order->store_id)->first();
        
        //$notifiable (user) in OrderCreatedNotification
        if ($user) {
            $user->notify(new OrderCreatedNotification($order));
        } else {
            Log::error("No user found for store_id: {$order->store_id}");
        }

        ////////////////////many users////////////////////
        //     $users = User::where('store_id', $order->store_id)->get();
        //     Notification::send($users, new OrderCreatedNotification($order));
    }
}