@extends('user.masterlayout.master')

@section('content')

<div class="c-content-box c-size-lg c-overflow-hide c-bg-white">
    <div class="container">

        <!-- BEGIN: Thông báo -->
        <div class="flash-message">
            @if (Session::has('message'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ Session::get('message') }}
            </div>
            @elseif($errors->any())
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ $errors->first() }}
            </div>
            @endif

        </div>
        <!-- END: Thông báo -->

        @foreach ($data as $get)
        <!-- BEGIN: Thông tin -->
        <div class="c-shop-product-details-4">

            <div class="row">
                <div class="col-md-4 m-b-20">
                    <div class="c-product-header">
                        <div class="c-content-title-1">
                            <h3 class="c-font-uppercase c-font-bold">#{{$get->id}}</h3>
                            <span class="c-font-red c-font-bold">Ngọc Rồng</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 visible-sm visible-xs visible-sm">
                    <div class="text-center m-t-20">
                        <img class="img-responsive img-thumbnail" src="{{$ngocrong->getThumbnail($get->id)}}" />
                    </div>
                    <div class="c-product-meta">
                        <div class="c-content-divider">
                            <i class="icon-dot"></i>
                        </div>
                        <div class="row">

                            <div class="col-sm-4 col-xs-6 c-product-variant">
                                <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Hành tinh: <span class="c-font-red">{{ $ngocrong->strHanhTinh($get->hanhtinh) }}</span></p>
                            </div>

                            <div class="col-sm-4 col-xs-6 c-product-variant">
                                <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Server: <span class="c-font-red">{{ $ngocrong->strServer($get->server) }}</span></p>
                            </div>

                            <div class="col-sm-4 col-xs-6 c-product-variant">
                                <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Đăng ký: <span class="c-font-red">{{ $ngocrong->strDangKy($get->dk) }}</span></p>
                            </div>
                            <div class="col-sm-4 col-xs-6 c-product-variant">
                                <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Bông tai: <span class="c-font-red">{{ $ngocrong->strBongTai($get->bongtai) }}</span></p>
                            </div>
                            <div class="col-sm-4 col-xs-6 c-product-variant">
                                <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Nick sơ sinh có đệ: <span class="c-font-red">{{ $ngocrong->strDeTu($get->detu) }}</span></p>
                            </div>

                            <div class="col-sm-12 col-xs-12 c-product-variant">
                                <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Nổi bật: <span class="c-font-red">{{ $get->note }}</span></p>
                            </div>
                        </div>
                        <div class="c-content-divider">
                            <i class="icon-dot"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="c-product-meta">
                        <div class="c-product-price c-theme-font" style="float: none;text-align: center">{{ number_format($get->cost_atm) . " ATM" }} <br />
                            {{ number_format($get->cost) . " CARD" }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <div class="c-product-header">
                        <div class="c-content-title-1">
                            @if($get->status == 0)
                            <button type="button" class="btn c-btn btn-lg c-theme-btn c-font-uppercase c-font-bold c-btn-square m-t-20" data-toggle="modal" data-target="#modal_thanhtoan_ngocrong" 
                            data-id="{{$get->id}}" 
                            data-cost="{{$get->cost}}" 
                            data-hanhtinh="{{ $ngocrong->strHanhTinh($get->hanhtinh) }}" 
                            data-server="{{ $ngocrong->strServer($get->server) }}" 
                            data-detu="{{ $ngocrong->strDeTu($get->detu) }}" 
                            data-bongtai="{{ $ngocrong->strBongTai($get->bongtai) }}" 
                            data-dangky="{{ $ngocrong->strDangKy($get->dk) }}">Mua ngay</button>
                            <button type="button" class="btn c-btn btn-lg c-bg-green-4 c-font-white c-font-uppercase c-font-bold c-btn-square m-t-20" data-toggle="modal" data-target="#atm_modal">ATM - Ví điện tử</button>
                            @endif
                            <a class="btn c-btn btn-lg c-bg-green-4 c-font-white c-font-uppercase c-font-bold c-btn-square m-t-20" href="{{Route('nap_the')}}">Nạp thẻ cào</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="c-product-meta visible-md visible-lg">
                <div class="c-content-divider">
                    <i class="icon-dot"></i>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-xs-6 c-product-variant">
                        <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Hành tinh: <span class="c-font-red">{{ $ngocrong->strHanhTinh($get->hanhtinh) }}</span></p>
                    </div>

                    <div class="col-sm-4 col-xs-6 c-product-variant">
                        <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Server: <span class="c-font-red">{{ $ngocrong->strServer($get->server) }}</span></p>
                    </div>

                    <div class="col-sm-4 col-xs-6 c-product-variant">
                        <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Đăng ký: <span class="c-font-red">{{ $ngocrong->strDangKy($get->dk) }}</span></p>
                    </div>
                    <div class="col-sm-4 col-xs-6 c-product-variant">
                        <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Bông tai: <span class="c-font-red">{{ $ngocrong->strBongTai($get->bongtai) }}</span></p>
                    </div>
                    <div class="col-sm-4 col-xs-6 c-product-variant">
                        <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Nick sơ sinh có đệ: <span class="c-font-red">{{ $ngocrong->strDeTu($get->detu) }}</span></p>
                    </div>

                    <div class="col-sm-12 col-xs-12 c-product-variant">
                        <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Nổi bật: <span class="c-font-red">{{ $get->note }}</span></p>
                    </div>
                </div>

                <div class="c-content-divider">
                    <i class="icon-dot"></i>
                </div>
            </div>
        </div>
        <!-- END: Thông tin -->

        <!-- BEGIN: ảnh -->
        <div class="container m-t-20 content_post">
            <?php $arrImage = $ngocrong->getImage($get->id); ?>
            @if($arrImage)
            @foreach($arrImage as $img)
            <p>
                <img src="{{$img}}" class="zoom">
            </p>
            @endforeach
            @else
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>
                    <p class="text-center text-muted">Hiện tại chưa có ảnh cho tài khoản này</p>
                </strong>
            </div>
            @endif
        </div>
        <!-- END: ảnh -->
        @endforeach

        <!-- BEGIN: Liên quan -->
        @if(count($data2) > 0)
        <div class="container m-t-20 ">
            <div class="game-item-view" style="margin-top: 40px">
                <div class="c-content-title-1">
                    <h3 class="c-center c-font-uppercase c-font-bold">Tài khoản liên quan</h3>
                    <div class="c-line-center c-theme-bg"></div>
                </div>
                <div class="row row-flex  item-list">
                    @foreach ($data2 as $value)
                    <div class="col-sm-6 col-md-3">
                        <div class="classWithPad">
                            <div class="image">
                                <a title="Xem chi tiết" href="{{Route('chi_tiet_ngoc_rong',$value->id)}}">
                                    <img src="{{ $ngocrong->getThumbNail($value->id) }}">
                                    <span class="ms">MS: {{ $value->id }}</span>
                                </a>
                            </div>
                            <div class="description">
                                {{ $ngocrong->strNote($value->note) }}
                            </div>
                            <div class="attribute_info">
                                <div class="row">
                                    <div class="col-xs-6 a_att">
                                        Hành Tinh: <b>{{ $ngocrong->strHanhTinh($value->hanhtinh) }}</b>
                                    </div>

                                    <div class="col-xs-6 a_att">
                                        Server: <b>{{ $ngocrong->strServer($value->server) }}</b>
                                    </div>

                                    <div class="col-xs-6 a_att">
                                        Bông tai: <b>{{ $ngocrong->strBongTai($value->bongtai) }}</b>
                                    </div>

                                    <div class="col-xs-6 a_att">
                                        Đăng ký: <b>{{ $ngocrong->strDangKy($value->dk) }}</b>
                                    </div>

                                </div>
                            </div>
                            <div class="a-more">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="price_item">
                                            @if($value->status == 0)
                                            {{ number_format($value->cost) . 'đ' }}
                                            @else
                                            Đã bán
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-6 ">
                                        <div class="view">
                                            <a title="Xem chi tiết" href="{{Route('chi_tiet_ngoc_rong',$value->id)}}">Chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
        @endif
        <!-- END: Liên quan -->
    </div>
</div>


@include('user.chitietngocrong.pay')

@endsection