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
                'keywords' => 'required',
                'image' => 'required'
            ]);

            $disk = \Storage::disk('spaces');
            $image = (string)\Str::uuid() . "." . $request->file('image')->getClientOriginalExtension();

            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                $disk->delete(env('BLOG_IMAGE_PATH') . $request->image);
                $disk->put(env('BLOG_IMAGE_PATH') . $image, file_get_contents($request->file('image')->path()));

            } else
                return redirect()->back()->with(['error' => 'Blog Banner Image Is Corrupted']);

            Blog::create([
                'admin_id' => \Session::get('admin')->id,
                'title' => $request->title,
                'category_id' => $request->category_id,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'keywords' => $request->keywords,
                'banner_image' => $image
            ]);

            return redirect()->route('admin-blog-view')->with(['success' => 'Blog Uploaded SuccessFully.']);

        }

        return view('admin.blog.create', [
            'categories' => $categories
        ]);

    }

    public function update(Request $request, $id)
    {
        if (!$blog = Blog::with(['category'])->whereId($id)->first())
            return redirect()->back()->with(['error' => 'Blog not found']);

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'title' => 'required',
                'category_id' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'keywords' => 'required',
            ]);

            if ($request->banner_image) {
                if ($request->hasFile('banner_image') && $request->file('banner_image')->isValid()) {
                    $disk = \Storage::disk('spaces');
                    $banner_image = (string)\Str::uuid() . "." . $request->file('banner_image')->getClientOriginalExtension();
                    $disk->delete(env('BLOG_IMAGE_PATH') . $request->banner_image);
                    $disk->put(env('BLOG_IMAGE_PATH') . $banner_image, file_get_contents($request->file('banner_image')->path()));
                    $blog->banner_image = $banner_image;
                }
            }

            $blog->title = $request->title;
            $blog->category_id = $request->category_id;
            $blog->short_description = $request->short_description;
            $blog->description = $request->description;
            $blog->status = $request->status;
            $blog->keywords = $request->keywords;
            $blog->save();

            return redirect()->route('admin-blog-view')->with(['success' => 'Blog has been updated..!!']);
        }

        return view('admin.blog.edit', [
            'blog' => $blog,
            'categories' => BlogCategory::active()->latest()->get()
        ]);
    }
}
