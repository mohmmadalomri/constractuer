<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
class NotificationController extends Controller
{
    public function getNotifications()
    {
        $user = auth()->user();
        $user = User::find($user->id);
        if ($user) {
            foreach ($user->unreadNotifications as $notification) {
                $userCreate = $notification->data['user_create'];
                // Process the $userCreate variable or perform any desired operations here
                return response()->json([
                    'userCreate' => $userCreate,
                    'message' => 'Notifications retrieved successfully.',
                ]);
            }

        }

        return response()->json([
            'status' => false,
            'message' => 'User not authenticated.',
        ]);
    }
    public function Markallread()
    {
        $user = auth()->user();
//        return $user;
        if ($user) {
            $userModel = User::find($user->id);
            foreach ($userModel->unreadNotifications as $notification) {
                $notification->markAsRead();
            }
            return response()->json([
                'status' => true,
                'message' => 'All notifications marked as read',
            ]);

        }

        return response()->json([
            'status' => false,
            'message' => 'User not authenticated.',
        ]);
    }
}
