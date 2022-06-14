<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //markAsRead
    public function markAsRead(Request $request)
    {
        $notification = auth()->user()->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }
}
