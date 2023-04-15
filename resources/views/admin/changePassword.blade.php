@extends('admin.main')

@section('content')
<div class="container pt-5">
    @if ($message = Session::get('message'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
</div>
<div class="container w-75">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Đổi mật khẩu</h3>
        </div>

        <form action="" id="quickForm" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="old_password">Nhập mật khẩu cũ:</label>
                    <input type="password" name="old_password" class="form-control" id="old_password"
                        placeholder="Mật khẩu cũ">
                    @error('old_password')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new_password">Mật khẩu mới:</label>
                    <input type="password" name="new_password" class="form-control" id="new_password"
                        placeholder="Mật khẩu mới">
                    @error('new_password')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new_confirm_password">Nhập lại mật khẩu mới:</label>
                    <input type="password" name="new_confirm_password" class="form-control" id="new_confirm_password"
                        placeholder="Mật khẩu mới">
                    @error('new_confirm_password')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
</div>
@endsection