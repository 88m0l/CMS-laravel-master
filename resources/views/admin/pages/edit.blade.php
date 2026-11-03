@extends('admin.theme.index')

@section('title', 'الصفحات')

@section('content')
<div class="card mb-3 bg-white">
    <div class="card-header">
        <i class="fa fa-file-lines"></i>
    </div>
    <div class="card-body">
        <div class="container">
            <form action="{{ route('page.update', $page->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="col-lg-5 form-group">
                    <label for="title">عنوان الصفحة</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="مثال: نبذة عنا" value="{{ $page->title }}">
                </div>

                <div class="col-lg-5 form-group">
                    <label for="slug">الاسم اللطيف</label>
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="الاسم اللطيف" value="{{ $page->slug }}">
                </div>

                <label for="editor" class="mb-2">المحتوى</label>
                <div class="input-group d-inline">
                    <textarea name="content" id="editor" class="form-control @error('content') is-invalid @enderror" rows="3">{{ $page->content }}</textarea>
                    @error('content')
                    <span class="invalid-feedback fw-bold">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-lg-12 form-group">
                    <button type="submit" class="btn btn-dark mt-3">تعديل</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .ck.ck-reset.ck-editor.ck-rounded-corners * {
        direction: rtl !important;
        text-align: right !important;
    }
</style>
@endpush
