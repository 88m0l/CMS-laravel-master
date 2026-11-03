<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PostController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::published()
            ->with(['user', 'category'])
            ->withCount('comments')->latest()->paginate(10);
        $title = "جميع المنشورات";
        return view('home', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Post::class);
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Post::class);
        $validData = $request->validate([
                'title'=>'required',
                'content' => 'required',
                'category_id' => 'required|exists:categories,id',
                'image_path' => 'nullable|image',
        ]);

        $validData['slug'] = unique_slug($validData['title'], Post::class);
        $validData['status'] = PostStatus::Pending;

        if($request->hasFile('image_path')){
            $file = $request->file('image_path');
            $filename = time() . $file->getClientOriginalName();
            Storage::disk('public')->putFileAs('images', $file, $filename);
            $validData['image_path'] = $filename;
        }
        
        $request->user()->posts()->create($validData);
        
        return to_route('home')->with('flash.banner', 'تم إضافة المنشور بنجاح، سيظهر بعد أن يوافق عليه المسؤول');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();
        $comments = $post->comments->sortByDesc('created_at');
        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);
        $categories = Category::all();
        $admin = request()->input('admin', false) && auth()->user()->can('access-panel');
        return view('posts.edit', compact('post', 'categories', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);
        $admin = request()->input('admin', false) && auth()->user()->can('access-panel');
        $rules = [
                'title'=>'required',
                'content' => 'required',
                'category_id' => 'required|exists:categories,id',
                'image_path' => 'nullable|image',
        ];
        if($admin){
            $rules['slug'] = [
                'sometimes',
                Rule::unique('posts', 'slug')->ignore($post->id)
            ];

            $rules['status'] = [
                'sometimes',
                Rule::in(array_column(PostStatus::cases(), 'value'))
            ];
        }
        $validData = $request->validate($rules);

        if(!$admin)
        {
            $validData['slug'] = unique_slug($validData['title'], Post::class);
        }

        if($request->hasFile('image_path')){
            $file = $request->file('image_path');
            $filename = time() . $file->getClientOriginalName();
            Storage::disk('public')->putFileAs('images', $file, $filename);
            $validData['image_path'] = $filename;
        }
        
        $post->update($validData);
        
        return to_route('home')->with('flash.banner', 'تم تعديل المنشور بنجاح');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        $post->delete();
        return back()->with('flash.banner', 'تم حذف المنشور بنجاح');
    }

    public function search(Request $request)
    {
        $keyword = trim($request->get('keyword'));
        $posts = Post::published()
            ->where('content', 'LIKE', '%' . $keyword . '%')
            ->orWhere('title', 'LIKE', '%' . $keyword . '%')
            ->paginate(10);
        $title = "نتائج البحث عن: " . $keyword;

        return view('home', compact('title', 'posts'));
    }

    public static function middleware()
    {
        return [
            new Middleware('auth', ['create', 'store', 'edit', 'update', 'destroy']),
            new Middleware('verified', ['create', 'store']),
        ];
    }
}
