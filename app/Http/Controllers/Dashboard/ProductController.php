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
        Product::query()->update(['quantity' => 100]);
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

        //dd($request->post('tags'));

        $tags = explode(',', $request->post('tags')) ?? []; //explode => tranform string to array

        //dd($tags);

        $tag_ids = [];
        $saved_tag = Tag::all();

        foreach ($tags as $item) {
            //dd($item);
            $slug = Str::slug($item);
            $tag = $saved_tag->where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $item,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids); // tags() => Relations

        return redirect()
            ->route('dashboard.singleproduct.index')
            ->with('success', 'Product Updated!!');
    }

    public function destroy(string $id)
    {
        //
    }
}