<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(10);
        return view('backend.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('backend.blogs.create');
    }

    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->save();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('backend.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->save();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }


    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully');
    }
}
