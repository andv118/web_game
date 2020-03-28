@extends('user.masterlayout.master')

@section('content')

<?php

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

function getThumbnail($id, $game)
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

?>

                    <div class="container">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-info" role="alert">
                                    <h2 class="alert-heading" style="text-align: center;text-transform: uppercase;">{!!$title!!}</h2>
                                </div>
                            </div>
                        </div>

                        <!-- BEGIN: Tim kiem -->
                        <div class="row" style="margin-bottom: 15px">
                            <div class="m-l-10 m-r-10">
                                <form class="form-inline m-b-10" action="{{Route('ngoc_rong','all')}}" role="form" method="get">

                                    <div class="col-md-3 col-sm-4 p-5 field-search">
                                        <div class="input-group c-square">
                                            <span class="input-group-addon">Tìm kiếm</span>
                                            <input name="keyword" type="text" class="form-control c-square" value="{{old('keyword')}}" placeholder="Tìm kiếm">
                                            <input type="hidden" name="search" value="1">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 p-5 field-search">
                                        <div class="input-group c-square">
                                            <span class="input-group-addon">Mã số</span>
                                            <input type="text" class="form-control c-square" value="{{old('id')}}" placeholder="Mã số" name="id">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                                        <div class="input-group c-square">
                                            <span class="input-group-addon">Giá tiền</span>
                                            <select style="" class="form-control c-square" name="price">
                                                <option value="">Chọn giá tiền</option>
                                                <option value="1" <?php if (old('price') == 1) {
                                                                        echo 'selected';
                                                                    } ?>>Dưới 50K</option>
                                                <option value="2" <?php if (old('price') == 2) {
                                                                        echo 'selected';
                                                                    } ?>>Từ 50K - 200K</option>
                                                <option value="3" <?php if (old('price') == 3) {
                                                                        echo 'selected';
                                                                    } ?>>Từ 200K - 500K</option>
                                                <option value="4" <?php if (old('price') == 4) {
                                                                        echo 'selected';
                                                                    } ?>>Từ 500K - 1 Triệu</option>
                                                <option value="5" <?php if (old('price') == 5) {
                                                                        echo 'selected';
                                                                    } ?>>Trên 1 Triệu</option>
                                                <option value="6" <?php if (old('price') == 6) {
                                                                        echo 'selected';
                                                                    } ?>>Trên 5 Triệu</option>
                                                <option value="7" <?php if (old('price') == 7) {
                                                                        echo 'selected';
                                                                    } ?>>Trên 10 Triệu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                                        <div class="input-group c-square">
                                            <span class="input-group-addon">Trạng thái</span>
                                            <select name="status" style="" class="form-control c-square">
                                                <option value="">Tất cả</option>
                                                <option value="0" <?php if (old('status') == 0) {
                                                                        echo 'selected';
                                                                    } ?>>Chưa bán</option>
                                                <option value="1" <?php if (old('status') == 1) {
                                                                        echo 'selected';
                                                                    } ?>>Đã bán</option>
                                                <option value="2" <?php if (old('status') == 2) {
                                                                        echo 'selected';
                                                                    } ?>>Đã đặt cọc</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                                        <div class="input-group c-square">
                                            <span class="input-group-addon">Bông tai</span>
                                            <select name="bongtai" class="form-control c-square">
                                                <option value="">-- Không chọn --</option>
                                                <option value="1" <?php if (old('bongtai') == 1) {
                                                                        echo 'selected';
                                                                    } ?>>Có</option>
                                                <option value="2" <?php if (old('bongtai') == 2) {
                                                                        echo 'selected';
                                                                    } ?>>không</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                                        <div class="input-group c-square">
                                            <span class="input-group-addon">Nick Sơ Sinh Có Đệ</span>
                                            <select name="detu" class="form-control c-square">
                                                <option value="">-- Không chọn --</option>
                                                <option value="1" <?php if (old('detu') == 1) {
                                                                        echo 'selected';
                                                                    } ?>>Có</option>
                                                <option value="2" <?php if (old('detu') == 2) {
                                                                        echo 'selected';
                                                                    } ?>>không</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                                        <div class="input-group c-square">
                                            <span class="input-group-addon">Hành Tinh</span>
                                            <select name="hanhtinh" class="form-control c-square">
                                                <option value="">-- Không chọn --</option>
                                                <option value="1" <?php if (old('hanhtinh') == 1) {
                                                                        echo 'selected';
                                                                    } ?>>Xayda</option>
                                                <option value="2" <?php if (old('hanhtinh') == 2) {
                                                                        echo 'selected';
                                                                    } ?>>Namec</option>
                                                <option value="3" <?php if (old('hanhtinh') == 3) {
                                                                        echo 'selected';
                                                                    } ?>>Trái đất</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                                        <div class="input-group c-square">
                                            <span class="input-group-addon">Server</span>
                                            <select name="servers" class="form-control c-square">
                                                <option value="">-- Không chọn --</option>
                                                <option value="1" <?php if (old('servers') == 1) {
                                                                        echo 'selected';
                                                                    } ?>>Vũ Trụ 1 sao</option>
                                                <option value="2" <?php if (old('servers') == 2) {
                                                                        echo 'selected';
                                                                    } ?>>Vũ Trụ 2 sao</option>
                                                <option value="3" <?php if (old('servers') == 3) {
                                                                        echo 'selected';
                                                                    } ?>>Vũ Trụ 3 sao</option>
                                                <option value="4" <?php if (old('servers') == 4) {
                                                                        echo 'selected';
                                                                    } ?>>Vũ Trụ 4 sao</option>
                                                <option value="5" <?php if (old('servers') == 5) {
                                                                        echo 'selected';
                                                                    } ?>>Vũ Trụ 5 sao</option>
                                                <option value="6" <?php if (old('servers') == 6) {
                                                                        echo 'selected';
                                                                    } ?>>Vũ Trụ 6 sao</option>
                                                <option value="7" <?php if (old('servers') == 7) {
                                                                        echo 'selected';
                                                                    } ?>>Vũ Trụ 7 sao</option>
                                                <option value="8" <?php if (old('servers') == 8) {
                                                                        echo 'selected';
                                                                    } ?>>Vũ Trụ 8 sao</option>
                                                <option value="9" <?php if (old('servers') == 9) {
                                                                        echo 'selected';
                                                                    } ?>>SV nước ngoài</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                                        <div class="input-group c-square">
                                            <span class="input-group-addon">Đăng ký</span>
                                            <select name="dangky" class="form-control c-square">
                                                <option value="">-- Không chọn --</option>
                                                <option value="1" <?php if (old('dangky') == 1) {
                                                                        echo 'selected';
                                                                    } ?>>Ảo</option>
                                                <option value="2" <?php if (old('dangky') == 2) {
                                                                        echo 'selected';
                                                                    } ?>>Gmail Full</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 p-5 no-radius">
                                        <button type="submit" class="btn c-square c-theme c-btn-green">Tìm kiếm</button>
                                        <a class="btn c-square m-l-0 btn-danger" href="{{Route('ngoc_rong','all')}}">Tất cả</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END: Tim kiem -->

                        <!-- BEGIN: List item -->
                        <div class="row row-flex  item-list">
                            @foreach($data as $value)

                            <div class="col-sm-6 col-md-3">
                                <div class="classWithPad">
                                    <div class="image">
                                        <a title="Xem chi tiết" href="{{Route('chi_tiet_ngoc_rong',$value->id)}}">
                                            <img src="<?php echo getThumbnail($value->id, 'nr'); ?>">
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

                            @endforeach

                        </div>
                        <!-- END: List item -->

                        <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
                            {{$data->appends(request()->query())->links()}}
                        </div>

                    </div>

                    @endsection