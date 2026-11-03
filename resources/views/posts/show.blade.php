@extends('layouts.main')

@push('styles')
<style>
    .post-img {
        max-width: 600px;
        max-height: 600px;
    }
</style>    
@endpush


@section('content')
<h4 class="my-4">{{ $post->title }}</h4>
<div class="row">
    <div class="col-8">
        <div class="bg-white p-5 text-secondary">
            <a href="{{ route('user_posts', $post->user) }}" class="text-decoration-none text-secondary d-flex align-items-center column-gap-2">
                <img src="{{ $post->user->profile_photo_url }}" width="50px" class="rounded-full">
                <p class="mt-2 me-3 mb-0"> <strong>{{ $post->user->name }}</strong> </p>
            </a>
            <div class="row mt-2 mb-4">
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
                    <span>{{$post->comments->count()}} تعليقات</span>
                </div>
            </div>
            @if (file_exists(public_path('/storage/images/' . $post->image_path)))
                <img src="{{ asset('/storage/images/' . $post->image_path) }}" class="mb-4 mx-auto post-img">
            @endif

            <p class="lh-lg"> {!! $post->content !!} </p>
            @auth
            <form action="{{ route('comment.store') }}" method="post" class="mt-5">
                @csrf
                <textarea name="content" rows="5" placeholder="أضف تعليقاً ..." class="form-control @error('content') is-invalid @enderror"></textarea>
                @error('content')
                <span class="invalid-feedback fw-bold">
                    {{ $message ?? '' }}
                </span>
                @enderror

                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <button type="submit" class="btn btn-outline-dark mt-3">
                    تعليق
                </button>
            </form>
            @else
            <div class="alert alert-info mt-3">
                يرجى تسجيل الدخول لكي تستطيع وضع تعليق
            </div>
            @endauth
        </div>
        <div id="comments">
            <h4 class="mb-4">التعليقات</h4>
            @include('comments.all', ['comments' => $comments, 'post_id'=> $post->id])
        </div>
    </div>
    @include('partials.sidebar')
</div>
@endsection