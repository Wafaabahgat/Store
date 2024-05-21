<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

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
}