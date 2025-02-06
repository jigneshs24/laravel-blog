<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {


        return view('admin.blog.view', [
            'blogs' => Blog::orderBy('id', 'desc')->get()
        ]);
    }

    public function create(Request $request)
    {

        $categories = BlogCategory::active()->latest()->get();

        if ($request->isMethod('post')) {

            $request->validate([
                'title' => 'required',
                'category_id' => 'required',
                'short_description' => 'required',
                'description' => 'required',
//                'image' => 'required'
            ]);

//            $disk = \Storage::disk('memory');
//            $image = (string)\Str::uuid() . "." . $request->file('image')->getClientOriginalExtension();
//
//            if ($request->hasFile('image') && $request->file('image')->isValid()) {
//
//                $disk->delete(env('BLOG_IMAGE_PATH') . $request->image);
//                $disk->put(env('BLOG_IMAGE_PATH') . $image, file_get_contents($request->file('image')->path()));
//
//            } else
//                return redirect()->back()->with(['error' => 'Blog Banner Image Is Corrupted']);

            Blog::create([
                'admin_id' => \Session::get('admin')->id,
                'title' => $request->title,
                'category_id' => $request->category_id,
                'short_description' => $request->short_description,
                'description' => $request->description,
//                'banner_image' => $image
            ]);

            return redirect()->route('admin-blog-view')->with(['success' => 'Blog Uploaded SuccessFully.']);

        }

        return view('admin.blog.create', [
            'categories' => $categories
        ]);

    }

    public function update(Request $request)
    {
        if (!$blog = Blog::with(['category'])->where('id', $request->id)) {
            return redirect()->back()->with(['error' => 'Blog not found']);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:blog_categories,id',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:1,2',
        ]);

//        if ($request->hasFile('banner_image') && $request->file('banner_image')->isValid()) {
//            $disk = \Storage::disk('spaces');
//            $banner_image = (string)\Str::uuid() . '.' . $request->file('banner_image')->getClientOriginalExtension();
//            $disk->delete(env('BLOG_IMAGE_PATH') . $blog->banner_image);
//            $disk->put(env('BLOG_IMAGE_PATH') . $banner_image, file_get_contents($request->file('banner_image')->path()));
//            $blog->banner_image = $banner_image;
//        }

        $blog->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin-blog-view')->with(['success' => 'Blog has been updated successfully!']);
    }
}
