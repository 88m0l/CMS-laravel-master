<div>
    @foreach ($comments as $comment)
    <div class="card bg-white text-secondary mb-3">
        <div class="card-body">
            <a href="{{ route('user_comments', $comment->user) }}" class="text-decoration-none text-secondary d-flex align-items-center column-gap-1">
                <img src="{{ $comment->user->profile_photo_url }}" width="50px" class="rounded-full">
                <p class="mt-2 me-3 mb-0 fw-bold">{{ $comment->user->name }}</p>
            </a>
            <div x-data="{ open: false }">
                <div class="row">
                    <div class="col-4">
                        <i class="far fa-clock"></i>
                        <span class="text-secondary">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="col-4" @click="open = !open">
                        <span class="cursor-pointer">
                            <i class="fa-solid fa-reply"></i> <span class="text-secondary">إضافة رد</span>
                        </span>
                    </div>
                </div>
                <p class="my-3">{{ $comment->content }}</p>

                @auth
                <form x-show="open" @click.outside="open = false" action="{{ route('comment.store') }}" method="post" id="reply" x-transition>
                    @csrf
                    <div class="form-group">
                        <textarea name="content" rows="5" placeholder="أضف ردًّا ..." class="form-control @error('content') is-invalid @enderror"></textarea>
                        @error('content')
                        <span class="invalid-feedback fw-bold">
                            {{ $message ?? '' }}
                        </span>
                        @enderror

                        <input type="hidden" name="post_id" value="{{ $post_id }}">
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="تعليق" class="btn btn-outline-dark my-2">
                    </div>
                </form>
                @else
                <div x-show="open" @click.outside="open = false" class="alert alert-info" x-transition>
                      يرجى تسجيل الدخول لكي تستطيع وضع رد
                </div>
                @endauth
                @include('comments.all', ['comments'=> $comment->replies, 'post_id' => $post_id])
            </div>
        </div>
    </div>
    @endforeach
</div>