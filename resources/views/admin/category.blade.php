@extends('admin.theme.index')

@section('title', 'التصنيفات')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-tags"></i> إضافة التصنيفات
        <form action="{{ route('category.store') }}" method="post" class="d-flex gap-2 align-items-center">
            @csrf
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="التصنيف">
            @error('title')
                <span class="invalid-feedback fw-bold">
                    {{ $message ?? '' }}
                </span>
            @enderror
            <button type="submit" class="btn btn-dark">حفظ</button>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderd" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>التصنيف</th>
                        <th>الاسم اللطيف</th>
                        <th>تاريخ الإنشاء</th>
                        <th>الأحداث</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <form action="{{ route('category.destroy', $category) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-link" title="حذف">
                                    <i class="far fa-trash-alt text-danger fa-lg"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection