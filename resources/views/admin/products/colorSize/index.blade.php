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
                @if (session('error'))
                    <div class="alert alert-success text-center">Đã có lỗi xảy ra!</div>
                @endif
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Tên Sản phẩm</label>
                            <div class="col-md-9 col-xl-8">
                                <input disabled type="text" class="form-control" value="{{ $product->name }}">
                            </div>
                            <!-- Tạo button để mở modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Thêm
                            </button>

                            <!-- Modal -->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Thêm chi tiết sản phẩm</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addDetailForm"
                                                action="{{ route('admin.product.detail.store', ['product' => $product->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="size">Size</label>
                                                    <select required name="size_id" id="size_id" class="form-control">
                                                        <option value="">-- Chọn Size --</option>
                                                        @foreach ($sizes as $size)
                                                            <option value={{ $size->id }}>
                                                                {{ $size->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('size_id')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="color">Màu</label>
                                                    <select required name="color_id" id="color_id" class="form-control">
                                                        <option value="">-- Chọn Màu --</option>
                                                        @foreach ($colors as $color)
                                                            <option value={{ $color->id }}>
                                                                {{ $color->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('color_id')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity">Số lượng</label>
                                                    <input type="number" min="1" step="1" maxlength="10"
                                                        class="form-control" id="quantity" name="quantity" required>
                                                    @error('quantity')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <input type="hidden" id='product_id' data-id="{{ $product->id }}"
                                                    name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn btn-primary">lưu</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Modal -->

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Size</th>
                                            <th>Màu</th>
                                            <th>Số lượng</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailProducts as $key => $detailProduct)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $detailProduct->size->name }}</td>
                                                <td>{{ $detailProduct->color->name }}
                                                    <i class="fa-solid fa-paintbrush"
                                                        style="color: {{ $detailProduct->color->code }};"></i>
                                                </td>
                                                <td>{{ $detailProduct->quantity }}</td>
                                                <td><button type="button" class="btn btn-primary btn-edit"
                                                        data-toggle="modal" data-target="#editModal"
                                                        data-id="{{ $detailProduct->id }}"
                                                        data-product_id="{{ $product->id }}"
                                                        data-size_id="{{ $detailProduct->size_id }}"
                                                        data-color_id="{{ $detailProduct->color_id }}"
                                                        data-quantity="{{ $detailProduct->quantity }}">
                                                        Sửa
                                                    </button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="modal" id="editModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Sửa chi tiết sản phẩm</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editDetailForm" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label for="size">Size</label>
                                                    <select required name="size_id" id="size_id" class="form-control">
                                                        <option value="">-- Chọn Size --</option>
                                                        @foreach ($sizes as $size)
                                                            <option value={{ $size->id }}>
                                                                {{ $size->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="color">Màu</label>
                                                    <select required name="color_id" id="color_id" class="form-control">
                                                        <option value="">-- Chọn Màu --</option>
                                                        @foreach ($colors as $color)
                                                            <option value={{ $color->id }}>
                                                                {{ $color->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity">Số lượng</label>
                                                    <input type="number" min="1" step="1" maxlength="10"
                                                        class="form-control" id="quantity" name="quantity" required>
                                                </div>
                                                <input type="hidden" id='product_id' data-id="{{ $product->id }}"
                                                    name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" id='id' name="id" value="">
                                                <button type="submit" id="submitUpdate"
                                                    class="btn btn-primary">sửa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
        $('body').on('click', '.btn-edit', function() {
            var url = $(this).data('url');
            var detail_id = $(this).data('id');
            var product_id = $(this).data('product_id');
            var color_id = $(this).data('color_id');
            var size_id = $(this).data('size_id');
            var quantity = $(this).data('quantity');
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    // Hiển thị thông tin sản phẩm lên modal
                    $('#editDetailForm select[name="size_id"]').val(size_id);
                    $('#editDetailForm select[name="color_id"]').val(color_id);
                    $('#editDetailForm input[name="quantity"]').val(quantity);
                    $('#editDetailForm input[name="id"]').val(detail_id);
                    var route = `/admin/product/products/${product_id}/detail/${detail_id}`
                    $('#editDetailForm').attr('action', route);
                }
            });
        });
    </script>
@endsection
