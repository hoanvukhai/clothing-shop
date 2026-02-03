@extends('layouts.app')

@section('title', 'Thông tin cá nhân - Fashion Shop')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-5"><i class="fas fa-user-edit"></i> Thông tin cá nhân</h1>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card mb-4">
                <div class="card-header">
                    Cập nhật thông tin
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Đổi mật khẩu
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection