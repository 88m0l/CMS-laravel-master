@extends('admin.theme.index')

@section('title', 'المنشورات')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderd" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>التصنيف</th>
                        <th>الحالة</th>
                        <th>الكاتب</th>
                        <th>تاريخ الإنشاء</th>
                        <th class="text-center">الأحداث</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            <a href="{{ $post->status == \App\Enums\PostStatus::Published ? route('post.show', $post->slug) : '#' }}" 
                            class="text-dark text-decoration-none">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td>{{ $post->category->title }}</td>
                        <td>
                        @if($post->status == \App\Enums\PostStatus::Published)
                             <span class="badge rounded-pill text-bg-success">
                                <i class="fa-solid fa-globe"></i>
                                عام
                            </span>
                        @else
                            <span class="badge rounded-pill text-bg-secondary">
                                <i class="fa-regular fa-hourglass-half"></i>
                                مُعلق
                            </span>
                        @endif
                        </td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                            <div class="p-2 d-flex align-items-center gap-2">
                                <a href="{{ route('post.edit', [$post, "admin"=>true]) }}">
                                    <i class="far fa-edit text-success fa-lg"></i>
                                </a>
                                <form action="{{ route('post.destroy', $post) }}" method="post" style="display: contents;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link" title="حذف">
                                        <i class="far fa-trash-alt text-danger fa-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<ul class="pagination justify-content-center mb-4">
    {{ $posts->links() }}
</ul>
@endsection