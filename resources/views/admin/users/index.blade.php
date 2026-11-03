@extends('admin.theme.index')

@section('title', 'المستخدمين')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-users"></i> المستخدمين
        @can('create', \App\Models\User::class)
        <form action="{{ route('user.store') }}" method="post" class="row">
            @csrf
            <div class="col">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="الاسم">
                @error('name')
                    <span class="invalid-feedback fw-bold">
                        {{ $message ?? '' }}
                    </span>
                @enderror
            </div>
            <div class="col">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="البريد الإلكتروني">
                @error('email')
                    <span class="invalid-feedback fw-bold">
                        {{ $message ?? '' }}
                    </span>
                @enderror
            </div>
            <div class="col">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="كلمة المرور">
                @error('password')
                    <span class="invalid-feedback fw-bold">
                        {{ $message ?? '' }}
                    </span>
                @enderror
            </div>

            <div class="col">
                <select name="role_id" class="form-control">
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-dark">حفظ</button>
            </div>
        </form>
        @endcan
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderd" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد الالكتروني</th>
                        <th>تاريخ التفعيل</th>
                        <th>الدور</th>
                        <th>تاريخ الإنشاء</th>
                        <th>الأحداث</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <a href="{{ route('user_posts', $user->id) }}" class="text-decoration-none text-dark"> {{ $user->name }}</a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_verified_at }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @can('update', $user)
                                <a href="{{ route('user.edit', $user->id) }}" class="text-decoration-none text-dark d-flex align-items-center gap-2">
                                    <i class="far fa-edit text-success fa-lg"></i>
                                </a>
                                @endcan
                                @can('delete', $user)
                                <form action="{{ route('user.destroy', $user->id) }}" method="post" style="display: contents;">
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

<ul class="pagination justify-content-center mb-4">
    {{ $users->links() }}
</ul>
@endsection