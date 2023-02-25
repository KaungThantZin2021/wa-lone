<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'DESC')->limit(6)->get();
        $sliders = Slider::get();

        return view('frontend.home', compact('blogs', 'sliders'));
    }


    public function profile()
    {
        return view('frontend.profile');
    }
}
