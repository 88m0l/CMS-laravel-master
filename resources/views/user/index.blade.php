@extends('layouts.main')

@php
$isComments = Route::current()->getName() === 'user_comments';
$pagination = $isComments ? $comments : $posts;
@endphp

@section('content')
<div class="container text-muted mt-2">
    <div class="mb-4">
        <img src="{{ $user->profile_photo_url }}" width="150px" class="rounded-full mx-auto">
        <h2 class="text-center mt-1">{{ $user->name }}</h2>
    </div>

    <div class="row p-3">
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a @class(['nav-link', 'active' => !$isComments]) href="{{ route('user_posts', $user) }}">المنشورات</a>
            </li>
            <li class="nav-item">
                <a @class(['nav-link', 'active' => $isComments]) href="{{ route('user_comments', $user) }}">التعليقات</a>
            </li>
        </ul>
        @if ($isComments)
        @include('user.comments')
        @else
        @include('user.posts')
        @endif

    </div>

    <!-- Pagination -->
    <ul class="pagination justify-content-center mb-4">
        {{ $pagination->links() }}
    </ul>
</div>
@endsection