<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
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

    public function index()
    {
        $notifications = auth()->guard('web')->user()->notifications()->paginate(2);

        return view('frontend.notifications.index', compact('notifications'));
    }

    public function show($id)
    {
        $notification = auth()->guard('web')->user()->notifications->find($id);

        if (is_null($notification->read_at)) {
            $notification->update([
                'read_at' => Carbon::parse()->now()->format('Y-m-d H:i:s')
            ]);
        }

        return view('frontend.notifications.show', compact('notification'));
    }

    public function subscribe()
    {

    }
}
