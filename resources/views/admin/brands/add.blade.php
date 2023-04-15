@extends('admin.main')
@section('content')
    <div class="container-fluid">
        <a href="{{ route('admin.brands.index') }}" type="button" class="btn btn-secondary">
            <i class="fa-solid fa-circle-left"></i>
            Quay lại
        </a>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>{{ $title }}</h1>
            </div>
            <div class="col-md-8 mx-auto mt-5">
                @if (session('msg'))
                    <div class="alert alert-success text-center">{{ session('msg') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        Thông tin điền vào chưa đúng. Vui lòng nhập lại.
                    </div>
                @endif
                <form action="{{ route('admin.brands.store') }}" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên nhãn hàng</label>
                        @error('name')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
                    </div>

                    <div class="mb-3">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"
                                value="1" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Kích hoạt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1"
                                value="0">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Vô hiệu hóa
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">
                        <i class="fas fa-check-double"></i>
                        Thêm
                    </button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection