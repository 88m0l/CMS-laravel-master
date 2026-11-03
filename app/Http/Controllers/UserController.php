<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
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
        Gate::authorize('create', User::class);
        $validData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'role_id' => 'required|exists:roles,id'
        ]);
        User::create($validData);

        return back()->with('flash.banner', 'تم إضافة المستخدم بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Gate::authorize('update', $user);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('update', $user);
        $validData = $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($user->id)
            ],
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->update($validData);
        return to_route('user.index')->with('flash.banner', 'تم تعديل بيانات المستخدم بنجاح');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete', $user);
        $user->delete();
        return to_route('user.index')->with('flash.banner', 'تم حذف المستخدم بنجاح');
    }

    public function getPosts(User $user)
    {
        $posts = [];
        if(auth()->check() && $user->id == auth()->id())
        {
            $posts = $user->posts()->latest()->paginate(10);
        }else{
            $posts = $user->posts()->published()->latest()->paginate(10);
        }

        return view('user.index', compact('user', 'posts'));
    }

    public function getComments(User $user)
    {
        $comments = $user->comments()->latest()->paginate(10);

        return view('user.index', compact('user', 'comments'));
    }
}
