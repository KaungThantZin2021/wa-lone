<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ShowroomController extends Controller
{
    public function index()
    {
        return view('frontend.showroom.index');
    }

    public function create()
    {
        return view('frontend.showroom.create');
    }
}
