@extends('layouts.main')

@section('content')
<h1 class="h4 my-4">
    {{ $title }}
</h1>
<div>
    <div class="col-md-8">
        @forelse ($notifications as $notification)
        <div class="card mb-3 bg-white text-secondary">
            <div class="card-body">
                <div class="d-flex align-items-center column-gap-2">
                    <img src="{{ $notification->data['icon'] }}" width="50px" height="50px" class="rounded-full">
                    <div>
                        <i class="far fa-clock"></i>
                        <span>{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="row">
                    <a href="{{ $notification->data['url'] }}" class="text-reset text-decoration-none">
                        {!! $notification->data['content'] !!}
                    </a>
                </div>
            </div>
        </div>
        @empty
        @include('alerts.empty', ['msg'=> 'لا توجد إشعارات بعد'])
        @endforelse

        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
            {{ $notifications->links() }}
        </ul>
    </div>
</div>
@endsection