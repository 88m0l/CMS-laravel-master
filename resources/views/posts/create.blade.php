@extends('layouts.main')

@section('content')
    <h1 class="h4 my-4">أضف موضوعاً جديداً</h1>
    <div class="row">
        <div class="col-8 bg-white py-3">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="category" class="mb-2">التصنيفات</label>
                <select name="category_id" class="form-select mb-3" id="category">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>                    
                    @endforeach
                </select>

                <label for="title" class="mb-2">عنوان المنشور</label>
                <input type="text" name="title" id="title" placeholder="حدد عنوان الموضوع" value="{{ old('title') }}" 
                    class="form-control mb-3 @error('title') is-invalid @enderror">
                @error('title')
                <span class="invalid-feedback">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                @enderror

                <label for="editor" class="mb-2">محتوى المنشور</label>
                <textarea name="content" id="editor" class="form-control mb-3 @error('content') is-invalid @enderror" rows="3">
                    {{ old('content') }}
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
                    <img src="#" alt="" id="cover-image-thumb" class="mt-3 img-thumbnail d-none" style="max-height: 200px;">
                </div>

                <button type="submit" class="btn btn-outline-dark my-3">نشر</button>
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
