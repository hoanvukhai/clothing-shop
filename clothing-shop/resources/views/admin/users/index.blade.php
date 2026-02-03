@extends('layouts.admin')

@section('title', 'Quản lý người dùng - Admin')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-5"><i class="fas fa-users-cog"></i> Quản lý người dùng</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm người dùng mới
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Ngày tham gia</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role == 1)
                                        <span class="badge bg-primary">Admin</span>
                                    @else
                                        <span class="badge bg-secondary">User</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        @if(auth()->id() !== $user->id)
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">
                                                <i class="fas fa-trash"></i> Xóa
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Không có người dùng nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection