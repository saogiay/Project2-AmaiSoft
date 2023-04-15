@extends('admin.main')
@section('content')
    <div class="container-fluid">
        <a href="{{ route('admin.product.products.index') }}" type="button" class="btn btn-secondary">
            <i class="fa-solid fa-circle-left"></i>
            Quay lại
        </a>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>{{ $title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form id="product-store" class="product-form" method="post"
                            action="{{ route('admin.product.products.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Tên</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="name" id="name" placeholder="Tên" type="text"
                                        class="form-control" value="" aria-describedby="name-error">
                                    <span class="error-message" style="display:none;color: red;"></span>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="price" class="col-md-3 text-md-right col-form-label">Giá</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="price" id="price" placeholder="Giá" type="number"
                                        class="form-control" value="">
                                    <span class="error-message" style="display:none;color: red;"></span>
                                </div>

                            </div>

                            <div class="position-relative row form-group">
                                <label for="brand_id" class="col-md-3 text-md-right col-form-label">Thương Hiệu</label>
                                <div class="col-md-9 col-xl-8">
                                    <select required name="brand_id" id="brand_id" class="form-control">
                                        <option value="">-- Thương Hiệu --</option>
                                        @foreach ($brands as $brand)
                                            <option value={{ $brand->id }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="category_id" class="col-md-3 text-md-right col-form-label">Danh Mục</label>
                                <div class="col-md-9 col-xl-8">
                                    <select required name="category_id" id="category_id" class="form-control">
                                        <option value="">-- Danh Mục --</option>
                                        @foreach ($categories as $category)
                                            <option value={{ $category->id }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="description" class="col-md-3 text-md-right col-form-label">Mô Tả</label>
                                <div class="col-md-9 col-xl-8">
                                    <textarea class="form-control" name="description" id="description" placeholder="Mô tả"></textarea>
                                    <span class="error-message" style="display:none;color: red;"></span>
                                </div>
                            </div>

                            <div class="position-relative text-center row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="{{ route('admin.product.products.index') }}"
                                        class="border-0 btn btn-outline-danger mr-1">
                                        <span class="btn-icon-wrapper pr-1 opacity-8">
                                            <i class="fa fa-times fa-w-20"></i>
                                        </span>
                                        <span>Hủy</span>
                                    </a>

                                    <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="fa fa-download fa-w-20"></i>
                                        </span>
                                        <span>Lưu</span>
                                    </button>
                                </div>
                            </div>
                        </form>
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
    </script>
@endsection
