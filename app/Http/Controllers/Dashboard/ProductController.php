<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'store'])->paginate(20);
        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        //dd($tags);
        return view('dashboard.products.edit', compact('product', 'tags'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->except('tags'));
        
        dd($request->post('tags'));
        
        $tags =  json_decode($request->post('tags'));
        $tag_ids = [];
        $saved_tag = Tag::all();

        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = $saved_tag->where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);

        return redirect()
            ->route('dashboard.products.index')
            ->with('success', 'Product Updated!!');
    }

    public function destroy(string $id)
    {
        //
    }
}