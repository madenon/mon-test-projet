<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function markAsSeen(Request $request)
    {
        $notificationId = $request->input('notification_id');

        $notification = Notification::find($notificationId);

        if ($notification) {
            $notification->update(['seen' => true]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Notification not found.']);
    }

    public function delete(Request $request)
    {
        $notificationId = $request->input('notification_id');

        $notification = Notification::find($notificationId);

        if ($notification) {
            $notification->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Notification not found.']);
    }
}
