<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function category()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('backend.category.index', compact('categories'));
    }

    public function categoryModify(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('categories', 'name')->ignore($request->id),
            ],
        ]);
        $category = Category::findOrNew($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->icon = $request->icon;
        $category->save();
        if ($request->id) {
            return redirect()->back()->with('success', 'Category updated successfully');
        }
        return redirect()->back()->with('success', 'Category added successfully');
    }

    public function categoryDelete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');
    }

    public function subCategory()
    {
        $categories = Category::whereNull('parent_id')->get();
        $subCategories = Category::whereNotNull('parent_id')->paginate(10);
        return view('backend.category.sub-category', compact('categories', 'subCategories'));
    }

    public function subCategoryModify(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('categories', 'name')->ignore($request->id),
            ],
            'category_id' => 'required',
        ]);
        $category = Category::findOrNew($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_id = $request->category_id;
        $category->icon = $request->icon;
        $category->save();
        if ($request->id) {
            return redirect()->back()->with('success', 'Sub Category updated successfully');
        }
        return redirect()->back()->with('success', 'Sub Category added successfully');
    }
}
