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
        $bicycle_sliders = Slider::where('type', 'bicycle')->orderBy('created_at', 'DESC')->get();
        $motor_cycle_sliders = Slider::where('type', 'motor_cycle')->orderBy('created_at', 'DESC')->get();
        $car_sliders = Slider::where('type', 'car')->orderBy('created_at', 'DESC')->get();

        return view('frontend.home', compact('blogs', 'bicycle_sliders', 'motor_cycle_sliders', 'car_sliders'));
    }


    public function profile()
    {
        return view('frontend.profile');
    }
}
