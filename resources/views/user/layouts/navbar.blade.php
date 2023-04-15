<!-- Header -->
<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">
                <!-- Logo desktop -->
                <a href="{{route('homepage')}}" class="logo">
                    <img src="/img/logo.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="{{route('homepage')}}">Trang chủ</a>
                        </li>
                        <li class="label1" data-label1="hot">
                            <a href="#">Danh mục</a>
                            <ul class="sub-menu">

                                {!! \App\Helpers\Helper::danhmuc($categories) !!}

                            </ul>
                        </li>
                        <li>
                            <a href="{{route('intro')}}">Giới thiệu</a>
                        </li>
                        <li>
                            <a href="{{route('contact')}}">Liên hệ</a>
                        </li>
                    </ul>
                </div>
                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>
                    <div class="d-flex">
                        @auth
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                        data-notify="{{Auth::user()->carts->count()}}">
                        <a href="{{route('cart')}}" class="text-dark">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </a>
                        </div>
                        <div class="dropdown icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                            <a href="{{route('account')}}" class="text-dark" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user fa-sm"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>
                                <li><a class="dropdown-item" href="{{ route('account') }}">Thông tin tài khoản</a></li>
                            </ul>
                        </div>
                        @endauth
                        @guest
                        <div class="dropdown icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                        <a href="{{route('login')}}" class="text-dark">
                            <i class="fa-solid fa-user fa-sm"></i>
                        </a>
                    </div>
                        @endguest
                    </div>
                    @auth
                    @if (Auth::user()->isAdmin())
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                        <a href="{{route('admin.index')}}" class="text-dark">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                    </div>
                    @endif
                    @endauth
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="index.html"><img src="/img/logo.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                <i class="fa-solid fa-user-gear"></i>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">

        <ul class="main-menu-m">
            <li>
                <a href="{{route('homepage')}}">Trang chủ</a>
            </li>

            <li>
                <a href="index.html">Danh mục</a>
                <ul class="sub-menu-m">
                    {!! \App\Helpers\Helper::danhmuc($categories) !!}
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li>
                <a href="{{route('intro')}}">Giới thiệu</a>
            </li>

            <li>
                <a href="{{route('contact')}}">Liên hệ</a>
            </li>

        </ul>
    </div>
</header>
