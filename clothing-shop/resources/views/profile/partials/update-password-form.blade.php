<section>
    <header>
        <h2 class="h5 font-weight-bold text-dark">
            Cập nhật mật khẩu
        </h2>

        <p class="mt-1 text-muted">
            Hãy chắc chắn rằng bạn đang sử dụng một mật khẩu dài và ngẫu nhiên để giữ an toàn.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
            <input id="current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu mới</label>
            <input id="password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            @if (session('status') === 'password-updated')
                <p class="text-success m-0">Đã lưu.</p>
            @endif
        </div>
    </form>
</section>