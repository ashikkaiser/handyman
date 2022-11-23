<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $blogs = Testimonial::paginate(10);
        return view('backend.testimonial.index', compact('blogs'));
    }

    public function create()
    {
        return view('backend.testimonial.create');
    }

    public function store(Request $request)
    {
        $blog = new Testimonial();
        $blog->title = "hello";
        $blog->description = $request->description;
        $blog->author = $request->author;
        $blog->image = $request->image;
        $blog->save();
        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $blog = Testimonial::find($id);
        return view('backend.testimonial.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Testimonial::find($id);
        $blog->title = "hello";
        $blog->description = $request->description;
        $blog->author = $request->author;
        $blog->image = $request->image;
        $blog->save();
        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial updated successfully');
    }


    public function destroy($id)
    {
        $blog = Testimonial::find($id);
        $blog->delete();
        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial deleted successfully');
    }
}
