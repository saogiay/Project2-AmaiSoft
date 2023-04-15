<!DOCTYPE html>
<html lang="en">
    @include('admin.layouts.head')
    <body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
        @include('admin.layouts.navbar')
        @include('admin.layouts.sidebar')

            <div class="content-wrapper ">
                @yield('content')
            </div>

        @include('admin.layouts.footer')
        @include('admin.layouts.end')
    </body>
</html>
