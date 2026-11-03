<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Models\Comment;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class CommentController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vaildData = $request->validate([
            'content' => 'required',
            'post_id' => Rule::exists('posts', 'id')->where(function ($query){
                $query->where('status', PostStatus::Published);
            }),
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $vaildData['user_id'] = $request->user()->id;
        Comment::create($vaildData);

        return back()->with('flash.banner', 'تم إضافة التعليق بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('flash.banner', 'تم حذف التعليق بنجاح');
    }

    public static function middleware()
    {
        return ['auth'];
    }
}
