<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{

    public function index()
    {
        $request = request();
        $categories = Category::leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])
            ->filter($request->query())
            ->paginate(3);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::all();

        $categories = new Category();
        return view('dashboard.categories.create', compact('parents', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate(Category::rules());
        // dd($request);
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);


        // Mass Assignment
        $categories = Category::create($data);
        // PRG
        return Redirect::route('dashboard.categories.index')
            ->with(['success' => 'تم الاضافة بنجاح']);

        // return redirect()->route('categories.index')
        //     ->with(['success' => 'تم الاضافة بنجاح']);

        // $categories = new Category($request->all());

        // $categories = new Category([
        //     'name' => $request['name'],
        //     'description' => $request['description'],
        //     'parent_id' => $request['parent_id'],
        //     'image' => $request['image'],
        //     'status' => $request['status'],
        // ]);
        // $categories->save();
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $categories = Category::findOrFail($id);
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })->get();
        return view(
            'dashboard.categories.edit',
            compact('categories', 'parents')
        )
            ->with(['success' => 'تم الاضافة بنجاح']);
    }

    public function update(Request $request, string $id)
    {

        $request->validate(Category::rules($id));
        $categories = Category::findOrFail($id);

        $old_image = $categories->image;

        $data = $request->except('image');
        $new_img = $this->uploadImage($request);

        if ($new_img) {
            $data['image'] = $new_img;
        }


        $categories->update($data);

        if ($old_image && $new_img) {
            Storage::disk('public')->delete($old_image);
        }
        // PRG
        return Redirect::route('dashboard.categories.index')
            ->with(['success' => 'تم التعديل بنجاح']);
    }

    public function destroy(string $id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        //categories::destroy($id);

        return Redirect::route('dashboard.categories.index')
            ->with(['delete' => 'تم الحذف بنجاح']);
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);
        return $path;
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate(3);
        return view('dashboard.categories.trash', compact('categories'));
    }
    public function restore(Request $request, $id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->restore();
        return Redirect::route('dashboard.categories.trash')
            ->with(['susses' => 'category restore']);
    }
    public function forceDelete($id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->forceDelete();

        if ($categories->image) {
            Storage::disk('public')->delete($categories->image);
        }

        return Redirect::route('dashboard.categories.trash')
            ->with(['susses' => 'category Delete!']);
    }
}