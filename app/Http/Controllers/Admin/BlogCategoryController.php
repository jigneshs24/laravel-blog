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
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'name' => 'required',
                'status' => 'required',
//                'description' => 'required'
            ]);

            BlogCategory::create([
                'admin_id' => \Session::get('admin')->id,
                'name' => $request->name,
                'status' => $request->status,
//                'description' => $request->description,
            ]);

            return redirect()->route('admin-blog-category-view')->with(['success' => 'Blog Category Created Successfully']);

        }
    }

    public function update(Request $request)
    {
        if (!$category = BlogCategory::whereId($request->id)->first())
            return redirect()->back()->with(['error' => 'Blog Category Not Found.']);

        if ($request->isMethod('post')) {

            $request->validate([
                'name' => 'required',
                'status' => 'required',
//                'description' => 'required'
            ]);

            $category->name = $request->name;
            $category->status = $request->status;
//            $category->description = $request->description;
            $category->save();

            return redirect()->route('admin-blog-category-view')->with(['success' => 'Blog Category Updated Successfully']);

        }
    }

    public function destroy($id)
    {
        // Find the category by ID
        $category = BlogCategory::find($id);

        if (!$category) {
            return redirect()->back()->with(['error' => 'Blog Category Not Found.']);
        }

        // Delete the category
        $category->delete();

        return redirect()->route('admin-blog-category-view')->with(['success' => 'Blog Category Deleted Successfully']);
    }

}
