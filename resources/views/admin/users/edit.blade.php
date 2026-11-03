@extends('admin.theme.index')

@section('title', 'المستخدمين')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-user"></i> تعديل معلومات المستخدم
    </div>
    <div class="card-body">
        <div class="container">
            <form action="{{ route('user.update', $user->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="form-row">
                    <div class="col-lg-5 form-group">
                        <label for="name">الاسم</label>
                        <input id="name" type="text" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="invalid-feedback fw-bold">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-lg-5 form-group">
                        <label for="email">البريد الالكتروني</label>
                        <input id="email" type="text" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <span class="invalid-feedback fw-bold">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="role_id">الدور</label>
                        <select name="role_id" id="role_id" class="form-control">
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-12 form-group">
                    <button type="submit" class="btn btn-dark mt-3">تحديث</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection