<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);
        Category::create(['name' => $request->name]);

        return back()->with('success', 'Категория добавлена!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:100']);
        $category->update(['name' => $request->name]);

        return back()->with('success', 'Категория обновлена!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Категория удалена!');
    }
}
