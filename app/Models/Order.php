<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notifiable;


class Order extends Model
{
    use HasFactory, Notifiable;



    protected $guarded = [];

    public function store()
    {
        return $this->belongsTo(Store::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            "name" => "Guest Customer",
        ]);
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'order_items',
            'order_id',
            'product_id',
            'id',
            'id'
        )->using(OrderItem::class) //using => extends Pivot not Model
            ->withPivot(['product_name', 'product_price', 'quantity', 'options']);
    }

    public function addresses()
    {
        return $this->hasMany(
            OrderAddress::class,
        );
    }

    public function billingAddresses()
    {
        return $this->hasOne(
            OrderAddress::class,
            'order_id',
            'id'
        ) //return Model
            ->where('type', 'billing');

        // return $this->addresses()->where('type', 'billing');  //return collection (لو اكتر من address من نوع billing)
    }

    public function shippingAddresses()
    {
        return $this->hasOne(
            OrderAddress::class,
            'order_id',
            'id'
        )
            ->where('type', 'shipping');
    }


    protected static function booted()
    {
        static::creating(function ($order) {
            // 20240001 , 20240002 , 20240003
            $order->number = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber()
    {
        $year = Carbon::now()->year;

        //SELECT MAX (number) FROM orders
        $number = Order::whereYear('created_at', $year)->max('number');
        if ($number) {
            return $number + 1;
        };
        return $year . '0001';
    }
}