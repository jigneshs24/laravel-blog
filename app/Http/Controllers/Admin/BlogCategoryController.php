<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::latest()->paginate(30);

        return view('admin.blog.category.view', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:1,2',
        ]);

        BlogCategory::create([
            'admin_id' => auth()->id(),
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('admin-blog-category-view')->with(['success' => 'Blog Category Created Successfully']);
    }

    public function update(Request $request)
    {
        $category = BlogCategory::find($request->id);

        if (!$category) {
            return redirect()->back()->with(['error' => 'Blog Category Not Found.']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:1,2',
        ]);

        $category->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('admin-blog-category-view')->with(['success' => 'Blog Category Updated Successfully']);
    }

    public function destroy($id)
    {
        $category = BlogCategory::find($id);

        if (!$category) {
            return redirect()->back()->with(['error' => 'Blog Category Not Found.']);
        }

        $category->delete();

        return redirect()->route('admin-blog-category-view')->with(['success' => 'Blog Category Deleted Successfully']);
    }
}
