<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(
            Product::class
            // 'product_tag',
            // 'product_id',
            // 'tag_id',
            // 'id',
            // 'id'
        );
    }
}