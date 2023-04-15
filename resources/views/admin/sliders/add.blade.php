@extends('admin.main')
@section('link')
    <link rel="stylesheet" href="/template/css/upload.scss">
@endsection
@section('content')
    <div class="container-fluid">
        <a href="{{ route('admin.sliders.index') }}" type="button" class="btn btn-secondary">
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
                <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên banner</label>
                        @error('name')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
                    </div>

                    <div class="mb-3">
                        <input id="file-upload" type="file" name="fileUpload" accept="image/*" />
                        <label for="file-upload" id="file-drag">
                            <img id="file-image" src="#" alt="" class="hidden" style="width: 100%">
                            <div id="start">
                                <div id="notimage" class="hidden"></div>
                                <span id="file-upload-btn" class="btn btn-primary">
                                    <i class="fa-sharp fa-solid fa-image"></i>
                                    Chọn 1 file ảnh
                                </span>
                            </div>
                            @error('fileUpload')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div id="response" class="hidden">
                                <div id="messages"></div>
                            </div>
                        </label>
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
@section('js')
    <script src="/template/js/upload.js"></script>
@endsection
