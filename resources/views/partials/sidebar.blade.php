<div class="col-4">
    <div class="card">
        <h5 class="card-header">التصنيفات</h5>
        <div class="card-body">
            <ul class="nav flex-column p-0" style="list-style: none !important;">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link text-dark">جميع التصنيفات ({{ $posts_count }})</a>
                </li>
                @foreach ($categories as $cat)
                <li class="nav-item">
                    <a href="{{ route('category', $cat) }}" class="nav-link text-dark">{{ $cat->title }} ({{ $cat->posts_count }})</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="card my-4">
        <h5 class="card-header">آخر التعليقات</h5>
        <ul class="list-group p-0">
            @forelse ($recent_comments as $comment)
            <li class="list-group-item bg-white">
                <a href="{{ route('post.show', $comment->post->slug) }}#comments" class="text-decoration-none text-secondary d-flex gap-2 align-items-center">
                    <img src="{{ $comment->user->profile_photo_url }}" width="40px" height="40px" class="rounded-full">
                    <span class="mt-1 me-1 d-inline-block fw-bold">{{ $comment->user->name }}</span>
                    <span>{{ \Illuminate\Support\Str::limit($comment->content, 60) }}</span>
                </a>
            </li>
            @empty
            @include('alerts.empty', ['msg' => 'لا توجد تعليقات'])
            @endforelse
        </ul>
    </div>
</div>