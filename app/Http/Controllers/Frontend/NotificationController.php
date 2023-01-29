<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ReceiverNotificationToken;

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

    public function subscribe(Request $request)
    {
        try {
            if (!$request->ajax()) throw new Exception('Invalid Request!');

            if (!$request->player_id) throw new Exception('Something Wrong!');

            if (!config('services.default_notification_service_provider')) throw new Exception('Notification Service Unavailable.');

            $auth_user = auth()->guard('web')->user();

            ReceiverNotificationToken::firstOrCreate(
                ['receivable_id'=> $auth_user->id],
                [
                    'receivable_id' => $auth_user->id,
                    'receivable_type' => get_class($auth_user),
                    'token' => $request->player_id,
                    'service_provider' => config('services.default_notification_service_provider'),
                    'platform' => ReceiverNotificationToken::WEBSITE,
                    'source_client' => $request->server('HTTP_USER_AGENT'),
                    'ip' => $request->ip(),
                    'expire_at' => Carbon::now()->addYears(2)->format('Y-m-d H:i:s'),
                ]
            );

            return successMessage('Successfully Subscribed.');
        } catch (Exception $e) {
            Log::error($e);
            return failMessage($e->getMessage());
        }
    }
}
