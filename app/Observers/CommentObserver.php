<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\CommentNotification;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        $postAuthor = $comment->post->user;

        if(auth()->id() !== $postAuthor->id)
        {
            \Illuminate\Support\Facades\Notification::sendNow($postAuthor, new CommentNotification($comment));
        }
    }

    /**
     * Handle the Comment "updated" event.
     */
    public function updated(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "deleted" event.
     */
    public function deleted(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "restored" event.
     */
    public function restored(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     */
    public function forceDeleted(Comment $comment): void
    {
        //
    }
}
