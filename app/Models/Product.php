<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope);
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')
            ->withDefault();
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id')
            ->withDefault();
    }
    
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id'
        );
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', '=', 'active');
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://www.bevi.com/static/files/0/ecommerce-default-product.png';
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }

    public function getSalePriceAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }

        return round(($this->compare_price / $this->price * 100) - 100, 1);
    }

}