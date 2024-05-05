<?php

namespace App\Models;

use App\Rules\Filter;
use App\Rules\Uppercase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    
    // protected $fillable=[];

    public static function rules($id = 0)
    {
        return [
            "name" => [
                "required", "string", "max:255", "min:3",
                Rule::unique('categories', 'name')->ignore($id),
                'filter:php,laravel' //provider Validate

                // new Filter, // Rules Validate

                // one Validate
                // function ($attribute,  $value,  $fail) {
                //     if (strtolower($value == 'laravel')) {
                //         $fail("The name id forbidden");
                //     }
                // }
                //"unique:categories,name,$id"
            ],
            "parent_id" => ['int', 'exists:categories,id'],
            "status" => ['int:active,archived'],

        ];
    }
}