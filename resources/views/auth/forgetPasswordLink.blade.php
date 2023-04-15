@extends('auth.main')

@section('content')
@if ($check)
<form action="{{ route('reset_password.post') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đặt lại mật khẩu</h5>

    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example27">Mật khẩu</label>
        <input type="password" id="password" name="password" class="form-control form-control-lg" />
        @error('password')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="pt-1 mb-4">
        <button class="btn btn-dark btn-lg btn-block" type="submit">Đặt lại mật khẩu</button>
    </div>
</form>
@else
<h2 style="color: red">Yêu cầu không khả dụng.</h2>
@endif
@endsection