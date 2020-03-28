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
            <h3 class="c-font-uppercase c-font-bold">Thẻ cào đã nạp</h3>
            <div class="c-line-left"></div>
        </div>
        <!-- END: TITLE -->

        <!-- BEGIN: FORM SEARCH -->
        <form action="{{Route('giao-dich.the-cao.search')}}" class="form-horizontal form-find m-b-20" role="form" method="GET">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group m-b-10 c-square">
                        <span class="input-group-addon" id="basic-addon1">Loại thẻ</span>
                        <select id="group_id" name="card_type" class="form-control c-square c-theme">
                            <option value="">-- Tất cả --</option>
                            <option value="VIETTEL" <?php if (isset($dataBack) && $dataBack['card_type'] == "VIETTEL") {
                                                        echo "selected";
                                                    } ?>>Viettel</option>
                            <option value="MOBIFONE" <?php if (isset($dataBack) && $dataBack['card_type'] == "MOBIFONE") {
                                                            echo "selected";
                                                        } ?>>Mobifone</option>
                            <option value="VINAPHONE" <?php if (isset($dataBack) && $dataBack['card_type'] == "VINAPHONE") {
                                                            echo "selected";
                                                        } ?>>Vinaphone</option>
                            <option value="GATE" <?php if (isset($dataBack) && $dataBack['card_type'] == "GATE") {
                                                        echo "selected";
                                                    } ?>>Gate</option>
                            <option value="ZING" <?php if (isset($dataBack) && $dataBack['card_type'] == "ZING") {
                                                        echo "selected";
                                                    } ?>>Zing</option>
                            <option value="SCOIN" <?php if (isset($dataBack) && $dataBack['card_type'] == "SCOIN") {
                                                        echo "selected";
                                                    } ?>>Scoin</option>
                            <option value="VCOIN" <?php if (isset($dataBack) && $dataBack['card_type'] == "VCOIN") {
                                                        echo "selected";
                                                    } ?>>VCOIN</option>
                            <option value="VIETNAMMOBILE" <?php if (isset($dataBack) && $dataBack['card_type'] == "VIETNAMMOBILE") {
                                                                echo "selected";
                                                            } ?>>VIETNAMMOBILE</option>
                            <option value="BIT" <?php if (isset($dataBack) && $dataBack['card_type'] == "BIT") {
                                                    echo "selected";
                                                } ?>>BIT</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group m-b-10 c-square ">
                        <span class="input-group-addon" id="basic-addon1">Thẻ cào</span>
                        <input type="text" class="form-control c-square c-theme" name="number_card" value="{{ isset($dataBack['number_card']) ? $dataBack['number_card'] : '' }}" autofocus="" placeholder="Mã thẻ,Serial...">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group m-b-10 c-square">
                        <div class="input-group date date-picker" data-date-format="yyyy/mm/dd" data-rtl="false">
                            <span class="input-group-btn">
                                <button class="btn default c-btn-square p-l-10 p-r-10" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                            <input type="text" class="form-control c-square c-theme" name="started_at" autocomplete="off" placeholder="Từ ngày" value="{{ isset($dataBack['started_at']) ? $dataBack['started_at'] : '' }}">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group m-b-10 c-square">
                        <div class="input-group date date-picker" data-date-format="yyyy/mm/dd" data-rtl="false">
                            <span class="input-group-btn">
                                <button class="btn default c-btn-square p-l-10 p-r-10" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                            <input type="text" class="form-control c-square c-theme" name="ended_at" autocomplete="off" placeholder="Đến ngày" value="{{ isset($dataBack['ended_at']) ? $dataBack['ended_at'] : '' }}">
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
                    <th>Thời gian</th>
                    <th>Nhà mạng</th>
                    <th>Mã thẻ</th>
                    <th>Serial</th>
                    <th>Mệnh giá</th>
                    <th>Kết quả</th>
                </tr>
            </tbody>
            <tbody>
                @foreach($dataLog as $k=>$v)
                <tr>
                <td>{{$v->date}}</td>
                <td>{{$v->tel}}</td>
                <td>{{$v->pin}}</td>
                <td>{{$v->serial}}</td>
                <td>{{number_format($v->amount,0) . "đ"}}</td>
                <td>{{$v->desc}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- END: TABLE DATA -->

        <!-- BEGIN: PAGINATION -->
        <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
           {{ $dataLog->appends([
                'card_type' => $dataBack['card_type'],
                'number_card' => $dataBack['number_card'],
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