@extends('layouts.main')

@section('content')
<h1 class="h4 my-4">{{ $page->title }}</h1>
<div class="row">
    <div class="col-md-8">
        {!! $page->content !!}
    </div>
    @include('partials.sidebar')
</div>
@endsection