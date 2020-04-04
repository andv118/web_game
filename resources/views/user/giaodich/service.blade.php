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
            <h3 class="c-font-uppercase c-font-bold">Dịch vụ đã mua</h3>
            <div class="c-line-left"></div>
        </div>
        <!-- END: TITLE -->

        <!-- BEGIN: FORM SEARCH -->
        <form action="{{Route('giao-dich.dich-vu.search')}}" class="form-horizontal form-find m-b-20" role="form" method="GET">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group m-b-10 c-square ">
                        <span class="input-group-addon" id="basic-addon1">Mã ID#</span>
                        <input type="text" class="form-control c-square c-theme" name="id" value="{{ isset($dataBack['id']) ? $dataBack['id'] : '' }}" autofocus="" placeholder="Mã ID">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group m-b-10 c-square">
                        <div class="input-group date date-picker" data-date-format="yyyy/mm/dd" data-rtl="false">
                            <span class="input-group-btn">
                                <button class="btn default c-btn-square p-l-10 p-r-10" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                            <input type="text" class="form-control c-square c-theme" name="started_at" autocomplete="off" placeholder="Từ ngày" value="{{ isset($dataBack['started_at']) ? $dataBack['started_at'] : '' }}">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
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
                    <th>ID</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Mệnh giá</th>
                    <th>Thao tác</th>
                </tr>
            </tbody>
            <tbody>
                @foreach($dataLog as $k=>$v)
                <tr>
                    <?php
                    switch ($v->status) {
                        case 1:
                            $label = 'primary';
                            break;
                        case 2:
                            $label = 'warning';
                            break;
                        case 3:
                            $label = 'success';
                            break;
                        case 4:
                            $label = 'danger';
                            break;
                    }
                    ?>
                        <td>{{$v->date}}</td>
                        <td>{{$v->id}}</td>
                        <td>{{ $service->getTradeType($v->trade_type) }}</td>
                        <td> <span class="label label-{{$label}}">{{$v->desc_status}}</span></td>
                        <td>{{number_format($v->total_price,0) . "đ"}}</td>
                        <td><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_modal" data-acc="{{$v->customer_acc}}" data-pass="{{$v->customer_pass}}" data-action="{{$v->customer_action}}">Xem chi tiết </button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- END: TABLE DATA -->

        <!-- BEGIN: PAGINATION -->
        <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
            {{ $dataLog->appends([
                'id' => $dataBack['id'],
                'started_at' => $dataBack['started_at'],
                'ended_at' => $dataBack['ended_at']
                ])
                ->links() }}
        </div>
        <!-- END: PAGINATION -->
    </div>
    <!-- END: PAGE CONTENT -->

    <!-- BEGIN: MODAL BOX -->
    <div class="modal fade bd-example-modal-lg" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="exampleModalLabel">Thông tin đơn hàng </h4>
                </div>

                <div class="modal-body">
                    <div class="c-content-tab-4 c-opt-3" role="tabpanel">
                        <form class="form-horizontal" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group m-t-10 account">
                                <label class="col-md-3 control-label"><b>Tài khoản đăng nhập:</b></label>
                                <div class="col-md-6">
                                    <input class="form-control c-square c-theme" type="text" name="uname" placeholder="" required="" value="" readonly="">
                                </div>
                            </div>
                            <div class="form-group m-t-10 password">
                                <label class="col-md-3 control-label"><b>Mật khẩu đăng nhập:</b></label>
                                <div class="col-md-6">
                                    <input class="form-control c-square c-theme" type="text" name="uname" placeholder="" required="" value="" readonly="">
                                </div>
                            </div>
                        </form>

                        <hr>

                        <div class="table-responsive">
                            <table id="action" class="table table-bordered table-striped">

                            </table>
                        </div>
                    </div>
                    <div style="clear: both"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: MODAL BOX -->

</div>

<script>
    $(document).ready(function() {
        $('#edit_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var acc = button.data('acc') // Extract info from data-* attributes
            var pass = button.data('pass') // Extract info from data-* attributes
            var action = button.data('action') // Extract info from data-* attributes

            var arrAction = action.split("|");
            // console.log(arrAction);
            $('#action tr').remove();
            for (var i = 0; i < arrAction.length; i++) {
                var stt = i + 1;
                $('#action').append('<tr> <td>' + stt + '</td>' + '<td>' + arrAction[i] + '</td>' + '</tr>');
            }

            var modal = $(this)
            modal.find('.account input').val(acc)
            modal.find('.password input').val(pass)
        })
    });
</script>


@endsection