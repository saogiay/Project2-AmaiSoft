@extends('user.main')
@section('content')
    <div class="container-fluid mt-5">

        <!-- Shoping Cart -->
        <form action="{{ route('checkout') }}" class="bg0 p-t-75 p-b-85 " method="POST">
            @csrf
            <h1 class="text-center m-3"> GIỎ HÀNG</h1>
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Sản phẩm</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Đơn giá</th>
                                    <th class="column-4">Số lượng</th>
                                    <th class="column-5">Thành tiền</th>
                                </tr>

                                <div>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        @php
                                            $total += $cart->details->product->price * $cart->quantity;
                                        @endphp
                                        <tr class="table_row cart_items">
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <img src="{{ $cart->details->product->getThumb() }}" alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-2">
                                                <strong> {{ $cart->details->product->name }}</strong>
                                                <p>{{ $cart->details->size->name }};{{ $cart->details->color->name }}</p>
                                            </td>
                                            <td class="column-3">{{ number_format($cart->details->product->price) }} VND
                                            </td>
                                            <td class="column-4">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                        id="{{ $cart->details->id }}" min="0"
                                                        max="{{ $cart->details->quantity }}"
                                                        value="{{ number_format($cart->quantity) }}"
                                                        data-id="{{ $cart->details->id }}"
                                                        data-price="{{ $cart->details->product->price }}"
                                                        data-amount="{{ $cart->quantity }}">


                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="column-5">
                                                <p id="cart_price{{ $cart->details->id }}" class="cart_price"
                                                    data-id="">
                                                    {{ number_format($cart->quantity * $cart->details->product->price) }}
                                                    VND</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </div>

                            </table>
                        </div>

                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div class="col-12 d-flex">
                                <div class="flex-w flex-m m-r-20 m-tb-5 col-4">
                                    <input class=" cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                                        id="coupon" name="coupon" placeholder="Nhập mã giảm giá">
                                </div>
                                <span class="alert col-6" style="color: blue"></span>
                                <input
                                    class="flex-c-m cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10 col-2"
                                    type="button" value="XÁC NHẬN" onclick='useCoupon()'>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <dt class="cl2 p-b-30 text-bold">
                            THÔNG TIN ĐẶT HÀNG
                        </dt>

                        <div class="col-12 bor12 p-b-13">
                            <div class="row">
                                <div class="col-6">
                                    <span class=" text-muted cl2">
                                        Giảm giá:
                                    </span>
                                </div>

                                <div class="col-6">
                                    <span class="mtext-110 cl2" id="sale" style="color: red">
                                        0 VND
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 p-t-27 p-b-33">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class=" cl2">
                                        Tổng tiền:
                                    </h4>
                                </div>

                                <div class="col-6">
                                    <span class="mtext-110 cl2">
                                        <strong id="total">
                                            {{ number_format($total) }} VND
                                        </strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 border-top p-3">
                            <div class="row">
                                <div class=" col-12 mb-3">
                                    <select class="form-control form-select-sm" name="payment" id="payment"
                                        aria-label=".form-select-sm" style="background-color: rgb(147, 244, 211)">
                                        <option value="" selected>Phương thức thanh toán</option>
                                        <option value="1">Thanh toán online</option>
                                        <option value="2">Thanh toán khi nhận hàng</option>
                                    </select>
                                    @error('payment')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class=" col-12 mb-3">
                                    <select class="form-control form-select-sm" name="city" id="city"
                                        aria-label=".form-select-sm">
                                        <option value="" selected>Chọn tỉnh thành</option>
                                    </select>
                                    @error('city')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <select class="form-control form-select-sm" name="district" id="district"
                                        aria-label=".form-select-sm">
                                        <option value="" selected>Chọn quận huyện</option>
                                    </select>
                                    @error('district')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <select class="form-control form-select-sm" name="ward" id="ward"
                                        aria-label=".form-select-sm">
                                        <option value="" selected>Chọn phường xã</option>
                                    </select>
                                    @error('ward')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control" name="number" placeholder="Số nhà">
                                    @error('number')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="flex-c-m  cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            ĐẶT HÀNG
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    {{-- select dia chi giao hang --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "application/json",
        };
        var promise = axios(Parameter);
        promise.then(function(result) {
            renderCity(result.data);
        });

        function renderCity(data) {
            for (const x of data) {
                citis.options[citis.options.length] = new Option(x.Name, x.Name);
            }
            citis.onchange = function() {
                district.length = 1;
                ward.length = 1;
                if (this.value != "") {
                    const result = data.filter(n => n.Name === this.value);

                    for (const k of result[0].Districts) {
                        district.options[district.options.length] = new Option(k.Name, k.Name);
                    }
                }
            };
            district.onchange = function() {
                ward.length = 1;
                const dataCity = data.filter((n) => n.Name === citis.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

                    for (const w of dataWards) {
                        wards.options[wards.options.length] = new Option(w.Name, w.Name);
                    }
                }
            };
        }

        //cap nhat so luong trong gio hang

        $(document).ready(function() {
            $(document).on('change', '.num-product', function() {
                var quantity = $(this).val();
                var detail_product_id = $(this).data('id');
                var price = $(this).data('price');
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: 'PUT',
                    data: {
                        _method: 'PUT',
                        _token: "{{ csrf_token() }}",
                        quantity: quantity,
                        detail_product_id: detail_product_id
                    },
                    success: function($response) {

                        $(`#cart_price${detail_product_id}`).html(Intl.NumberFormat('en-VN')
                            .format(quantity * price) + ' VND');

                        $(`#provi${detail_product_id}`).val(quantity * price);
                        // console.log($response['total']);
                        $('#total').html(Intl.NumberFormat('en-VN')
                            .format($response['total']) + ' VND');
                    },
                    error: function($response) {}
                });
            });
        });

        //Nhap ma voucher
        function useCoupon() {
            var code = document.getElementById("coupon").value;
            $.ajax({
                url: "{{ route('use.voucher') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    code: code,
                },
                success: function($response) {
                    // console.log($response['voucher']);
                    if ($response['voucher'] == false) {
                        $('.alert').html('Mã giảm giá không tồn tại hoặc đã hết lượt sử dụng');
                    } else {
                        $('.alert').html('Bạn được giảm ' + $response['voucher']['discount'] +
                            '% giá trị đơn hàng');
                        $('#sale').html(Intl.NumberFormat('en-VN')
                            .format($response['voucher']['sale']) + ' VND');
                        $('#total').html(Intl.NumberFormat('en-VN')
                            .format($response['voucher']['total']) + ' VND');
                    }
                },
                error: function($response) {

                }
            });
        }
    </script>
@endsection
