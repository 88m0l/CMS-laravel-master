<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

class CategoryComposer
{
    public function compose(View $view)
    {
        $view->with('categories', Category::withCount(['posts' => function($query){
            $query->published();
        }])->get())->with('posts_count', Post::published()->count());
    }
}