<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        return view('backend.admin.blogs.index');
    }

    public function create()
    {
        return view('backend.admin.blogs.create');
    }

    public function store(Request $request)
    {
        $file_name = time() . '_' .$request->file('thumbnail')->getClientOriginalName();

        $request->thumbnail->move(public_path('thumbnails'), $file_name);

        Blog::create([
            'title' => $request->title,
            'thumbnail' => $file_name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.blog.index');
    }
}
