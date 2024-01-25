<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::orderBy('category', 'asc')
            ->get();

        return view('category.index', compact('categories'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'category' => ['required']
        ]);

        Category::create($validated);
        
        return back()->with('message_success', 'Category successfully added.');
    }

    public function edit($id) {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $validated = $request->validate([
            'category' => ['required']
        ]);

        $category->update($validated);

        return back()->with('message_success', 'Category successfully updated.');
    }
}
