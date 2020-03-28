@extends('user.masterlayout.master')

@section('content')
<?php
function format_cash($price)
{
    return str_replace(",", ",", number_format($price));
}

function getThumb($id, $game)
{
    $img = glob("public/client/assets/upload/thumb-" . $id . "-" . $game . ".*");
    if ($img) {
        $arr = explode("/", $img[0]);
        $last = array_pop($arr);
        return url('/') . '/public/client/assets/upload/' . $last;
    } else {
        return url('/') . "/public/client/assets/images/no-thumbnail.jpg";
    }
}


function str_dt($num)
{
    switch ($num) {
        case 1:
            $str = "Có";
            break;
        case 2:
            $str = "Không";
            break;
        default:
            $str = "---";
            break;
    }
    return $str;
}

function str_bt($num)
{
    switch ($num) {
        case 1:
            $str = "Có";
            break;
        case 2:
            $str = "Không";
            break;
        default:
            $str = "---";
            break;
    }
    return $str;
}

function str_ht($num)
{
    switch ($num) {
        case 1:
            $str = "Xayda";
            break;
        case 2:
            $str = "Namec";
            break;
        case 3:
            $str = "Trái Đất";
            break;
        default:
            $str = "---";
            break;
    }
    return $str;
}

function str_dk($num)
{
    switch ($num) {
        case 1:
            $str = "Ảo";
            break;
        case 2:
            $str = "Gmail Full";
            break;
        default:
            $str = "---";
            break;
    }
    return $str;
}

function str_sv($num)
{
    switch ($num) {
        case 1:
            $str = "Vũ Trụ 1 sao";
            break;
        case 2:
            $str = "Vũ Trụ 2 sao";
            break;
        case 3:
            $str = "Vũ Trụ 3 sao";
            break;
        case 4:
            $str = "Vũ Trụ 4 sao";
            break;
        case 5:
            $str = "Vũ Trụ 5 sao";
            break;
        case 6:
            $str = "Vũ Trụ 6 sao";
            break;
        case 7:
            $str = "Vũ Trụ 7 sao";
            break;
        case 8:
            $str = "Vũ Trụ 8 sao";
            break;
        case 9:
            $str = "SV nước ngoài";
            break;

        default:
            $str = "---";
            break;
    }
    return $str;
}

?>
                    <div class="c-content-box c-size-lg c-overflow-hide c-bg-white">
                        <div class="container">
                            <!-- Thông báo -->
                            <div class="flash-message">
                                @if (Session::has('message'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{ Session::get('message') }}
                                </div>
                                @elseif(Session::has('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{ Session::get('error') }}
                                </div>
                                @elseif($errors->any())
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{ $errors->first() }}
                                </div>
                                @endif

                            </div>
                            <!-- END Thông báo -->

                            <?php foreach ($data as $get) : ?>


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
                                                <img class="img-responsive img-thumbnail" src="<?php echo "public/client/assets/upload/image-" . $get->id . "-nr" . ".jpg"; ?>" />
                                            </div>
                                            <div class="c-product-meta">
                                                <div class="c-content-divider">
                                                    <i class="icon-dot"></i>
                                                </div>
                                                <div class="row">

                                                    <div class="col-sm-4 col-xs-6 c-product-variant">
                                                        <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Hành tinh: <span class="c-font-red"><?php echo str_ht($get['hanhtinh']); ?></span></p>
                                                    </div>

                                                    <div class="col-sm-4 col-xs-6 c-product-variant">
                                                        <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Server: <span class="c-font-red"><?php echo str_sv($get->server); ?></span></p>
                                                    </div>

                                                    <div class="col-sm-4 col-xs-6 c-product-variant">
                                                        <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Đăng ký: <span class="c-font-red"><?php echo str_dk($get->dk); ?></span></p>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-6 c-product-variant">
                                                        <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Bông tai: <span class="c-font-red"><?php echo str_bt($get->bongtai); ?></span></p>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-6 c-product-variant">
                                                        <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Nick sơ sinh có đệ: <span class="c-font-red"><?php echo str_dt($get->detu); ?></span></p>
                                                    </div>

                                                    <div class="col-sm-12 col-xs-12 c-product-variant">
                                                        <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Nổi bật: <span class="c-font-red"><?php echo htmlspecialchars(strip_tags($get->note), ENT_QUOTES, 'UTF-8'); ?></span></p>
                                                    </div>
                                                </div>
                                                <div class="c-content-divider">
                                                    <i class="icon-dot"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="c-product-meta">
                                                <div class="c-product-price c-theme-font" style="float: none;text-align: center"><?php echo format_cash($get->cost_atm); ?> ATM<br />
                                                    <?php echo format_cash($get->cost); ?> CARD
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <div class="c-product-header">
                                                <div class="c-content-title-1">
                                                    <?php if ($get->status == 0) : ?><button type="button" class="btn c-btn btn-lg c-theme-btn c-font-uppercase c-font-bold c-btn-square m-t-20" data-toggle="modal" data-target="#modal_thanhtoan_ngocrong" data-id="{{$get->id}}" data-cost="{{$get->cost}}" data-hanhtinh="{{str_ht($get->hanhtinh)}}" data-server="{{str_sv($get->server)}}" data-detu="{{str_dt($get->detu)}}" data-bongtai="{{str_bt($get->bongtai)}}" data-dangky="{{str_dk($get->dk)}}">Mua ngay</button><?php endif; ?>
                                                    <?php if ($get->status == 0) : ?><button type="button" class="btn c-btn btn-lg c-bg-green-4 c-font-white c-font-uppercase c-font-bold c-btn-square m-t-20" data-toggle="modal" data-target="#atm_modal">ATM - Ví điện tử</button>
                                                        <a class="btn c-btn btn-lg c-bg-green-4 c-font-white c-font-uppercase c-font-bold c-btn-square m-t-20" href="{{Route('nap_the')}}">Nạp thẻ cào</a><?php endif; ?>
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
                                                <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Hành tinh: <span class="c-font-red"><?php echo str_ht($get['hanhtinh']); ?></span></p>
                                            </div>

                                            <div class="col-sm-4 col-xs-6 c-product-variant">
                                                <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Server: <span class="c-font-red"><?php echo str_sv($get->server); ?></span></p>
                                            </div>

                                            <div class="col-sm-4 col-xs-6 c-product-variant">
                                                <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Đăng ký: <span class="c-font-red"><?php echo str_dk($get->dk); ?></span></p>
                                            </div>
                                            <div class="col-sm-4 col-xs-6 c-product-variant">
                                                <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Bông tai: <span class="c-font-red"><?php echo str_bt($get->bongtai); ?></span></p>
                                            </div>
                                            <div class="col-sm-4 col-xs-6 c-product-variant">
                                                <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Nick sơ sinh có đệ: <span class="c-font-red"><?php echo str_dt($get->detu); ?></span></p>
                                            </div>

                                            <div class="col-sm-12 col-xs-12 c-product-variant">
                                                <p class="c-product-meta-label c-product-margin-1 c-font-uppercase c-font-bold">Nổi bật: <span class="c-font-red"><?php echo htmlspecialchars(strip_tags($get->note), ENT_QUOTES, 'UTF-8'); ?></span></p>
                                            </div>
                                        </div>

                                        <div class="c-content-divider">
                                            <i class="icon-dot"></i>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="container m-t-20 content_post">
                            <?php $arr = glob("public/client/assets/upload/image-" . $get->id . "-nr*"); ?>
                            <?php if (count($arr) > 1) : ?>
                                <?php foreach ($arr as $img) : ?>
                                    <p>
                                        <img src="<?php echo $img; ?>" class="zoom">
                                    </p>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>
                                        <p class="text-center text-muted">Hiện tại chưa có ảnh cho tài khoản này</p>
                                    </strong>
                                </div>
                            <?php endif; ?>

                            <div class="buy-footer" style="text-align: center">
                                <?php if ($get->status == 0 < 1) : ?><button type="button" class="btn c-btn btn-lg c-theme-btn c-font-uppercase c-font-bold c-btn-square m-t-20 load-modal" rel="/ngoc-rong/buyacc/">Mua ngay</button>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php endforeach ?>

                    <?php if (count($data2) > 0) : ?>
                        <div class="container m-t-20 ">
                            <div class="game-item-view" style="margin-top: 40px">
                                <div class="c-content-title-1">
                                    <h3 class="c-center c-font-uppercase c-font-bold">Tài khoản liên quan</h3>
                                    <div class="c-line-center c-theme-bg"></div>
                                </div>
                                <div class="row row-flex  item-list">
                                    <?php
                                        foreach ($data2 as $value) :
                                            ?>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="classWithPad">
                                                <div class="image">
                                                    <a title="Xem chi tiết" href="{{Route('chi_tiet_ngoc_rong',$value->id)}}">
                                                        <img src="<?php echo getThumb($value->id, 'nr'); ?>">
                                                        <span class="ms">MS: <?php echo (int) $value->id; ?></span>
                                                    </a>
                                                </div>
                                                <div class="description">
                                                    <?php echo htmlspecialchars(strip_tags(substr($value->note, 0, 25)), ENT_QUOTES, 'UTF-8');
                                                            if (strlen($value->note) > 25) echo '...'; ?>
                                                </div>
                                                <div class="attribute_info">
                                                    <div class="row">
                                                        <div class="col-xs-6 a_att">
                                                            Hành Tinh: <b><?php echo str_ht($value->hanhtinh); ?></b>
                                                        </div>

                                                        <div class="col-xs-6 a_att">
                                                            Server: <b><?php echo str_sv($value->server); ?></b>
                                                        </div>

                                                        <div class="col-xs-6 a_att">
                                                            Bông tai: <b><?php echo str_bt($value->bongtai); ?></b>
                                                        </div>

                                                        <div class="col-xs-6 a_att">
                                                            Đăng ký: <b><?php echo str_dk($value->dk); ?></b>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="a-more">
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <div class="price_item">
                                                                <?php
                                                                        if ($value->status == 0) :
                                                                            echo str_replace(",", ",", number_format($value->cost)) . 'đ';
                                                                        else :
                                                                            echo 'Đã bán';
                                                                        endif;
                                                                        ?>
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
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        <?php endif; ?>
                        </div>
                    </div>


                    @include('user.chitietngocrong.pay')

                    @endsection