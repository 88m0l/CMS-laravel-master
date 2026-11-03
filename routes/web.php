<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::resource('post', PostController::class)->except('index');

Route::get('/search', [PostController::class, 'search'])->name('post.search');

Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('category');

Route::resource('comment', CommentController::class);

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.read');

Route::get('/user/{user}', [UserController::class, 'getPosts'])->name('user_posts');

Route::get('/user/{user}/comments', [UserController::class, 'getComments'])->name('user_comments');

Route::get('/p/{page:slug}', [PageController::class, 'show'])->name('page.show');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function(){
    Route::get('/', Admin\HomeController::class)->name('admin.home');
    Route::resource('category', CategoryController::class)->except('show', 'create');
    Route::get('post', Admin\PostController::class)->name('admin.post.index');
    Route::resource('role', RoleController::class)->except('create');
    Route::resource('user', UserController::class)->except('show', 'create');
    Route::resource('page', PageController::class)->except('show');
});