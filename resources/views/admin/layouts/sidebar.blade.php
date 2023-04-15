    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('homepage')}}" class="brand-link">
            <img src="/template/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">CDC-AMAI</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-tags"></i>
                            <p>
                                Danh mục sản phẩm
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.categories.create')}}" class="nav-link">
                                    <i class="fas fa-folder-plus"></i>
                                    <p>Thêm danh mục</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.categories.index')}}" class="nav-link">
                                    <i class="fas fa-folder-open"></i>
                                    <p>Quản lý danh mục</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-industry"></i>
                            <p>
                                Nhà cung cấp
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.brands.create')}}" class="nav-link">
                                    <i class="fas fa-folder-plus"></i>
                                    <p>Thêm nhà cung cấp</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.brands.index')}}" class="nav-link">
                                    <i class="fas fa-folder-open"></i>
                                    <p>Quản lý nhà cung cấp</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-images"></i>
                            <p>
                                Banner
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.sliders.create')}}" class="nav-link">
                                    <i class="fas fa-folder-plus"></i>
                                    <p>Thêm banner</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.sliders.index')}}" class="nav-link">
                                    <i class="fas fa-folder-open"></i>
                                    <p>Quản lý banner</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-boxes-stacked"></i>
                            <p>
                                Sản phẩm
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.product.products.create') }}" class="nav-link">
                                    <i class="fas fa-folder-plus"></i>
                                    <p>Thêm sản phẩm</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.product.products.index') }}" class="nav-link">
                                    <i class="fas fa-folder-open"></i>
                                    <p>Quản lý sản phẩm</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-ticket"></i>
                            <p>
                                Mã giảm giá
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.vouchers.create')}}" class="nav-link">
                                    <i class="fas fa-folder-plus"></i>
                                    <p>Thêm mã giảm giá</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.vouchers.index')}}" class="nav-link">
                                    <i class="fas fa-folder-open"></i>
                                    <p>Quản lý mã giảm</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link active">
                            <i class="fas fa-scroll"></i>
                            <p>
                                Đơn hàng
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link active">
                            <i class="fas fa-users"></i>
                            <p>
                                Tài khoản khách hàng
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-gear"></i>
                            <p>
                                Cá nhân
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('change_password')}}" class="nav-link">
                                    <i class="fa-solid fa-key"></i>
                                    <p>Đổi mật khẩu</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('logout')}}" class="nav-link">
                                    <i class="fas fa-power-off"></i>
                                    <p>Đăng xuất</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
