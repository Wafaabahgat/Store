<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope);

        static::creating(function (Product $product) {
            $product->slug = Str::slug($product->name);
        });
    }

    protected $appends = [
        'image_url',
    ];
    protected $hidden = [
        'image',
    ];

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

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'tag_id' => null,
            'name' => null,
            'status' => 'active',
        ], $filters);

        // if ($filters['name'] ?? false) {
        //     $builder->where('name', 'LIKE', "%{$filters['name']}%");
        // }

        $builder->when($options['name'], function ($builder, $value) {
            $builder->whereHas('translations', function ($builder) use ($value) {
                $builder->where('name', 'LIKE', "%{$value}%");
            });
            // dd($builder->category);
            // $builder->translated->where('name', 'LIKE', "%{$value}%");
        });

        $builder->when($options['status'], function ($builder, $value) {
            $builder->whereStatus($value);
        });

        $builder->when($options['store_id'], function ($builder, $value) {
            $builder->whereStoreId($value);
        });
        $builder->when($options['category_id'], function ($builder, $value) {
            $builder->whereCategoryId($value);
        });

        $builder->when($options['tag_id'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->select(1)
                    ->from('product_tags')
                    ->whereRaw('product_id = products.id')
                    ->whereIn('tag_id', $value);
            });
        });

        // $builder->whereHas('tags', function($builder) use ($value){
        //     $builder->whereIn('id', $value);
        // });
    }
}