<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    // protected $fillable=[];

    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required', 'string', 'min:3', 'max:150',
                Rule::unique('categories', 'name')->ignore($id),
                'filter:php,laravel' //provider Validate
            ],
            'parent_id' => [
                'nullable', 'int', 'exists:categories,id'
            ],
            'img' => [
                'image', 'max:1048576',
            ],
            'status' => 'in:active,disactive'
        ];
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['name'] ?? false, function ($builder, $value) {
            $builder->where('categories.name', 'LIKE', "%{$value}%");
        });

        $builder->when($filters['status'] ?? false, function ($builder, $value) {
            $builder->where('categories.status', '=', $value);
        });

        // if ($filters['name'] ?? false) {
        //     $builder->where('name', 'LIKE', "%{$filters['name']}%");
        // }
        // if ($filters['status'] ?? false) {
        //     $builder->where('status', '=', $filters['name']);
        // }
    }
}