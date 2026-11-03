@forelse ($posts as $post)
     <div class="card mb-3 bg-white text-secondary">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between column-gap-2">
                    <div class="text-decoration-none text-secondary d-flex align-items-center column-gap-2">
                        <img src="{{ $post->user->profile_photo_url }}" width="50px" height="50px" class="rounded-full" />
                        <p class="h-100 mb-0 fw-bold">{{ $post->user->name }}</p>
                    </div>
                    @auth
                        <div class="d-flex align-items-center column-gap-1">
                            @can('delete', $post)
                            <form action="{{ route('post.destroy', $post) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف المنشور هذا؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <i class="far fa-trash-alt text-danger fa-lg"></i>
                                </button>
                            </form>
                            @endcan
                            @can('update', $post)
                            <a href="{{ route('post.edit', $post) }}">
                                <i class="far fa-edit text-success fa-lg ml-3"></i>
                            </a>
                            @endcan
                        </div>
                    @endauth
                </div>
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
                        <a href="{{ $post->status == \App\Enums\PostStatus::Published ? route('post.show', $post->slug) : '' }}" 
                            class="text-reset text-decoration-none">
                            {{ $post->title }}
                        @if($post->status == \App\Enums\PostStatus::Published)
                             <span class="fs-6 badge rounded-pill text-bg-success">
                                <i class="fa-solid fa-globe fa-xs"></i>
                            </span>
                        @else
                            <span class="h-6 fs-6 badge rounded-pill text-bg-secondary">
                                <i class="fa-regular fa-hourglass-half fa-xs"></i>
                            </span>
                        @endif
                        </a>
                    </h4>
                    <p class="card-text mb-2">{{ Str::limit(strip_tags($post->content), 200) }}</p>
                </div>
            </div>
        </div>
@empty
    @include('alerts.empty', ['msg' => 'لا توجد أي مشاركات بعد'])
@endforelse