@extends('layouts.main')
@section('content')
<h1 class="h4 my-4">
    {{ $title }}
</h1>
<div class="row">
    <div class="col-8">
        @includeWhen(count($posts) == 0, 'alerts.empty', ['msg' => 'لا توجد منشورات'])
        @foreach ( $posts as $post)
        <div class="card mb-3 bg-white text-secondary">
            <div class="card-body">
                <a class="text-decoration-none text-secondary d-flex align-items-center column-gap-2" href="{{ route('user_posts', $post->user) }}">
                    <img src="{{ $post->user->profile_photo_url }}" width="50px" height="50px" class="rounded-full" />
                    <p class="h-100 mb-0 fw-bold">{{ $post->user->name }}</p>
                </a>
                <div class="row mt-2">
                    <div class="col">
                        <i class="far fa-clock"></i>
                        <span> {{ $post->created_at->diffForHumans() }} </span>
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-align-justify"></i>
                        <span>{{$post->category->title}}</span>
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-comment"></i>
                        <span>{{$post->comments()->count()}} تعليقات</span>
                    </div>
                </div>
                <div class="row">
                    <h4 class="my-2">
                        <a href="{{ route('post.show', $post->slug) }}" class="text-reset text-decoration-none">{{ $post->title }}</a>
                    </h4>
                    <p class="card-text mb-2">{{ Str::limit(strip_tags($post->content), 200) }}</p>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
            {{ $posts->links() }}
        </ul>
    </div>
    @include('partials.sidebar')
</div>
@endsection