<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public \App\Models\Comment $comment)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase()
    {
        $comment = $this->comment;
        $message = $comment->user->name . ' وضع تعلقاً على منشورك <br/><b>' . $comment->post->title . '</b>';
        return [
            'content' => $message,
            'icon' => $comment->user->profile_photo_url,
            'url' => route('post.show', $comment->post->slug)
        ];
    }

    public function toBroadcast(User $notifiable)
    {
        $notifications = $notifiable->unreadNotifications()->latest()->limit(3)->get(['data', 'created_at']);
        $notifications = $notifications->map(function($notification){
            $data = $notification->data;
            $data['created_at'] = $notification->created_at->diffForHumans();
            return $data;
        });

        $unread_notifications_count = $notifiable->unreadNotifications()->count();

        $data = compact('notifications', 'unread_notifications_count');
        $broadcastMessage = new BroadcastMessage($data);
        $broadcastMessage->onConnection('sync');
        return  $broadcastMessage;
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
