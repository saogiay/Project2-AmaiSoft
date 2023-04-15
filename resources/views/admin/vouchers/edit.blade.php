@extends('admin.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <a href="{{ route('admin.vouchers.index') }}" type="button" class="btn btn-secondary">
                <i class="fa-solid fa-circle-left"></i>
                Quay lại
            </a>
            <div class="col-md-12 text-center">
                <h1>{{ $title }}</h1>
            </div>
            <div class="col-md-8 m-auto">
                @if (session('msg'))
                <div class="alert alert-success text-center">{{ session('msg') }}</div>
                @endif

            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    Thông tin điền vào chưa đúng. Vui lòng nhập lại.
                </div>
            @endif
                <form action="{{route('admin.vouchers.update',$voucher->id)}}" method="POST">
                    @method("PUT")
                    <input type="hidden" name="id" value="{{$voucher->id}}">
                    <div class="mb-3">
                        <label for="">Tên voucher: </label>
                        @error('name')
                        <span style="color:red">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control" name="name" value="{{$voucher->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="">Mã voucher: </label>
                        @error('code')
                        <span style="color:red">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control" name="code" value="{{$voucher->code}}">
                    </div>
                    <div class="mb-3">
                        <label for="">Mức giảm: </label>
                        @error('discount')
                        <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="input-group">
                            <input type="number" class="form-control" min= "0" max="100" step="0.01" name="discount" value="{{$voucher->discount}}">
                            <span class="input-group-text">.00%</span>
                            </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Ngày áp dụng: </label>
                        @error('start_day')
                        <span style="color:red">{{ $message }}</span>
                        @enderror
                        <input type="datetime-local" class="form-control" name="start_day" value="{{$voucher->start_day}}">
                    </div>
                    <div class="mb-3">
                        <label for="">Ngày hết hạn: </label>
                        @error('exp')
                        <span style="color:red">{{ $message }}</span>
                        @enderror
                        <input type="datetime-local" class="form-control" name="exp" value="{{$voucher->exp}}">
                    </div>
                    <div class="mb-3 d-flex justify-content-evenly">
                        <div class="mb-3">
                            <label for="">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"
                                    value="1" {{ $voucher->status == 1 ? 'checked=""' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Kích hoạt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1"
                                    value="0" {{ $voucher->status == 0 ? 'checked=""' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Vô hiệu hóa
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Cho phép dùng nhiều lần</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="allow_multi" id="flexRadioDefault2"
                                    value="1" {{$voucher->allow_multi == 1 ?'checked=""' : ''}} >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Có
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="allow_multi" id="flexRadioDefault1"
                                    value="0"{{$voucher->allow_multi == 0 ?'checked=""' : ''}} >
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Không
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">
                        <i class="fas fa-check-double"></i>
                        Cập nhật
                    </button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
