@extends('user.masterlayout.master')

@section('content')

<!--------------- slideshow------------->
@if(isset($slideshows) && count($slideshows)>0)
<div class="c-content-box">
    <div id="slider" class="owl-theme section section-cate slideshow_full_width ">
        <div id="slide_banner" class="owl-carousel">
            @foreach($slideshows as $slide)
            <div class="item">
                <a href="{{$slide->link}}" target="_blank" title="{{$slide->title}}" alt="{{$slide->title}}">
                    <img src="public/client/assets/images/{{$slide->image}}" alt="*">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!---------------End slideshow------------->

<!-- BEGIN: DICH VU NOI BAT -->
<div class="c-content-box c-size-md c-bg-white">
    <div class="container">
        <!-- Begin: Testimonals 1 component -->
        <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">
            <!-- Begin: Title 1 component -->
            <div class="c-content-title-1">
                <h3 class="c-center c-font-uppercase c-font-bold">Dịch Vụ Nổi Bật</h3>
                <div class="c-line-center" style="width: 100px; height: 1px; margin: 20px auto; border-bottom: 4px solid #32c5d2;"></div>
            </div>
            <div class="owl-carousel owl-theme c-theme owl-bordered1 c-owl-nav-center" data-items="6" data-desktop-items="4" data-desktop-small-items="3" data-tablet-items="3" data-mobile-items="2" data-slide-speed="5000" data-rtl="false">

                <div class="item hover" style="padding-top: 10px;padding-bottom:10px;">
                    <a href="{{Route('ngoc_rong','all')}}"><img src="public/client/assets//images/nicknro.jpg" alt="Mua nick Ngọc Rồng"/ style="width: 80%;">
                    </a>
                </div>


                <div class="item hover" style="padding-top: 10px;padding-bottom:10px;">
                    <a href="{{Route('dichvu.ngocrong.index')}}"><img src="public/client/assets//images/danhmuc.png" alt="Dịch vụ" style="width: 80%;">
                    </a>
                </div>

                <div class="item hover" style="padding-top: 10px;padding-bottom:10px;">
                    <a href="{{Route('nap_the')}}"><img src="public/client/assets/images/napthe2.jpg" alt="Nạp thẻ cào" style="width: 80%;">
                    </a>
                </div>

                <div class="item hover" style="padding-top: 10px;padding-bottom:10px;">
                    <a href="#" data-toggle="modal" data-target="#atm_modal"><img src="public/client/assets/images/napatm2.jpg" alt="Nạp Ví ATM"/ style="width: 80%;">
                    </a>
                </div>

            </div>
            <!-- End-->
        </div>
        <!-- End-->
    </div>
</div>
<!-- END: DICH VU NOI BAT -->

<!-- BEGIN: DANH SACH GAME -->
<div class="c-content-box c-size-md c-bg-white" style="margin-top: 50px;">
    <div class="container">
        <!-- Begin: Testimonals 1 component -->
        <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">
            <!-- Begin: Title 1 component -->
            <div class="c-content-title-1">
                <h3 class="c-center c-font-uppercase c-font-bold">Danh mục game</h3>
                <div class="c-line-center" style="width: 100px; height: 1px; margin: 20px auto; border-bottom: 4px solid #32c5d2;"></div>
            </div>
            <div class="row game-list">

                <div class="col-sm-3 col-xs-12 col-md-3" style="margin-bottom:10px;">
                    <div class="classWithPad">
                        <div class="news_image">
                            <a href="{{Route('ngoc_rong')}}" class=""><img src="public/client/assets//images/ngocrongonline.jpg"></a>
                        </div>
                        <div class="news_title"><a style="color: black!important;" href="{{Route('ngoc_rong')}}">Bán Nick Ngọc Rồng</a></div>
                        <div class="news_description" style="font-size: 15px!important;">
                            <p>
                                Số Tài Khoản Hiện Có: 163,130
                            </p>
                            <p>
                                Đã bán: 164,802
                            </p>
                        </div>
                        <div class="a-more" style="margin-bottom: 20px;">
                            <div class="row">

                                <div class="col-xs-12">
                                    <div class="view button-hover">
                                        <a href="{{Route('ngoc_rong')}}">Xem tất cả</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-xs-12 col-md-3" style="margin-bottom:10px;">
                    <div class="classWithPad">
                        <div class="news_image">
                            <a href="{{Route('vong_quay_vang_50k')}}" class=""><img src="public/client/assets//images/quayvang50k.jpg"></a>
                        </div>
                        <div class="news_title"><a style="color: black!important;" href="{{Route('vong_quay_vang_50k')}}">VÒNG QUAY VÀNG 50K</a></div>
                        <div class="news_description" style="font-size: 15px!important;">
                            <p>
                                Nick đã trúng: 12,753
                            </p>
                            <p>
                                Người quay: 49,053
                            </p>
                        </div>
                        <div class="a-more" style="margin-bottom: 20px;">
                            <div class="row">

                                <div class="col-xs-12">
                                    <div class="view">
                                        <a href="{{Route('vong_quay_vang_50k')}}">Xem tất cả</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-xs-12 col-md-3" style="margin-bottom:10px;">
                    <div class="classWithPad">
                        <div class="news_image">
                            <a href="{{Route('vong_quay')}}" class=""><img src="public/client/assets//images/vongquay50k.jpg"></a>
                        </div>
                        <div class="news_title"><a style="color: black!important;" href="{{Route('vong_quay')}}">VÒNG QUAY NICK VIP 50K</a></div>
                        <div class="news_description" style="font-size: 15px!important;">
                            <p>
                                Nick đã trúng: 64,130
                            </p>
                            <p>
                                Người quay: 67,122
                            </p>
                        </div>
                        <div class="a-more" style="margin-bottom: 20px;">
                            <div class="row">

                                <div class="col-xs-12">
                                    <div class="view">
                                        <a href="{{Route('vong_quay')}}">Xem tất cả</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-xs-12 col-md-3" style="margin-bottom:10px;">
                    <div class="classWithPad">
                        <div class="news_image">
                            <a href="{{Route('vong_quay_vang_20k')}}" class=""><img src="public/client/assets//images/quayvang20k.jpg"></a>
                        </div>
                        <div class="news_title"><a style="color: black!important;" href="{{Route('vong_quay_vang_20k')}}">VÒNG QUAY VÀNG 20K</a></div>
                        <div class="news_description" style="font-size: 15px!important;">
                            <p>
                                Nick đã trúng: 32,324
                            </p>
                            <p>
                                Người quay: 68,624
                            </p>
                        </div>
                        <div class="a-more" style="margin-bottom: 20px;">
                            <div class="row">

                                <div class="col-xs-12">
                                    <div class="view">
                                        <a href="{{Route('vong_quay_vang_20k')}}">Xem tất cả</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End-->
        </div>
        <!-- End-->
    </div>
</div>
<!-- END: DANH SACH GAME -->

<!-- BEGIN: DICH VU -->
<div class="c-content-box c-size-md c-bg-white">
    <div class="container">
        <!-- Begin: Testimonals 1 component -->
        <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">
            <!-- Begin: Title 1 component -->
            <div class="c-content-title-1" style="margin-bottom: 80px!important;">
                <h3 class="c-center c-font-uppercase c-font-bold">Danh mục dịch vụ</h3>
                <div class="c-line-center" style="width: 100px; height: 1px; margin: 20px auto; border-bottom: 4px solid #32c5d2;"></div>
            </div>
            <div class="row row-flex-safari game-list">

                <div class="col-sm-4 col-xs-6 p-5">
                    <div class="classWithPad" style="width: 90%;">
                        <div class="image">
                            <a href="{{Route('dichvu.ngocrong.index')}}">
                                <img src="public/client/assets//images/danhmucdichvu.jpg">
                            </a>
                        </div>
                        <div class="news_title"><a style="color: black!important;" href="{{Route('dichvu.ngocrong.index')}}">DỊCH VỤ NGỌC RỒNG</a></div>
                        <div class="news_description">
                            <p>Dịch vụ hỗ trợ: 8</p>
                            <p>Giao dịch: 157,798</p>
                        </div>
                        <div class="a-more" style="margin-bottom: 20px;">
                            <div class="row">

                                <div class="col-xs-12">
                                    <div class="view">
                                        <a href="{{Route('dichvu.ngocrong.index')}}">Xem tất cả</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- End-->
        </div>
        <!-- End-->
    </div>
</div>
<!-- END: DICH VU -->

<!-- BEGIN: GAME RANDOM -->
<div class="c-content-box c-size-md c-bg-white">
    <div class="container">
        <!-- Begin: Testimonals 1 component -->
        <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">
            <!-- Begin: Title 1 component -->
            <div class="c-content-title-1">
                <h3 class="c-center c-font-uppercase c-font-bold">Danh mục game random</h3>
                <div class="c-line-center" style="width: 100px; height: 1px; margin: 20px auto; border-bottom: 4px solid #32c5d2;"></div>
            </div>
            <div class="row  game-list">

                <div class="col-sm-3 col-xs-6 p-5">
                    <div class="classWithPad" style="margin-right: 10px;">
                        <div class="news_image">
                            <a href="{{Route('random.index','all')}}" class=""><img src="public/client/assets//images/ngocrongsocap.jpg"></a>
                        </div>
                        <div class="news_title"><a href="{{Route('random.index','all')}}">THỬ VẬN MAY NGỌC RỒNG 20K</a></div>
                        <div class="news_description">
                            <p>
                                Số tài khoản : 17,770
                            </p>
                            <p>
                                Đã bán : 17,509
                            </p>
                        </div>
                        <div class="a-more" style="margin-bottom: 20px;">
                            <div class="row">

                                <div class="col-xs-12">
                                    <div class="view">
                                        <a href="{{Route('random.index','all')}}">Xem tất cả</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-xs-6 p-5">
                    <div class="classWithPad" style="margin-left: 10px;">
                        <div class="news_image">
                            <a href="{{Route('random.index','tam-trung')}}" class=""><img src="public/client/assets//images/ngocrongcaocap.jpg"></a>
                        </div>
                        <div class="news_title"><a href="{{Route('random.index','tam-trung')}}">THỬ VẬN MAY NGỌC RỒNG 50K</a></div>
                        <div class="news_description">
                            <p>
                                Số tài khoản : 2,241
                            </p>
                            <p>
                                Đã bán : 2,067
                            </p>
                        </div>
                        <div class="a-more" style="margin-bottom: 20px;">
                            <div class="row">

                                <div class="col-xs-12">
                                    <div class="view">
                                        <a href="{{Route('random.index','tam-trung')}}">Xem tất cả</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End-->
        </div>
        <!-- End-->
    </div>
</div>
<!-- END: GAME RANDOM -->

<!-- BEGIN: TOP NAP THE -->
<div class="c-content-box c-size-md c-bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="box box-danger collapsed-box box-solid" style="padding: 0;">
                    <div class="box-header with-border">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a data-toggle="tab" href="#top10">
                                    <h3 class="box-title">TOP NẠP THẺ</h3>
                                </a></li>
                            <li><a data-toggle="tab" href="#phanthuong">
                                    <h3 class="box-title">PHẦN THƯỞNG</h3>
                                </a></li>
                        </ul>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="min-height: 480px;">
                        <div class="tab-content">
                            <div id="top10" class="tab-pane fade in active">
                                <div id="evenstop10" style="color: #505050;">

                                    <div class="row">
                                        <div class="col-xs-8" style="padding-right: 0px;">
                                            <label class="control-label">
                                                <span class="fa-stack"><span class="fa fa-circle fa-stack-2x color_1"></span><strong class="fa-stack-1x" style="color:white;">1</strong></span>
                                                <img src="https://graph.facebook.com/412828736333268/picture?width=250&height=250" class="img-top" alt="" title="" media-simple="true">Văn Phúc </label>
                                        </div>
                                        <div class="col-xs-4" style="text-align: right;">
                                            <label class="control-label"><button type="button" class="btn btn-danger tops">15,500,000</button></label>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-8" style="padding-right: 0px;">
                                            <label class="control-label">
                                                <span class="fa-stack"><span class="fa fa-circle fa-stack-2x color_2"></span><strong class="fa-stack-1x" style="color:white;">2</strong></span>
                                                <img src="https://graph.facebook.com/149078846321964/picture?width=250&height=250" class="img-top" alt="" title="" media-simple="true">Nguyễn Mạnh </label>
                                        </div>
                                        <div class="col-xs-4" style="text-align: right;">
                                            <label class="control-label"><button type="button" class="btn btn-danger tops">10,300,000</button></label>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-8" style="padding-right: 0px;">
                                            <label class="control-label">
                                                <span class="fa-stack"><span class="fa fa-circle fa-stack-2x color_3"></span><strong class="fa-stack-1x" style="color:white;">3</strong></span>
                                                <img src="https://graph.facebook.com/136143017726149/picture?width=250&height=250" class="img-top" alt="" title="" media-simple="true">Nguyễn Đặng Khánh </label>
                                        </div>
                                        <div class="col-xs-4" style="text-align: right;">
                                            <label class="control-label"><button type="button" class="btn btn-danger tops">3,250,000</button></label>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-8" style="padding-right: 0px;">
                                            <label class="control-label">
                                                <span class="fa-stack"><span class="fa fa-circle fa-stack-2x color_4"></span><strong class="fa-stack-1x" style="color:white;">4</strong></span>
                                                <img src="https://graph.facebook.com/130124758375044/picture?width=250&height=250" class="img-top" alt="" title="" media-simple="true">Lê Văn Long </label>
                                        </div>
                                        <div class="col-xs-4" style="text-align: right;">
                                            <label class="control-label"><button type="button" class="btn btn-danger tops">3,120,000</button></label>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-8" style="padding-right: 0px;">
                                            <label class="control-label">
                                                <span class="fa-stack"><span class="fa fa-circle fa-stack-2x color_5"></span><strong class="fa-stack-1x" style="color:white;">5</strong></span>
                                                <img src="https://graph.facebook.com/541973219657079/picture?width=250&height=250" class="img-top" alt="" title="" media-simple="true">Đỗ Nhật Hào </label>
                                        </div>
                                        <div class="col-xs-4" style="text-align: right;">
                                            <label class="control-label"><button type="button" class="btn btn-danger tops">3,100,000</button></label>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-8" style="padding-right: 0px;">
                                            <label class="control-label">
                                                <span class="fa-stack"><span class="fa fa-circle fa-stack-2x color_6"></span><strong class="fa-stack-1x" style="color:white;">6</strong></span>
                                                <img src="https://graph.facebook.com/379502502933481/picture?width=250&height=250" class="img-top" alt="" title="" media-simple="true">Quang Nguyen </label>
                                        </div>
                                        <div class="col-xs-4" style="text-align: right;">
                                            <label class="control-label"><button type="button" class="btn btn-danger tops">2,100,000</button></label>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-8" style="padding-right: 0px;">
                                            <label class="control-label">
                                                <span class="fa-stack"><span class="fa fa-circle fa-stack-2x color_7"></span><strong class="fa-stack-1x" style="color:white;">7</strong></span>
                                                <img src="https://graph.facebook.com/143856836872327/picture?width=250&height=250" class="img-top" alt="" title="" media-simple="true">Cu Ti </label>
                                        </div>
                                        <div class="col-xs-4" style="text-align: right;">
                                            <label class="control-label"><button type="button" class="btn btn-danger tops">2,100,000</button></label>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-8" style="padding-right: 0px;">
                                            <label class="control-label">
                                                <span class="fa-stack"><span class="fa fa-circle fa-stack-2x color_8"></span><strong class="fa-stack-1x" style="color:white;">8</strong></span>
                                                <img src="https://graph.facebook.com/521126465292709/picture?width=250&height=250" class="img-top" alt="" title="" media-simple="true">Văn Mạnh </label>
                                        </div>
                                        <div class="col-xs-4" style="text-align: right;">
                                            <label class="control-label"><button type="button" class="btn btn-danger tops">2,100,000</button></label>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-8" style="padding-right: 0px;">
                                            <label class="control-label">
                                                <span class="fa-stack"><span class="fa fa-circle fa-stack-2x color_9"></span><strong class="fa-stack-1x" style="color:white;">9</strong></span>
                                                <img src="https://graph.facebook.com/2405933493018756/picture?width=250&height=250" class="img-top" alt="" title="" media-simple="true">Lê Anh </label>
                                        </div>
                                        <div class="col-xs-4" style="text-align: right;">
                                            <label class="control-label"><button type="button" class="btn btn-danger tops">2,000,000</button></label>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-8" style="padding-right: 0px;">
                                            <label class="control-label">
                                                <span class="fa-stack"><span class="fa fa-circle fa-stack-2x color_10"></span><strong class="fa-stack-1x" style="color:white;">10</strong></span>
                                                <img src="https://graph.facebook.com/154465888965588/picture?width=250&height=250" class="img-top" alt="" title="" media-simple="true">Cong Thinh </label>
                                        </div>
                                        <div class="col-xs-4" style="text-align: right;">
                                            <label class="control-label"><button type="button" class="btn btn-danger tops">2,000,000</button></label>
                                        </div>
                                    </div>

                                </div>
                                <style type="text/css">
                                    .img-top {
                                        border-radius: 50%;
                                        width: 34px;
                                        margin-right: 5px;
                                    }

                                    .color {
                                        color: #000
                                    }

                                    .color_1 {
                                        color: red
                                    }

                                    .color_2 {
                                        color: #07840d
                                    }

                                    .color_3 {
                                        color: #fc9605
                                    }

                                    .color_4 {
                                        color: #4fb8ec
                                    }
                                </style>
                            </div>
                            <div id="phanthuong" class="tab-pane fade">
                                <div class="box-body" style="color: #505050;padding:20px;min-height: 280px;line-height: 0.8;">
                                    <p><strong>ĐÃ TRAO GIẢI TOP THÁNG 12 AE TIẾP TỤC ĐUA THÁNG 1</strong></p>

                                    <p><strong>TOP 1</strong>. <strong><span style="color:#e74c3c">BỘ NGỌC RỒNG 1 SAO VÀ 500 TRIỆU VÀNG</span></strong></p>

                                    <p><strong>TOP 2</strong>. <span style="color:#27ae60"><strong>NICK BÔNG TAI CÓ ĐỆ TỬ TÙY CHỌN</strong></span>&nbsp;</p>

                                    <p><strong>TOP 3</strong>. <strong><span style="color:#9b59b6">200 TRIỆU VÀNG</span></strong></p>

                                    <p><strong>TOP 4</strong>. <strong><span style="color:#2980b9">100 TRIỆU VÀNG</span></strong>&nbsp;</p>

                                    <p><strong>TOP 5</strong>. <span style="color:#c0392b"><strong>70 TRIỆU VÀNG</strong></span></p>

                                    <p><strong>TOP 6</strong>. <span style="color:#2c3e50"><strong>50 TRIỆU VÀNG</strong></span></p>

                                    <p><strong>TOP 7</strong>. <strong>30 TRIỆU VÀNG</strong></p>

                                    <p>&nbsp;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-lg-6">
                <div class="box box-danger collapsed-box box-solid" style="padding: 0;">
                    <div class="box-header with-border">
                        <h3 class="box-title">LỊCH SỬ GIAO DỊCH</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="color: #505050;padding:20px;min-height: 480px;line-height: 1.8;font-size: 15px;">
                        <marquee style="color:#000;min-height: 433px;max-height: 433px;" direction="up" scrollamount="2">

                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">Tuấn Láo</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(500000); ?>đ</span>
                            </p>
                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">Hoàng Gaming</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(1000000); ?>đ</span>
                            </p>
                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">Phước MT</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(2000000); ?>đ</span>
                            </p>
                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">Hữu Tài</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(200000); ?>đ</span>
                            </p>
                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">Nguyen Kiet</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(200000); ?>đ</span>
                            </p>
                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">TCường-g Còii-i</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(5000000); ?>đ</span>
                            </p>
                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">Bi0510</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(100000); ?>đ</span>
                            </p>
                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">Khang Bui</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(500000); ?>đ</span>
                            </p>
                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">Hieulol1ts</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(1500000); ?>đ</span>
                            </p>
                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">Sarahedzo01</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(250000); ?>đ</span>
                            </p>
                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">Huydương Gl</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(150000); ?>đ</span>
                            </p>
                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">quanhoang9087</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(500000); ?>đ</span>
                            </p>
                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">Trai Họ Lý</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(2500000); ?>đ</span>
                            </p>
                            <p key="1">
                                <img class="img-top" alt="" src="public/client/assets/images/default.jpg">
                                <span class="label label-danger">Ngân Kim</span>
                                <span>Mua Thành Công Nick Ngọc Rồng <?php echo number_format(500000); ?>đ</span>
                            </p>

                            <!-- @foreach($giaodich as $item)
                            <p key="1">
                                <img class="img-top" alt="" src="<?php if (is_numeric($item['user_id'])) : ?>https://graph.facebook.com/v3.0/<?php echo $item['user_id']; ?>/picture?width=400&height=400<?php else : ?>public/client/assets/images/default.jpg<?php endif; ?>">
                                <span class="label label-danger"><?php echo $item['user_name']; ?></span>
                                <span>đã <?php echo $item['content']; ?> với giá <?php echo number_format($item['amount']); ?>đ</span>
                            </p>
                            @endforeach -->

                        </marquee>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: TOP NAP THE -->

@if(isset($lienket) && count($lienket)>0)
<div class="c-content-box c-size-md c-bg-white">
    <div class="container">
        <!-- Begin: Testimonals 1 component -->
        <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">
            <!-- Begin: Title 1 component -->
            <div class="c-content-title-1">
                <h3 class="c-center c-font-uppercase c-font-bold">Website Liên Kết</h3>
                <div class="c-line-center" style="width: 100px; height: 1px; margin: 20px auto; border-bottom: 4px solid #32c5d2;"></div>
            </div>
            <div class="owl-carousel owl-theme c-theme owl-bordered1 c-owl-nav-center" data-items="6" data-desktop-items="4" data-desktop-small-items="3" data-tablet-items="3" data-mobile-items="2" data-slide-speed="5000" data-rtl="false">

                <div class="item hover" style="padding-top: 10px;padding-bottom:10px;">
                    <a href="/nap-the"><img src="public/client/assets/images/mobifone.jpg" alt="Nạp thẻ cào" style="width: 80%;">
                    </a>
                </div>

                <div class="item hover" style="padding-top: 10px;padding-bottom:10px;">
                    <a href="/user/profile"><img src="public/client/assets/images/vinaphone.jpg" alt="trang cá nhân" style="width: 80%;">
                    </a>
                </div>

                <div class="item hover" style="padding-top: 10px;padding-bottom:10px;">
                    <a href="/random"><img src="public/client/assets/images/viettel.jpg" alt="random" style="width: 80%;">
                    </a>
                </div>

                <div class="item hover" style="padding-top: 10px;padding-bottom:10px;">
                    <a href="/vong-quay"><img src="public/client/assets/images/zing.jpg" alt="vòng quay may mắn" style="width: 80%;">
                    </a>
                </div>

                <div class="item hover" style="padding-top: 10px;padding-bottom:10px;">
                    <a href="/vong-quay"><img src="public/client/assets/images/scoin.jpg" alt="vòng quay may mắn" style="width: 80%;">
                    </a>
                </div>


            </div>
            <!-- End-->
        </div>
        <!-- End-->
    </div>
</div>
@endif

@endsection