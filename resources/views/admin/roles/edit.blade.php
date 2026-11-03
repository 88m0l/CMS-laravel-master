@extends('admin.theme.index')

@section('title', 'تعديل صلاحيات دور "'. $role->name .'"')

@section('content')
<div class="card mb-3">
    <form action="{{ route('role.update', $role) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row card-body">
            @foreach ($permissions as $permission)
            <div class="col-lg-4">
                <label>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                    {{ $role->permissions()->find($permission) ? 'checked' : '' }} >
                    {{ __('permissions.'.$permission->name) }}
                </label>
            </div>
            @endforeach
        </div>
        <div class="card-footer small text-muted">
            <input type="submit" class="btn btn-dark" value="حفظ">
        </div>
    </form>
</div>

@endsection