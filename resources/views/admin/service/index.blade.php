@extends('admin.master')
@section('content')

<!-- BEGIN Content Header  -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">LỊCH SỬ DỊCH VỤ CỦA NGƯỜI DÙNG</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Giao dịch</li>
                    <li class="breadcrumb-item active">lịch sử dịch vụ</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- END content-header -->

<!-- BEGIN Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- Thông báo -->
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
                    <!-- END Thông báo -->

                    <!-- BEGIN tìm kiếm -->
                    <form class="form-inline" action="{{Route('admin.giao-dich.delete_all_service')}}" method="POST" style="padding: 10px;border-bottom: 1px solid #dee2e6">
                        {{ csrf_field() }}
                        <button style="margin: 0 5px;" type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa toàn bộ lịch sử dịch vụ?')"> <i class="fas fa-times-circle"></i> XÓA TOÀN BỘ LỊCH SỬ DỊCH VỤ</button>
                    </form>

                    <form class="form-inline" action="{{Route('admin.giao-dich.history_service')}}" method="GET" style="padding: 10px;border-bottom: 1px solid #dee2e6">
                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="email">Người mua:</label>
                                <input name="user_name" type="text" placeholder="Tài khoản mua..." class="form-control" value="{{ isset($dataBack['user_name']) ? $dataBack['user_name'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label>Trạng thái:</label>
                                <select class="form-control" name="status">
                                    <option value="">-- Tất cả --</option>
                                    <option value="1" <?php if (isset($dataBack) && $dataBack['status'] == 1) {
                                                            echo "selected";
                                                        } ?>>Chờ xác nhận</option>
                                    <option value="2" <?php if (isset($dataBack) && $dataBack['status'] == 2) {
                                                            echo "selected";
                                                        } ?>>Đang xử lý</option>
                                    <option value="3" <?php if (isset($dataBack) && $dataBack['status'] == 3) {
                                                            echo "selected";
                                                        } ?>>Đã hoàn thành</option>
                                    <option value="4" <?php if (isset($dataBack) && $dataBack['status'] == 4) {
                                                            echo "selected";
                                                        } ?>>Đã huỷ</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label>Giao dịch:</label>
                                <select class="form-control" name="transaction">
                                    <option value="">-- Tất cả --</option>
                                    <option value="1" <?php if (isset($dataBack) && $dataBack['transaction'] == 1) {
                                                            echo "selected";
                                                        } ?>>Mua ngọc</option>
                                    <option value="2" <?php if (isset($dataBack) && $dataBack['transaction'] == 2) {
                                                            echo "selected";
                                                        } ?>>Mua vàng</option>
                                    <option value="3" <?php if (isset($dataBack) && $dataBack['transaction'] == 3) {
                                                            echo "selected";
                                                        } ?>>Làm nhiệm vụ</option>
                                    <option value="4" <?php if (isset($dataBack) && $dataBack['transaction'] == 4) {
                                                            echo "selected";
                                                        } ?>>Săn đệ tử</option>
                                    <option value="5" <?php if (isset($dataBack) && $dataBack['transaction'] == 5) {
                                                            echo "selected";
                                                        } ?>>Up Bí Kíp - Yadart</option>
                                    <option value="6" <?php if (isset($dataBack) && $dataBack['transaction'] == 6) {
                                                            echo "selected";
                                                        } ?>>Up Sức Mạnh Đệ Tử</option>
                                    <option value="7" <?php if (isset($dataBack) && $dataBack['transaction'] == 7) {
                                                            echo "selected";
                                                        } ?>>Up Sức Mạnh Sư Phụ</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="pwd">Từ ngày: </label>
                                <input name="started_at" type="date" placeholder="Từ ngày" class="form-control" value="{{ isset($dataBack['started_at']) ? $dataBack['started_at'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="pwd">Đến ngày: </label>
                                <input name="ended_at" type="date" placeholder="Đến ngày" class="form-control" value="{{ isset($dataBack['ended_at']) ? $dataBack['ended_at'] : '' }}">
                            </div>
                        </div>

                        <div class="row">
                            <button style="margin: 0 5px;" type="submit" class="btn btn-success">Tìm kiếm</button>
                            <a href="{{Route('admin.giao-dich.history_service')}}" style="margin: 0 5px;" class="btn btn-primary">Tất cả</a>
                        </div>
                    </form>
                    <!-- END tìm kiếm -->

                    <!-- BEGIN DATA TABLE -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="1" style="text-align: center;">Thời gian</th>
                                    <th colspan="1" style="text-align: center;">Người mua</th>
                                    <th colspan="1" style="text-align: center;">ID</th>
                                    <th colspan="1" style="text-align: center;">Loại </th>
                                    <th colspan="1" style="text-align: center;">Số tiền</th>
                                    <th colspan="1" style="text-align: center;">Trạng thái</th>
                                    <th colspan="1" style="text-align: center;">Nội dung</th>
                                    <th colspan="2" style="text-align: center;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <?php
                                switch ($item->status) {
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
                                    <tr>
                                        <td style="text-align: center;">{{$item->date}}</td>
                                        <td style="text-align: center;"><a href="{{Route('admin.manage-users').'?keyword='.$item->name}}">{{$item->name}}</a></td>
                                        <td style="text-align: center;">{{$item->id}}</td>
                                        <td style="text-align: center;">{{ $service->getTradeType($item->trade_type) }}</td>
                                        <td style="text-align: center;">{{number_format($item->total_price) . "đ"}}</td>
                                        <td style="text-align: left;"><span class="btn btn-block btn-outline-{{$label}} btn-sm">{{$item->desc_status}}</span></td>
                                        <td style="text-align: center;">{{$item->description}}</td>
                                        <td style="text-align: center;">
                                            <button data-status="{{$item->status}}" data-content="{{$item->description}}" data-id="{{$item->id}}" data-acc="{{$item->customer_acc}}" data-pass="{{$item->customer_pass}}" data-action="{{$item->customer_action}}" data-price="{{$item->total_price}}" type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#edit_modal">Thao tác</button>
                                        </td>
                                        <td style="text-align:center;"><a title="Xóa" href="{{Route('admin.giao-dich.delete_service',$item->id)}}" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa #-{{$item->id}} ?')"><i class="fas fa-times-circle"></i> Xóa</a></td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>

                        <!-- BEGIN PAGINATION -->
                        <div class="justify-panel" style="margin: 30px 0;display: flex;justify-content: center;align-items: center;">
                            {{$data->appends(request()->query())->links()}}
                        </div>
                        <!-- END PAGINATION -->

                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- END Main content -->

<!-- BEGIN: MODAL BOX -->
<div class="modal fade" id="edit_modal" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Thông tin đơn hàng #<span id="id_don_hang"></span> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="row">
                        <label class="col-md-3 control-label"><b>Tài khoản đăng nhập:</b></label>
                        <div class="col-md-6">
                            <input id="inp_acc" class="form-control c-square c-theme" type="text" name="uname" placeholder="" required="" value="" readonly="">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-3 control-label"><b>Mật khẩu đăng nhập:</b></label>
                        <div class="col-md-6">
                            <input id="inp_pass" class="form-control c-square c-theme" type="text" name="uname" placeholder="" required="" value="" readonly="">
                        </div>
                    </div>
                </form>
                <hr>
                <div class="card-body">
                    <table id="action" class="table table-bordered">

                    </table>
                </div>
                <hr>
                <form id="action_service" action="{{Route('admin.giao-dich.action_service')}}" class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    <input id="inp_id" class="form-control c-square c-theme" type="hidden" name="id" value="">
                    <input id="inp_price" class="form-control c-square c-theme" type="hidden" name="price" value="">

                    <div class="row">
                        <label class="col-md-3 control-label"><b>Nội dung:</b></label>
                        <div class="col-md-6">
                            <input id="inp_noidung" class="form-control c-square c-theme" type="text" name="content" placeholder="Nhập ngắn gọn nếu cần" value="">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-3 control-label"><b>Trạng thái:</b></label>
                        <div class="col-md-6">
                            <select id="select_trangthai" class="form-control" name="status">
                                <option value="1">Chờ xác nhận</option>
                                <option value="2">Đang xử lý</option>
                                <option value="3">Đã hoàn thành</option>
                                <option value="4">Đã hủy</option>
                            </select>
                        </div>
                    </div>

                </form>

            </div>

            <div class="modal-footer justify-content-right">
                <button type="submit" class="btn btn-primary" form="action_service">Thực hiện</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- END: MODAL BOX -->

<script>
    $(document).ready(function() {
        $('#edit_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var acc = button.data('acc') // Extract info from data-* attributes
            var pass = button.data('pass')
            var action = button.data('action')
            var arrAction = action.split("|")
            var id = button.data('id')
            var status = button.data('status')
            var descstatus = button.data('descstatus')
            var content = button.data('content')
            var price = button.data('price')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#id_don_hang').text(id)
            modal.find('#inp_acc').val(acc)
            modal.find('#inp_pass').val(pass)

            modal.find('#inp_noidung').val(content)
            modal.find('#inp_id').val(id)
            modal.find('#inp_price').val(price)
            $('#select_trangthai').find('option').each(function(i, e) {
                if ($(e).val() == status) {
                    $('#select_trangthai').prop('selectedIndex', i);
                }
            });
            modal.find('#action tr').remove();
            for (var i = 0; i < arrAction.length; i++) {
                var stt = i + 1;
                modal.find('#action').append('<tr> <td>' + stt + '</td>' + '<td>' + arrAction[i] + '</td>' + '</tr>');
            }
        })
    });
</script>

@endsection