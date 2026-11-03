<?php

namespace App\Providers;

use App\Models\Page;
use App\View\Composers\BellComposer;
use App\View\Composers\CategoryComposer;
use App\View\Composers\CommentComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        $path = storage_path('app/public/images');
        if (!File::exists($path)){
            File::makeDirectory($path);
        }

        View::composer('partials.sidebar', CategoryComposer::class);
        View::composer('partials.sidebar', CommentComposer::class);
        View::composer('partials.notifications-bell', BellComposer::class);

        View::composer('navigation-menu', function(\Illuminate\View\View $view){
            $pages = Page::all();

            $view->with(compact('pages'));
        });

        Gate::define('access-panel', function($user){
            return $user->role->hasPermission('access-panel');
        });

        Blade::if('admin', function(){
            return auth()->check() && auth()->user()->can('access-panel');
        });

    }
}
