<?php
namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('id', 'DESC')->get();

        return view('frontend.blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('frontend.blogs.show', compact('blog'));
    }
}
