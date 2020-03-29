<!-- BEGIN: HEADER -->
<header class="c-layout-header c-layout-header-4 c-layout-header-default-mobile" data-minimize-offset="80">

    <div class="c-topbar c-topbar-light">
        <div class="container">
            <!-- BEGIN: INLINE NAV -->
            <nav class="c-top-menu c-pull-left">
                <ul class="c-icons c-theme-ul">
                    <li>
                        <a href="{{$settings[4]}}" target="_blank">
                            <i class="icon-social-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{$settings[5]}}" target="_blank">
                            <i class="icon-social-youtube"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- END: INLINE NAV -->
            <!-- BEGIN: INLINE NAV -->
            <nav class="c-top-menu c-pull-right m-t-10">
                <ul class="c-links c-theme-ul">
                    <li>
                        Hotline: <a href="tel:<?php echo str_replace(".", "", $settings[2]); ?>"><?php echo $settings[2]; ?> (8h - 22h)</a>
                    </li>
                </ul>
            </nav>
            <!-- END: INLINE NAV -->
        </div>
    </div>

    <div class="c-navbar">
        <div class="container" style="padding-bottom:20px;">
            <!-- BEGIN: BRAND -->
            <div class="c-navbar-wrapper clearfix">
                <div class="c-brand c-pull-left">
                    <h1 style="margin: 0px;display: inline-block;">
                        <a href="{{Route('index')}}" class="c-logo" title="{{$settings['1']}}" alt="{{$settings['1']}}" style="margin-bottom: 20px;">
                            <img height="35px" src="public/client/assets/images/shophano.png" alt="" class="c-desktop-logo">
                            <img height="29px" src="public/client/assets/images/shophano.png" alt="" class="c-desktop-logo-inverse">
                            <img height="35px" src="public/client/assets/images/shophano.png" alt="" class="c-mobile-logo"> </a>
                    </h1>
                    <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                        <span class="c-line"></span>
                        <span class="c-line"></span>
                        <span class="c-line"></span>
                    </button>
                    <button class="c-topbar-toggler" type="button">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>

                </div>
                <!-- END: BRAND -->
                <!-- BEGIN: HOR NAV -->
                <!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU -->
                <!-- BEGIN: MEGA MENU -->
                <!-- Dropdown menu toggle on mobile: c-toggler class can be applied to the link arrow or link itself depending on toggle mode -->
                <style>
                    .c-menu-type-mega:hover {
                        transition-delay: 1s;
                    }

                    .c-layout-header.c-layout-header-4 .c-navbar .c-mega-menu>.nav.navbar-nav>li:focus>a:not(.btn),
                    .c-layout-header.c-layout-header-4 .c-navbar .c-mega-menu>.nav.navbar-nav>li:active>a:not(.btn),
                    .c-layout-header.c-layout-header-4 .c-navbar .c-mega-menu>.nav.navbar-nav>li:hover>a:not(.btn) {
                        color: #3a3f45;
                        background: #FAFAFA;
                    }
                </style>

                <!---- menu pc ------->
                <nav class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold d-none hidden-xs hidden-sm">

                    <ul class="nav navbar-nav c-theme-nav">

                        <li class="c-menu-type-classic"><a href="{{Route('index')}}" title="Trang chủ" class="c-link dropdown-toggle ">Trang chủ</a></li>

                        <li class="c-menu-type-classic"><a title="Nạp thẻ" title="Nạp thẻ" href="{{Route('nap_the')}}" class="c-link dropdown-toggle ">Nạp thẻ</a></li>

                        <li class="c-menu-type-classic"><a title="Dịch vụ" href="{{Route('dichvu.ngocrong.index')}}" class="c-link dropdown-toggle">Dịch vụ</a></li>

                        <li class="c-menu-type-classic"><a title="Lịch sử giao dịch" href="{{Route('giao-dich.dich-vu.index')}}" class="c-link dropdown-toggle ">Lịch sử</a></li>



                        @if(Auth::check())
                        <li>
                            <a href="{{Route('profile')}}" title="Trang cá nhân" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold"><i class="icon-user"></i>
                                {{Auth::user()->name}} - $
                                @if(Auth::user()->locked)
                                {{ 0 }}
                                @else
                                {{ number_format(Auth::user()->cash, 0) }}
                                @endif
                            </a>
                        </li>

                        <li><a href="{{Route('logout_user')}}" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold">Đăng xuất</a></li>
                        @else

                        <li><a href="{{Route('login')}}" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold"><i class="icon-user"></i> Đăng nhập</a></li>
                        <li><a href="{{Route('register')}}" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold"><i class="icon-key icons"></i> Đăng ký</a></li>
                        @endif

                    </ul>
                </nav>

                <!-----menu mobile-- -->
                <nav class="menu-main-mobile c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold hidden-md hidden-lg">

                    <ul class="nav navbar-nav c-theme-nav">


                        <li class="c-menu-type-classic"><a rel="" href="{{Route('index')}}" class="c-link dropdown-toggle ">Trang chủ</a>
                        </li>

                        <li class="c-menu-type-classic"><a title="Nạp thẻ" title="Nạp thẻ" href="{{Route('nap_the')}}" class="c-link dropdown-toggle ">Nạp thẻ</a>
                        </li>

                        <li class="c-menu-type-classic"><a title="Dịch vụ" href="{{Route('dichvu.ngocrong.index')}}" class="c-link dropdown-toggle">Dịch vụ</a>
                        </li>

                        <li class="c-menu-type-classic"><a title="Lịch sử giao dịch" href="{{Route('giao-dich.dich-vu.index')}}" class="c-link dropdown-toggle ">Lịch sử</a>
                        </li>

                        @if(Auth::check())
                        <li>
                            <a href="{{Route('profile')}}" title="Trang cá nhân" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold"><i class="icon-user"></i>
                                {{Auth::user()->name}} - $ {{Auth::user()->cash}}
                            </a>
                        </li>

                        <li><a href="{{Route('logout_user')}}" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold">Đăng xuất</a></li>
                        @else

                        <li><a href="{{Route('login')}}" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold"><i class="icon-user"></i> Đăng nhập</a></li>
                        <li><a href="{{Route('register')}}" class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold"><i class="icon-key icons"></i> Đăng ký</a></li>
                        @endif

                    </ul>
                </nav>

                <!-- END: MEGA MENU -->
                <!-- END: LAYOUT/HEADERS/MEGA-MENU -->
                <!-- END: HOR NAV -->
            </div>
            <!-- BEGIN: LAYOUT/HEADERS/QUICK-CART -->
            <!-- BEGIN: CART MENU -->
            <!-- END: CART MENU -->
            <!-- END: LAYOUT/HEADERS/QUICK-CART -->
        </div>
    </div>
</header>
<!-- END: HEADER -->