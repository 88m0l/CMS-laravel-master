<?php

namespace App\View\Composers;

use App\Models\Comment;
use Illuminate\View\View;

class CommentComposer
{
    public function compose(View $view)
    {
        $recent_comments = Comment::with('user', 'post')->whereHas('post', function($query){
            $query->published();
        })->take(8)->latest()->get();

        $view->with(compact('recent_comments'));
    }
}