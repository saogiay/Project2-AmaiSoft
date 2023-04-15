@extends('auth.main')

@section('content')
<form action="{{ route('register') }}" method="POST">
    @csrf
    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng ký</h5>

    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example17">Tên</label>
        <input type="text" id="text" name="name" class="form-control form-control-lg" value="{{ old('name') }}" />
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example17">Số điện thoại</label>
        <input type="text" id="phone" name="phone" class="form-control form-control-lg" value="{{ old('phone') }}"/>
        @error('phone')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example17">Email</label>
        <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}"/>
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
        <button class="btn btn-dark btn-lg btn-block" type="submit">Đăng ký</button>
    </div>

    <p class="mt-3 pb-lg-2" style="color: #393f81;">Đã có tài khoản? <a href="{{ route('login') }}"
            style="color: #393f81;" class="small text-muted">Đăng nhập</a></p>
</form>
@endsection