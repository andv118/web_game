@extends('user.masterlayout.master')

@section('content')

<!-- BEGIN: PAGE CONTENT -->
<div class="m-t-20 visible-sm visible-xs"></div>

<div class="container">

    <!-- BEGIN: LEFT MENU -->
    <div class="c-layout-sidebar-menu c-theme ">
        <div class="row">
            @include("user/leftmenu/index")
        </div>
    </div>
    <!-- END: LEFT MENU -->

    <!-- BEGIN: PAGE CONTENT -->
    <div class="c-layout-sidebar-content ">
        <!-- BEGIN: TITLE -->
        <div class="c-content-title-1">
            <h3 class="c-font-uppercase c-font-bold">Lịch sử giao dịch</h3>
            <div class="c-line-left"></div>
        </div>
        <!-- END: TITLE -->

        <!-- BEGIN: FORM SEARCH -->
        <form action="{{Route('giao-dich.lich-su.search')}}" class="form-horizontal form-find m-b-20" role="form" method="GET">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group m-b-10 c-square">
                        <span class="input-group-addon" id="basic-addon1">Giao dịch</span>
                        <select id="group_id" name="trade_type" class="form-control c-square c-theme">
                            <option value="">-- Tất cả --</option>
                            <option value="1" <?php if (isset($dataBack) && $dataBack['trade_type'] == 1) {
                                                    echo "selected";
                                                } ?>>Rút tiền</option>
                            <option value="2" <?php if (isset($dataBack) && $dataBack['trade_type'] == 2) {
                                                    echo "selected";
                                                } ?>>Chuyển tiền</option>
                            <option value="3" <?php if (isset($dataBack) && $dataBack['trade_type'] == 3) {
                                                    echo "selected";
                                                } ?>>Nhận tiền</option>
                            <option value="4" <?php if (isset($dataBack) && $dataBack['trade_type'] == 4) {
                                                    echo "selected";
                                                } ?>>Nạp tiền</option>
                            <option value="5" <?php if (isset($dataBack) && $dataBack['trade_type'] == 5) {
                                                    echo "selected";
                                                } ?>>Mua tài khoản</option>
                            <option value="6" <?php if (isset($dataBack) && $dataBack['trade_type'] == 6) {
                                                    echo "selected";
                                                } ?>>Đặt cọc</option>
                            <option value="7" <?php if (isset($dataBack) && $dataBack['trade_type'] == 7) {
                                                    echo "selected";
                                                } ?>>Bán tài khoản</option>
                            <option value="8" <?php if (isset($dataBack) && $dataBack['trade_type'] == 8) {
                                                    echo "selected";
                                                } ?>>Dịch vụ</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group m-b-10 c-square">
                        <div class="input-group date date-picker" data-date-format="yyyy/mm/dd" data-rtl="false">
                            <span class="input-group-btn">
                                <button class="btn default c-btn-square p-l-10 p-r-10" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                            <input type="text" class="form-control c-square c-theme" name="started_at" autocomplete="off" placeholder="Từ ngày" value="<?php if (isset($dataBack) && $dataBack['started_at'] != null) {
                                                                                                                                                            echo $dataBack['started_at'];
                                                                                                                                                        } ?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group m-b-10 c-square">
                        <div class="input-group date date-picker" data-date-format="yyyy/mm/dd" data-rtl="false">
                            <span class="input-group-btn">
                                <button class="btn default c-btn-square p-l-10 p-r-10" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                            <input type="text" class="form-control c-square c-theme" name="ended_at" autocomplete="off" placeholder="Đến ngày" value="<?php if (isset($dataBack) && $dataBack['ended_at'] != null) {
                                                                                                                                                            echo $dataBack['ended_at'];
                                                                                                                                                        } ?>">
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <input type="submit" class="btn c-theme-btn c-btn-square m-b-10" value="Tìm kiếm">
                    <a style="display: none;" class="btn c-btn-square m-b-10 btn-danger" href="">Tất cả</a>
                </div>
            </div>
        </form>
        <!-- END: FORM SEARCH -->

        <!-- BEGIN: TABLE DATA -->
        <table class="table table-hover table-custom-res">
            <tbody>
                <tr>
                    <th style="display:none;">Thời gian</th>
                    <th>ID</th>
                    <th>Giao dịch</th>
                    <th>Số tiền</th>
                    <th>Số dư cuối</th>
                    <th>Nội dung</th>
                </tr>
            </tbody>
            <tbody>
                @foreach($dataLog as $k=>$v)
                <tr>
                    <td style="display:none;">{{$v->date}}</td>
                    <td>{{$v->id}}</td>
                    <td>{{$v->trade_name}}</td>
                    <td>{{number_format($v->amount,0) . "đ"}}</td>
                    <td>{{number_format($v->last_amount,0) . "đ"}}</td>
                    <td>{{$v->content}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- END: TABLE DATA -->

        <!-- BEGIN: PAGINATION -->
        <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
            {{ $dataLog->appends([
                'trade_type' => $dataBack['trade_type'],
                'started_at' => $dataBack['started_at'],
                'ended_at' => $dataBack['ended_at']
                ])
                ->links() }}
        </div>
        <!-- END: PAGINATION -->
    </div>
    <!-- END: PAGE CONTENT -->
</div>

@endsection