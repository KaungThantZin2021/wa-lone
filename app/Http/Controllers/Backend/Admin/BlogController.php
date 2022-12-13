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
        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.blog.index');
    }
}
