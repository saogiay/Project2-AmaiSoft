@extends('user.infomation')

@section('title', 'Thanh Toán')

@section('infomation')
    <!-- Checkout begin -->
    <div class="checkout-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4>
                        {{ $notification }}
                    </h4>
                    <a href="{{ route('homepage') }}" class="primary-btn mt-5">Tiếp tục mua hàng</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout end -->
@endsection
