@extends('layouts.main')

@section('content')
    <h1 class="h4 my-4">تعديل المنشور</h1>
    <div class="row">
        <div class="col-8 bg-white py-3">
            <form action="{{ route('post.update', [$post, "admin"=>$admin]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <label for="category" class="mb-2">التصنيفات</label>
                <select name="category_id" class="form-select mb-3" id="category">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->category->id == $category->id ? 'selected' : ''}}>{{ $category->title }}</option>                    
                    @endforeach
                </select>

                <label for="title" class="mb-2">عنوان المنشور</label>
                <input type="text" name="title" id="title" placeholder="حدد عنوان الموضوع" value="{{ $post->title }}" 
                    class="form-control mb-3 @error('title') is-invalid @enderror">
                @error('title')
                <span class="invalid-feedback">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                @enderror

                @if($admin)
                <label for="slug" class="mb-2">الاسم اللطيف</label>
                <input type="text" name="slug" id="slug" placeholder="حدد الاسم اللطيف" value="{{ $post->slug }}" 
                    class="form-control mb-3 @error('slug') is-invalid @enderror">
                @error('slug')
                <span class="invalid-feedback">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                @enderror

                <label class="mb-2 me-3 fw-bold">حالة المنشور: </label>
                <input type="radio" class="btn-check" name="status" id="pending" value="{{ \App\Enums\PostStatus::Pending->value }}"
                {{ $post->status ==  \App\Enums\PostStatus::Pending ? 'checked': ''}}>
                <label for="pending" class="btn btn-outline-secondary btn-sm">
                    <i class="fa-regular fa-hourglass-half"></i>
                    معلق
                </label>

                <input type="radio" class="btn-check" name="status" id="published" value="{{ \App\Enums\PostStatus::Published->value }}"
                {{ $post->status ==  \App\Enums\PostStatus::Published ? 'checked': ''}}>
                <label for="published" class="btn btn-outline-success btn-sm">
                    <i class="fa-solid fa-globe"></i>
                    عام
                </label>

                <br class="mb-5">
                @endif

                <label for="editor" class="mb-2">محتوى المنشور</label>
                <textarea name="content" id="editor" class="form-control mb-3 @error('content') is-invalid @enderror" rows="3">
                    {{ $post->content }}
                </textarea>
                @error('content')
                <span class="invalid-feedback">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                @enderror

                <div class="input-group my-3 file-area position-relative text-center" id="drop-area">
                    <input type="file" name="image_path" id="image" accept="image/*">
                    <div class="input-title" id="input-title">اسحب الصورة إلى هنا أو انقر للإختيار يدوياً</div>
                    <img src="{{ asset('/storage/images/'. $post->image_path) }}" alt="" id="cover-image-thumb" class="mt-3 img-thumbnail" style="max-height: 200px;">
                </div>

                <button type="submit" class="btn btn-outline-dark my-3">تعديل</button>
            </form>
        </div>
        @include('partials.sidebar')
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


@push('scripts')
<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('image');
    const inputTitle = document.getElementById('input-title');

    function readCoverImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.getElementById('cover-image-thumb');
                img.src = e.target.result;
                img.classList.remove('d-none');
                inputTitle.classList.add('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropArea.classList.add('drag-over');
    });

    dropArea.addEventListener('dragleave', (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropArea.classList.remove('drag-over');
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropArea.classList.remove('drag-over');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            readCoverImage(fileInput);
        }
    });
</script>
@endpush
