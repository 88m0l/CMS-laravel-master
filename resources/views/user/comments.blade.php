<div>
    @forelse ( $comments as $comment)
        <div class="card mt-4 p-3 bg-white">
            <div class="d-flex align-items-start gap-3">
                <img src="{{ $user->profile_photo_url }}" width="80" class="rounded-circle">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between fw-bold">
                        {{ $user->name }}
                        @can('delete', $comment)
                        <form action="{{ route('comment.destroy', $comment) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف التعليق هذا؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="far fa-trash-alt text-danger fa-lg"></i>
                            </button>
                        </form>
                        @endcan
                    </div>
                    <small class="text-muted">
                        <i class="far fa-clock"></i> {{ $comment->created_at->diffForHumans() }}
                    </small>
                    <a href="{{ route('post.show', $comment->post->slug) }}#comments" class="d-block mt-2 text-decoration-none text-dark">
                        {{ \Illuminate\Support\Str::limit($comment->content, 250) }}
                    </a>
                </div>
            </div>
        </div>
    @empty
        @include('alerts.empty', ['msg' => 'لا توجد أي تعليقات بعد'])
    @endforelse
</div>