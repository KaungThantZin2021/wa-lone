<?php
namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = BlogResource::collection(Blog::latest()->paginate(9));
        return view('frontend.blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('frontend.blogs.show', compact('blog'));
    }

    // public function seeMore()
    // {
    //     $blogs = Blog::orderBy('id', 'DESC')->paginate(6);

    //     $blogs = BlogResource::collection($blogs);

    //     return response()->json([
    //         'result' => 1,
    //         'data' => $blogs
    //     ]);
    // }
}
