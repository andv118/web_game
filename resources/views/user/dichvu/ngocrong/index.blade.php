@extends('user.masterlayout.master')

@section('content')

<style>
    @media only screen and (min-width: 768px) {
        .row-flex-safari .classWithPad {
            height: 255px;
            max-height: 255px;
        }
    }
</style>


<div class="c-content-box c-size-md c-bg-white">
    <div class="container">
        <!-- Begin: Testimonals 1 component -->
        <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">
            <!-- Begin: Title 1 component -->
            <div class="c-content-title-1">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-info" role="alert">
                            <h2 class="alert-heading" style="text-transform: uppercase;">Dịch vụ ngọc rồng</h2>
                            <p>Game&nbsp;<strong><a href="http://ngocrongonline.com/" target="_blank">Ngọc Rồng Online</a></strong>&nbsp;thuộc thể thoại game mobile do&nbsp;<strong><a href="http://teamobi.com/home/home-page.html" target="_blank">Teamobi</a></strong>&nbsp;độc quyền phát hành tại Việt Nam</p>
                        </div>
                    </div>
                    <div class="m-l-10 m-r-10">
                        <form class="form-inline m-b-10" role="form" method="get">
                            <div class="col-md-3 col-sm-4 p-5 field-search">
                                <div class="input-group c-square">
                                    <span class="input-group-addon">Tìm kiếm</span>
                                    <input type="text" class="form-control c-square" value="" placeholder="Tìm kiếm" name="find">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 p-5 no-radius">
                                <button type="submit" class="btn c-square c-theme c-btn-green">Tìm kiếm</button>
                                <a class="btn c-square m-l-0 btn-danger">Tất cả</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row row-flex-safari game-list" style="margin-top: 20px;">

                    <div class="col-sm-6 col-xs-6 col-md-3 p-5" style="display:none;">
                        <div class="classWithPad" style="width: 90%;">
                            <div class="image">
                                <a href="">
                                    <img src="public/client/assets/images/danhmuc/timdo.jpg">
                                </a>
                            </div>
                            <div class="news_title"><a style="color: orange;" href="">TÌM ĐỒ</a></div>
                            <div class="news_description">
                            </div>
                            <div class="a-more" style="margin-bottom: 20px;">
                                <div class="row">
                                    <div class="col-xs-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-6 col-md-3 p-5">
                        <div class="classWithPad" style="width: 90%;">
                            <div class="image">
                                <a href="{{Route('dichvu.ngocrong.ban-vang')}}" >
                                    <img src="public/client/assets/images/danhmuc/banvang.jpg">
                                </a>
                            </div>
                            <div class="news_title"><a style="color: orange;" href="{{Route('dichvu.ngocrong.ban-vang')}}">BÁN VÀNG TỰ ĐỘNG</a></div>
                            <div class="news_description">
                            </div>
                            <div class="a-more" style="margin-bottom: 20px;">
                                <div class="row">
                                    <div class="col-xs-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-6 col-md-3 p-5">
                        <div class="classWithPad" style="width: 90%;">
                            <div class="image">
                                <a href="{{Route('dichvu.ngocrong.ban-ngoc')}}">
                                    <img src="public/client/assets/images/danhmuc/banngoc.jpg">
                                </a>
                            </div>
                            <div class="news_title"><a style="color: orange;" href="{{Route('dichvu.ngocrong.ban-ngoc')}}">BÁN NGỌC TỰ ĐỘNG</a></div>
                            <div class="news_description">
                            </div>
                            <div class="a-more" style="margin-bottom: 20px;">
                                <div class="row">
                                    <div class="col-xs-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-6 col-md-3 p-5">
                        <div class="classWithPad" style="width: 90%;">
                            <div class="image">
                                <a href="{{Route('dichvu.ngocrong.nhiem-vu')}}">
                                    <img src="public/client/assets/images/danhmuc/lamnv.jpg">
                                </a>
                            </div>
                            <div class="news_title"><a style="color: orange;" href="{{Route('dichvu.ngocrong.nhiem-vu')}}">LÀM NHIỆM VỤ THUÊ</a></div>
                            <div class="news_description">
                            </div>
                            <div class="a-more" style="margin-bottom: 20px;">
                                <div class="row">
                                    <div class="col-xs-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-6 col-md-3 p-5">
                        <div class="classWithPad" style="width: 90%;">
                            <div class="image">
                                <a href="{{Route('dichvu.ngocrong.bi-kip')}}">
                                    <img src="public/client/assets/images/danhmuc/upbikip.jpg">
                                </a>
                            </div>
                            <div class="news_title"><a style="color: orange;" href="{{Route('dichvu.ngocrong.bi-kip')}}">ÚP BÍ KÍP CẢI TRANG</a></div>
                            <div class="news_description">
                            </div>
                            <div class="a-more" style="margin-bottom: 20px;">
                                <div class="row">
                                    <div class="col-xs-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-6 col-md-3 p-5">
                        <div class="classWithPad" style="width: 90%;">
                            <div class="image">
                                <a href="{{Route('dichvu.ngocrong.su-phu')}}">
                                    <img src="public/client/assets/images/danhmuc/upsm.jpg">
                                </a>
                            </div>
                            <div class="news_title"><a style="color: orange;" href="{{Route('dichvu.ngocrong.su-phu')}}">ÚP SỨC MẠNH SƯ PHỤ</a></div>
                            <div class="news_description">
                            </div>
                            <div class="a-more" style="margin-bottom: 20px;">
                                <div class="row">

                                    <div class="col-xs-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-6 col-md-3 p-5">
                        <div class="classWithPad" style="width: 90%;">
                            <div class="image">
                                <a href="{{Route('dichvu.ngocrong.de-tu')}}">
                                    <img src="public/client/assets/images/danhmuc/updetu.jpg">
                                </a>
                            </div>
                            <div class="news_title"><a style="color: orange;" href="{{Route('dichvu.ngocrong.de-tu')}}">ÚP SỨC MẠNH ĐỆ TỬ</a></div>
                            <div class="news_description">
                            </div>
                            <div class="a-more" style="margin-bottom: 20px;">
                                <div class="row">

                                    <div class="col-xs-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-xs-6 col-md-3 p-5">
                        <div class="classWithPad" style="width: 90%;">
                            <div class="image">
                                <a href="{{Route('dichvu.ngocrong.san-de-tu')}}">
                                    <img src="public/client/assets/images/danhmuc/sandetu.jpg">
                                </a>
                            </div>
                            <div class="news_title"><a style="color: orange;" href="{{Route('dichvu.ngocrong.san-de-tu')}}">SĂN ĐỆ TỬ - LÀM ĐỆ</a></div>
                            <div class="news_description">
                            </div>
                            <div class="a-more" style="margin-bottom: 20px;">
                                <div class="row">

                                    <div class="col-xs-12">
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

    <style type="text/css">
        .classWithPad: {
            margin-bottom: 20px !important;
        }


        .classWithPad:hover {
            transition: 0.2s;
            transform: scale(1.1);
        }

        @media only screen and (min-width: 768px) {
            .row-flex-safari .classWithPad {
                height: 400px !important;
                max-height: 334px !important;
            }

        }
    </style>

    @endsection