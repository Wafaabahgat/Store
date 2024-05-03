<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        return view('dashboard.categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Request Merge
        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);

        // Mass Assignment
        $category = Category::create($request->all());
        // PRG
        return Redirect::route('dashboard.categories.index')
            ->with(['success' => 'تم الاضافة بنجاح']);

        // return redirect()->route('categories.index')
        //     ->with(['success' => 'تم الاضافة بنجاح']);

        // $category = new Category($request->all());

        // $category = new Category([
        //     'name' => $request['name'],
        //     'description' => $request['description'],
        //     'parent_id' => $request['parent_id'],
        //     'image' => $request['image'],
        //     'status' => $request['status'],
        // ]);
        // $category->save();
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $categories = Category::findOrFail($id);
        $parents = Category::where('id', '<>', $id)->get();
        return view('dashboard.categories.edit', compact('categories', 'parents'))->with(['success' => 'تم الاضافة بنجاح']);

        // try {
        //     $categories = Category::findOrFail($id);
        // } catch (Exception $e) {
        //     return view('dashboard.categories.edit', compact('categories', 'parents'))->with(['success' => 'تم الاضافة بنجاح'])
        //         ->with(['success' => 'غير موجود']);;
        // }
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        // PRG
        return Redirect::route('dashboard.categories.index')
            ->with(['success' => 'تم التعديل بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete()
        // Category::destroy($id);
        return Redirect::route('categories.index')
            ->with(['delete' => 'تم الحذف بنجاح']);

        //return redirect()->route('categories.index');
    }
}