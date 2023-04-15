@extends('user.main')
@section('content')
    <div class="container-fluid p-0">
        <img src="/img/bg-01.jpg" alt="" class="d-block w-100">
        <div class="col-md-12 d-flex" style="min-height: 80vh">
            <div class="col-3 m-auto">
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-outline-info" type="button">
                        <a href="{{route('account')}}" class="text-dark">
                            <i class="fa-solid fa-sliders"></i>
                            Thông tin tài khoản
                        </a>
                    </button>
                    <button class="btn btn-outline-info" type="button">
                        <a href="{{route('wallet')}}" class="text-dark">
                            <i class="fa-solid fa-wallet"></i>
                            Ví voucher
                        </a>
                    </button>
                    <button class="btn btn-outline-info" type="button">
                        <a href="{{route('order')}}" class="text-dark">
                            <i class="fa-sharp fa-solid fa-scroll"></i>
                            Quản lý đơn hàng
                        </a>
                    </button>
                </div>
            </div>
            <div class="col-9 m-auto border-start" style="height: 100vh ">
                @yield('infomation')
            </div>            
        </div>
    </div>
@endsection