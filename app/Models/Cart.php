<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $guarded = [];

    public static function cart_validate()
    {
        return [
            'product_id' => ['required', 'int', 'exists:product_id',],
            'quantity' => ['int', 'nullable', 'min:1'],
        ];
    }

    public static function booted()
    {
        static::observe(CartObserver::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => "Anonymous"
        ]);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }
}