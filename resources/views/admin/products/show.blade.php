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
                @if (session('msg'))
                    <div class="alert alert-success text-center">{{ session('msg') }}</div>
                @endif
                <!-- Default box -->
                <div class="card card-solid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6 text-center">
                                <h3 class="d-inline-block d-sm-none">{{ $product->name }}</h3>
                                @if (!empty($product->thumbs[0]))
                                    <div class="col-12">
                                        <img src="{{ asset($product->thumbs[0]->url) }}" class="product-image"
                                            alt="Product Image" style="width: 400px">
                                    </div>
                                @endif
                                <div class="col-12 product-image-thumbs d-flex justify-content-center">
                                    @foreach ($product->thumbs as $thumb)
                                        <div class="product-image-thumb active"><img src="{{ asset($thumb->url) }}"
                                                alt="Product Image" style="width: 150px"></div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="col-12 col-sm-6">
                                <h3 class="my-3">{{ $product->name }}</h3>
                                <p>{{ $product->description }}</p>
                                <hr>
                                <h4 class="mt-3">Màu-Size hiện có</h4>
                                <p class="text-muted">
                                    @foreach ($product->detailProducts as $detailProduct)
                                        <button
                                            style="border-color:{{ $detailProduct->color->code }}">{{ $detailProduct->color->name }}-{{ $detailProduct->size->name }}</button>
                                    @endforeach
                                </p>

                                <h4 class="mt-3">Nhãn Hiệu</h4>
                                <p class="text-muted">{{ $product->brand->name }}</p>

                                <h4 class="mt-3">Danh mục</h4>
                                <p class="text-muted">{{ $product->category->name }}</p>

                                <div class="bg-gray py-2 px-3 mt-4">
                                    <h2 class="mb-0">
                                        Giá: {{ number_format($product->price) }} VND
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6 mt-3">
                                <a href="{{ route('admin.product.thumb.index', ['product' => $product->id]) }}"
                                    class="border-0 btn btn-outline-success mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa-solid fa-square-person-confined"></i>
                                    </span>
                                    <span>Quản lí ảnh</span>
                                </a>
                            </div>

                            <div class="col-12 col-sm-6 mt-3">
                                <a href="{{ route('admin.product.detail.index', ['product' => $product->id]) }}"
                                    class="border-0 btn btn-outline-success mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa-solid fa-pen-ruler"></i>
                                    </span>
                                    <span>Quản lí size và màu sản phẩm</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
