<?php

namespace App\View\Composers;

use Illuminate\View\View;

class BellComposer
{
    public function compose(View $view)
    {
        $notifications = auth()->user()->unreadNotifications()->latest()->limit(3)->get(['data', 'created_at']);
        $notifications = $notifications->map(function($notification){
            $data = $notification->data;
            $data['created_at'] = $notification->created_at->diffForHumans();
            return $data;
        });

        $unread_notifications_count = auth()->user()->unreadNotifications()->count();
        $view->with(compact('notifications'))->with(compact('unread_notifications_count'));
    }
}