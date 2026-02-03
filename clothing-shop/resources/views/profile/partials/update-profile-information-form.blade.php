<section>
    <header>
        <h2 class="h5 font-weight-bold text-dark">
            Thông tin hồ sơ
        </h2>

        <p class="mt-1 text-muted">
            Cập nhật thông tin hồ sơ và địa chỉ email của bạn.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="form-control" value="{{ $user->email }}" disabled>
            <small class="text-muted">Email không thể thay đổi từ trang này.</small>
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </div>
    </form>
</section>