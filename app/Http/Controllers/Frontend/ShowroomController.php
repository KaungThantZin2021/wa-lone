<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\Showroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ShowroomController extends Controller
{
    public function index()
    {
        $my_showrooms = Showroom::paginate(5);

        return view('frontend.showroom.index', compact('my_showrooms'));
    }

    public function create()
    {
        return view('frontend.showroom.create');
    }

    public function store(Request $request)
    {
        try {
            $showroom = Showroom::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'email' => $request->email,
                'phone' => $request->phone,
                'bio' => $request->bio,
                'profile_photo' => $request->profile_photo,
                'cover_photo' => $request->cover_photo,
                'type' => $request->type,
                'address' => $request->address,
                'township_id' => $request->township_id,
                'region_id' => $request->region_id,
            ]);

            return redirect()->route('my-showroom')->with('success', 'Successfully created a showroom.');

        } catch (Exception $e) {
            Log::error($e);

            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}
