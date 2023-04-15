@extends('auth.main')

@section('content')
<form action="{{ route('login') }}" method="POST">
    @csrf
    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng nhập</h5>

    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example17">Email</label>
        <input type="email" id="email" name="email" class="form-control form-control-lg" />
        @error('email')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example27">Mật khẩu</label>
        <input type="password" id="password" name="password" class="form-control form-control-lg" />
        @error('password')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="pt-1 mb-4">
        <button class="btn btn-dark btn-lg btn-block" type="submit">Đăng nhập</button>
    </div>

    <a class="small text-muted" href="{{ route('forget_password.get') }}">Quên mật khẩu</a>
    <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn chưa có tài khoản? <a href="{{ route('register') }}"
            style="color: #393f81;" class="small text-muted">Đăng ký ngay</a></p>
</form>
@endsection