<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!--- ----------Config ----------------->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-cogs"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Cài đặt hệ thống</span>
                <div class="dropdown-divider"></div>
                <a href="{{Route('logout_admin')}}" class="dropdown-item" style="text-align: center;">
                    <i class="fa fa-sign-out-alt"></i> Đăng xuất
                </a>
                <div class="dropdown-divider"></div>
            </div>
        </li>
        <li style="display:none;" class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{Route('index')}}" class="brand-link">
        <img src="public/client/assets/images/shophano.png" alt="Shophano" class="brand-image elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Quản trị</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="public/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{Route('profile')}}" class="d-block">
                    @if(Session::has('admin_name'))
                    {{Session::get('admin_name')}}
                    @endif
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{Route('admin.home')}}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Bảng điều khiển
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Quản lý người dùng
                        </p>
                    </a>
                <li class="nav-item child-menu">
                    <a href="{{route('admin.manage-users')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>Danh sách tài khoản</p>
                    </a>
                </li>
                <li class="nav-item child-menu">
                    <a href="{{route('admin.create-users')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>Thêm mới tài khoản</p>
                    </a>
                </li>
                <li class="nav-item child-menu">
                    <a href="{{Route('admin.roles')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>Phân quyền</p>
                    </a>
                </li>
                </li>

                <li style="display: none;" class="nav-item has-treeview">
                    <a href="{{Route('admin.slideshow')}}" class="nav-link">
                        <i class="fas fa-sliders-h"></i>
                        <p>
                            Quản lý silde
                        </p>
                    </a>
                </li>

                <li style="display: none;" class="nav-item has-treeview">
                    <a href="{{Route('admin.danhmuc')}}" class="nav-link">
                        <i class="fa fa-list-alt"></i>
                        <p>
                            Quản lý danh mục
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link">
                        <i class="fas fa-gamepad"></i>
                        <p>
                            Tài khoản game
                        </p>
                    </a>
                <li style="display: none;" class="nav-item">
                    <a href="{{Route('admin.tk_pubg')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>PUBG</p>
                    </a>
                </li>
                <li style="display: none;" class="nav-item">
                    <a href="{{Route('admin.tk_lienquan')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>Liên Quân</p>
                    </a>
                </li>
                <li style="display: none;" class="nav-item">
                    <a href="{{Route('admin.tk_freefire')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>Free Fire</p>
                    </a>
                </li>
                <li class="nav-item child-menu">
                    <a href="{{Route('admin.tk_ngocrong')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>Ngọc Rồng</p>
                    </a>
                </li>
                </li>
                <li class="nav-item has-treeview">
                    <a class="nav-link">
                        <i class="fas fa-random"></i>
                        <p>
                            Random
                        </p>
                    </a>
                <li class="nav-item child-menu">
                    <a href="{{Route('admin.tk_random')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>Danh sách</p>
                    </a>
                </li>
                </li>
                <li class="nav-item has-treeview">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Giao Dịch
                        </p>
                    </a>
                <li class="nav-item child-menu">
                    <a href="{{Route('admin.giao-dich.history_service')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>Dịch vụ
                            <span id="numberdichvu" class="soluong">{{$numberDichVu}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item child-menu">
                    <a href="{{Route('admin.giao-dich.history_transaction')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>Lịch sử giao dịch</p>
                    </a>
                </li>
                <li class="nav-item child-menu">
                    <a href="{{Route('admin.giao-dich.history_buy')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>Lịch sử mua</p>
                    </a>
                </li>
                <li class="nav-item child-menu">
                    <a href="{{Route('admin.giao-dich.history_charge')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>Lịch sử nạp thẻ</p>
                    </a>
                </li>
                <li class="nav-item child-menu">
                    <a href="{{route('admin.giao-dich.history_whell')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>Lịch sử quay</p>
                    </a>
                </li>
                </li>
                <li class="nav-item has-treeview">
                    <a class="nav-link">
                        <i class="fab fa-ubuntu"></i>
                        <p>
                            Cài đặt
                        </p>
                    </a>

                <li class="nav-item child-menu">
                    <a href="{{Route('admin.settings')}}" class="nav-link">
                        <i class="fa fa-plus" style="font-size:10px!important;"></i>
                        <p>Cài đặt trang web</p>
                    </a>
                </li>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside>

<style type="text/css">
    .child-menu {
        padding-left: 2.3em;
    }

    .soluong {
        background-color: #df2935;
        border-radius: 24px;
        box-shadow: -1px 1px 2px 0 rgba(0, 0, 0, .3);
        color: #fff;
        cursor: default;
        font-size: 15px;
        width: auto;
        height: 20px;
        line-height: 20px;
        position: absolute;
        text-align: center;
        right: 95px;
        top: 0;
    }
</style>