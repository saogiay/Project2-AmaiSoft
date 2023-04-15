@extends('auth.main')

@section('content')
<form action="{{ route('forget_password.post') }}" method="POST">
    @csrf

    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Cấp lại mật khẩu</h5>

    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example17">Nhập Email của bạn</label>
        <input type="email" id="email" name="email" class="form-control form-control-lg" />
        @error('email')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="pt-1 mb-4">
        <button class="btn btn-dark btn-lg btn-block" type="submit">Gửi yêu cầu cấp lại mật khẩu</button>
        <p class="mt-3 pb-lg-2" style="color: #393f81;">Đã nhớ mật khẩu? <a href="{{ route('login') }}" style="color: #393f81;"
            class="small text-muted">Đăng nhập</a></p>
    </div>
</form>
@endsection