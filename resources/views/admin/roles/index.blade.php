@extends('admin.theme.index')

@section('title', 'الأدوار')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fa-solid fa-user-shield"></i> الأدوار
        <form action="{{ route('role.store') }}" method="post" class="d-flex gap-2 align-items-center">
            @csrf
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="اسم الدور">
            @error('name')
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
                        <th>الدور</th>
                        <th>الصلاحيات</th>
                        <th>الأحداث</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->permissions_count }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('role.edit', $role) }}" class="text-decoration-none text-dark d-flex align-items-center gap-2">
                                    <i class="far fa-edit text-success fa-lg"></i>
                                    تعديل الصلاحيات
                                </a>
                                @can('delete', $role)
                                <form action="{{ route('role.destroy', $role) }}" method="post" style="display: contents;"
                                onsubmit="return confirm('هل أنت متأكد من حذف هذا الدور؟')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link" title="حذف">
                                        <i class="far fa-trash-alt text-danger fa-lg"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection