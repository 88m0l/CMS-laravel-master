<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class NotificationController extends Controller implements HasMiddleware
{
    public function index()
    {
        $title = 'جميع الإشعارات';
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('notifications', compact('title', 'notifications'));
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('flash.banner', 'تم تعليم كل الإشعارات كمقرؤه');
    }
    public static function middleware()
    {
        return ['auth'];
    }
}
