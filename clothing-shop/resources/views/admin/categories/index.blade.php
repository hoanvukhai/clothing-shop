@extends('layouts.admin')

@section('title', 'Quản lý danh mục')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-list"></i> Quản lý danh mục</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm danh mục
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            @if($categories->count() > 0)
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Slug</th>
                            <th>Số sản phẩm</th>
                            <th>Mô tả</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td><strong>#{{ $category->id }}</strong></td>
                                <td><strong>{{ $category->name }}</strong></td>
                                <td><code>{{ $category->slug }}</code></td>
                                <td>
                                    <span class="badge bg-info">{{ $category->products_count }}</span>
                                </td>
                                <td>
                                    {{ Str::limit($category->description, 50) ?? 'N/A' }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    @if($category->products_count == 0)
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')">
                                                <i class="fas fa-trash"></i> Xóa
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-secondary" disabled title="Không thể xóa danh mục có sản phẩm">
                                            <i class="fas fa-trash"></i> Xóa
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <nav aria-label="Page navigation">
                    {{ $categories->links() }}
                </nav>
            @else
                <div class="alert alert-info text-center">
                    <i class="fas fa-inbox"></i> Chưa có danh mục nào. 
                    <a href="{{ route('admin.categories.create') }}" class="alert-link">Tạo danh mục đầu tiên</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
