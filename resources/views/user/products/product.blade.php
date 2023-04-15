@extends('user.main')
@section('content')
    <div class="container mt-5">
        <section class="sec-product-detail bg0 p-t-65 p-b-60">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-5 p-b-30">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($product->thumbs as $key=>$thumb)
                                <div class="carousel-item {{($key == 0) ? "active" : "";}}" >
                                    <div class="slick3 gallery-lb">
                                        <div class="item-slick3" data-thumb="src={{ asset( $thumb->url) }}">
                                            <div class="wrap-pic-w pos-relative">
                                                <img alt="IMG-PRODUCT" style="width: 120%" src="{{ asset( $thumb->url) }}" >
                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                    href="{{ asset( $thumb->url) }}">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-7 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h3 class="cl2 js-name-detail p-b-14">
                                {{ $product->name }}
                            </h3>

                            <span class="mtext-106 cl2">
                                {{ number_format($product->price) }} VND
                            </span>

                            <!-- Form -->
                            <form action="{{route('addCart',$product->id)}}" method="POST">
                            @csrf
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Kích cỡ
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="form-control" name="size_id" id="choose_size" data-id="{{ $product->id }}">
                                                <option value="">Chọn kích cỡ</option>
                                                @foreach ($sizes as $size)
                                                    <option value="{{ $size->size->id }}">{{ $size->size->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        @error('size_id')
                                            <span style="color: red">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Màu sắc
                                    </div>
                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="form-control" name="detail_product_id" id="choose_color">
                                                <option value="">Chọn màu sắc</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        @error('detail_product_id')
                                        <span style="color: red">{{$message}}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down  flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>
                                            <input class="mtext-104 cl3 txt-center num-product" type="number" min="1"
                                                name="quantity" value="1">
                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                        <button class="flex-c-m cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											Thêm vào giỏ hàng
										</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if (session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif
    
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">
                            Loại sản phẩm hoặc số lượng mua không phù hợp.Vui lòng kiểm tra lại.
                        </div>
                    @endif
                        </div>
                    </div>
                </div>
                <div class="bor10 m-t-50 p-t-43 p-b-40">
                    <!-- Tab01 -->
                    <div class="tab01">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item p-b-10">
                                <a class="nav-link active" data-toggle="tab" href="#description" role="tab">
                                    Mô tả sản phẩm
                                </a>
                            </li>

                            <li class="nav-item p-b-10">
                                <a class="nav-link" data-toggle="tab" href="#information" role="tab">
                                    Bảng size tiêu chuẩn
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-t-43">
                            <!-- - -->
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <div class="how-pos2 p-lr-15-md">
                                    <p class=" cl6">
                                        {{$product->description}}   
                                    </p>
                                </div>
                            </div>

                            <!-- - -->
                            <div class="tab-pane fade" id="information" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                        <img src="/storage/images/products/sizes/size.jpg" alt="">
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
                <span class="cl6 p-lr-25">
                    Danh mục: {{ $product->category->name }}
                </span>

                <span class="cl6 p-lr-25">
                    Nhãn hiệu: {{ $product->brand->name }}
                </span>
            </div>
        </section>
    </div>
@endsection

@section('js')
<script language="JavaScript" type="text/javascript" >
        $(document).ready(function() {
            $(document).on('change', '#choose_size', function() {
                var size_id = $(this).val();
                var id = $(this).data('id');

                $.ajax({
                    url: "{{ route('product.size') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        size_id: size_id,
                        id: id
                    },
                    success: function($data) {
                        $('#choose_color').empty()
                        $('#choose_color').append($data)
                    },
                });
            });
        })

    </script>
@endsection
