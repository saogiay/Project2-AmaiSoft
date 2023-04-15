@include('admin.layouts.head')

<body class="container" style="background-color: ghostwhite">
    <section class="text-center text-lg-start">
        <style>
            .cascading-right {
                margin-right: -30px;
            }

            @media (max-width: 991.98px) {
                .cascading-right {
                    margin-right: 0;
                }
            }
        </style>

        <!-- Jumbotron -->
        <div class="container py-4">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card cascading-right">
                        <div class="card-body p-5 shadow-5">
                            <div class="d-flex align-items-center mb-3 pb-1">
                                <img src="/img/amai.png" alt="" height="50px;">
                                <span class="h1 fw-bold mb-0 ml-2">Amaishop</span>
                            </div>
                            @yield('content')
                            @if ($message = Session::get('message'))
                            <div class="alert alert-info alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-5">
                    <img src="/img/jisoo.jpg" class="w-100 rounded shadow-4" alt="" />
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
</body>
<style>
    .error {
        color: red;
    }
</style>
@include('admin.layouts.end')