@extends('admin.theme.index')

@section('title', 'الصفحات')

@section('header-action')
<a href="{{ route('page.create') }}" class="btn btn-dark my-auto">إنشاء صفحة جديدة</a>
@endsection

@section('content')
<div class="card p-3">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>عنوان الصفحة</th>
                <th>الاسم اللطيف</th>
                <th>الأحداث</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
            <tr>
                <td>{{ $page->title }}</td>
                <td><a href="{{ route('page.show', $page) }}">{{ $page->slug }}</a></td>
                <td>
                     <div class="py-3 d-flex align-items-center gap-2">
                        <a href="{{ route('page.edit', $page) }}">
                            <i class="far fa-edit text-success fa-lg"></i>
                        </a>
                        <form action="{{ route('page.destroy', $page) }}" method="post" style="display: contents;"
                        onsubmit="return confirm('هل أنت متأكد من حذف الصفحة؟')">
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
@endsection