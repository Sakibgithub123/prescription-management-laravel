<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead(Request $request){
        Auth::user()->unreadNotifications->markAsRead();
        // return response()->json([
        //     'message'=>'All notification mark as read',
        //     'status'=>true,
        // ]);
        return response()->noContent(); // Sends a 204 No Content status with no body
    }
}
