<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{asset('admins/index3.html')}}" class="brand-link">
        <img src="{{asset('admins/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">ShopRunner</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('admins/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name ?? 'Guest' }}
                </a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="        overflow: hidden;">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
{{--                <li class="nav-item has-treeview menu-open">--}}
{{--                    <a href="#" class="nav-link active">--}}
{{--                        <i class="nav-icon fas fa-tachometer-alt"></i>--}}
{{--                        <p>--}}
{{--                            Starter Pages--}}
{{--                            <i class="right fas fa-angle-left"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="#" class="nav-link active">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Active Page</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="#" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Inactive Page</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
                <li class="nav-item" id="category">
                    <a href="{{route('categories')}}" class="nav-link">
                        <i class="fas fa-th-list"></i>
                        <p style="    white-space: nowrap;">
                            Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="brand">
                    <a href="{{route('brands')}}" class="nav-link">
                        <i class="fas fa-flag"></i>
                        <p style="    white-space: nowrap;">
                             Brands
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="product">
                    <a href="{{route('products')}}" class="nav-link">
                        <i class="fas fa-warehouse"></i>
                        <p style="    white-space: nowrap;">
                             Products
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="order">
                    <a href="{{route('orders')}}" class="nav-link">
                        <i class="fas fa-cart-plus"></i>
                        <p style="    white-space: nowrap;">
                             Orders
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="productComment">
                    <a href="{{route('productComments')}}" class="nav-link">
                        <i class="fas fa-star-half-alt"></i>
                        <p style="    white-space: nowrap;">
                             Reviews
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="coupon">
                    <a href="{{route('coupons')}}" class="nav-link">
                        <i class="fas fa-receipt"></i>
                        <p style="    white-space: nowrap;">
                            Vouchers
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="user">
                    <a href="{{route('users')}}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p style="    white-space: nowrap;">
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="role">
                    <a href="{{route('users')}}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p style="    white-space: nowrap;">
                            Roles
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="permission">
                    <a href="{{route('permissions')}}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p style="    white-space: nowrap;">
                            Permissions
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
