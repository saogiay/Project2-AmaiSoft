@extends('admin.main')
@section('content')
    <div class="container-fluid">
        <a href="{{ route('admin.product.products.show',['product'=>$product->id]) }}" type="button" class="btn btn-secondary">
            <i class="fa-solid fa-circle-left"></i>
            Quay lại
        </a>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>{{ $title }}</h1>
                @if (session('msg'))
                    <div class="alert alert-success text-center">{{ session('msg') }}</div>
                @endif
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Tên Sản phẩm</label>
                            <div class="col-md-9 col-xl-8">
                                <input disabled type="text" class="form-control" value="{{ $product->name }}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="" class="col-md-3 text-md-right col-form-label">Ảnh</label>
                            <div class="col-md-9 col-xl-8">
                                <ul class="text-nowrap" id="images">
                                    @foreach ($thumbs as $thumb)
                                        <li class="float-left d-inline-block mr-2 mb-2 mt-2"
                                            style="position: relative; width: 32%;">
                                            <form
                                                action="{{ route('admin.product.thumb.destroy', ['product' => $product->id, 'thumb' => $thumb->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Bạn thật sự muốn xóa?')"
                                                    class="btn btn-sm btn-outline-danger border-0 position-absolute">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                            <div style="width: 100%; height: 100%; overflow: hidden;">
                                                <img src={{ asset($thumb->url) }} alt="Image"
                                                    style="width:300px">
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="position-relative  form-group mb-1 ">
                            <div class="col-md-12">
                                <form method="post"
                                    action="{{ route('admin.product.thumb.store', ['product' => $product->id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <div class="thumbnail m-auto">
                                            <p class="btn btn-primary m-0">
                                                <i class="fa-solid fa-image"></i>
                                                Thêm ảnh mới
                                            </p>
                                        </div>
                                        <input name="images[]" type="file" id="images"
                                            onchange="changeImg(this); this.form.submit()"
                                            accept="image/x-png,image/gif,image/jpeg" class="image form-control-file"
                                            style="display: none;" multiple>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.product-form').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(response) {
                        // Xử lý lỗi
                        var errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var errorMessage = '<div class="error">' + value[0] +
                                '</div>';
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).next('.error-message').html(errorMessage);
                            $('#' + key).next('.error-message').show();
                        });
                    }
                });
            });
        });

        // = = = = = = = = = = = = = = = = changeImg = = = = = = = = = = = = = = = =
        function changeImg(input) {
            //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                //Sự kiện file đã được load vào website
                reader.onload = function(e) {
                    //Thay đổi đường dẫn ảnh
                    $(input).siblings('.thumbnail').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        //Khi click #thumbnail thì cũng gọi sự kiện click #image
        $(document).ready(function() {
            $('.thumbnail').click(function() {
                $(this).siblings('.image').click();
            });
        });
        //thay đổi ảnh show
        $(document).ready(function() {
            $('.product-image-thumb').on('click', function() {
                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            })
        })
    </script>
@endsection
