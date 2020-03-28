@extends('admin.master')
@section('content')

<!-- BEGIN Content Header  -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">LỊCH SỬ NẠP THẺ CỦA NGƯỜI DÙNG</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Giao dịch</li>
                    <li class="breadcrumb-item active">Lịch sử nạp thẻ</li>
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
                    <form class="form-inline" action="{{Route('admin.giao-dich.delete_all_charge')}}" method="POST" style="padding: 10px;border-bottom: 1px solid #dee2e6">
                        {{ csrf_field() }}
                        <button style="margin: 0 5px;" type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa toàn bộ lịch sử nạp thẻ?')"> <i class="fas fa-times-circle"></i> XÓA TOÀN BỘ LỊCH SỬ NẠP THẺ</button>
                    </form>

                    <form class="form-inline" action="{{Route('admin.giao-dich.history_charge')}}" method="GET" style="padding: 10px;border-bottom: 1px solid #dee2e6">

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="email">Người nạp:</label>
                                <input name="user_name" type="text" placeholder="Tài khoản nạp..." class="form-control" value="{{ isset($dataBack['user_name']) ? $dataBack['user_name'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="pwd">Thẻ cào:</label>
                                <input name="number_card" type="text" placeholder="Mã thẻ,Serial..." class="form-control" value="{{ isset($dataBack['number_card']) ? $dataBack['number_card'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label>Loại thẻ:</label>
                                <select class="form-control" name="card_type">
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
                                                                    } ?>>VietNamMobile</option>
                                    <option value="BIT" <?php if (isset($dataBack) && $dataBack['card_type'] == "BIT") {
                                                            echo "selected";
                                                        } ?>>BIT</option>
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
                            <a href="{{Route('admin.giao-dich.history_charge')}}" style="margin: 0 5px;" class="btn btn-primary">Tất cả</a>
                        </div>
                    </form>
                    <!-- END tìm kiếm -->

                    <!-- BEGIN DATA TABLE -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="1" style="text-align: center;">Thời gian</th>
                                    <th colspan="1" style="text-align: center;">Người nạp</th>
                                    <th colspan="1" style="text-align: center;">ID</th>
                                    <th colspan="1" style="text-align: center;">Nhà mạng </th>
                                    <th colspan="1" style="text-align: center;">Mã thẻ</th>
                                    <th colspan="1" style="text-align: center;">Serial</th>
                                    <th colspan="1" style="text-align: center;">Mệnh giá</th>
                                    <th colspan="1" style="text-align: center;">Kết quả</th>
                                    <th colspan="2" style="text-align: center;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td style="text-align: center;">{{$item->date}}</td>
                                    <td style="text-align: center;"><a href="{{Route('admin.manage-users').'?keyword='.$item->name}}">{{$item->name}}</a></td>
                                    <td style="text-align: center;">{{$item->id}}</td>
                                    <td style="text-align: center;">{{$item->tel}}</td>
                                    <td style="text-align: center;">{{$item->pin}}</td>
                                    <td style="text-align: center;">{{$item->serial}}</td>
                                    <td style="text-align: center;">{{number_format($item->amount) . "đ"}}</td>
                                    <td style="text-align: center;">{{$item->desc}}</td>

                                    <td style="text-align: center;"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_update_charge" data-id="{{$item->id}}" data-telco="{{$item->tel}}" data-serial="{{$item->serial}}" data-code="{{$item->pin}}" data-status="{{$item->status}}" data-amount="{{$item->amount}}"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                    <td style="text-align:center;"><a title="Xóa" href="{{Route('admin.giao-dich.delete_charge',$item->id)}}" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa #-{{$item->id}} ?')"><i class="fas fa-times-circle"></i> Xóa</a></td>
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

<!-- BEGIN: Modal Update -->
<div class="modal fade" id="modal_update_charge" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật lịch sử nạp thẻ # <b id="charge_id" style="color: red;"></b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" id="update_charge" action="{{Route('admin.giao-dich.change_charge')}}" method="POST">
                    {{csrf_field()}}

                    <input type="hidden" name="id" value="">

                    <div class="row form-group">
                        <label class="col-md-3 control-label"><b>Nhà mạng:</b></label>
                        <div class="col-md-9">
                            <select name="telco" class="form-control c-square c-theme">
                                <option value="VIETTEL">Viettel</option>
                                <option value="MOBIFONE">Mobifone</option>
                                <option value="VINAPHONE">Vinaphone</option>
                                <option value="GATE">Gate</option>
                                <option value="ZING">Zing</option>
                                <option value="SCOIN">Scoin</option>
                                <option value="VCOIN">VCOIN</option>
                                <option value="VIETNAMMOBILE">VietNamMobile</option>
                                <option value="BIT">BIT</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 control-label"><b>Mã thẻ:</b></label>
                        <div class="col-md-9">
                            <input class="form-control c-square c-theme" type="code" name="code" placeholder="Mã thẻ" value="">

                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 control-label"><b>Serial:</b></label>
                        <div class="col-md-9">
                            <input class="form-control c-square c-theme" type="serial" name="serial" placeholder="Serial" value="">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 control-label"><b>Mệnh giá:</b></label>
                        <div class="col-md-9">
                            <input class="form-control c-square c-theme" type="number" name="amount" require="" placeholder="Mệnh giá" value="">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-md-3 control-label"><b>Kết quả:</b></label>
                        <div class="col-md-9">
                            <select name="status" class="form-control c-square c-theme">
                                <option value="">Chọn trạng thái</option>
                                <option value="1">Thẻ đúng</option>
                                <option value="3">Thẻ lỗi</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-right">
                <button type="submit" form="update_charge" class="btn btn-primary">Sửa</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- END: Modal Update -->

<script>
    $(document).ready(function() {
        $('#modal_update_charge').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id')
            var telco = button.data('telco')
            var serial = button.data('serial')
            var code = button.data('code')
            var amount = button.data('amount')
            var status = button.data('status')


            console.log(status);


            var modal = $(this)
            modal.find('input[name="id"]').val(id)
            modal.find('#charge_id').text(id)
            modal.find('input[name="serial"]').val(serial)
            modal.find('input[name="code"]').val(code)
            modal.find('input[name="amount"]').val(amount)

            $('select option:selected').each(function(i) {
                $(this).removeAttr("selected");
            })

            switch (telco) {
                case 'VIETTEL':
                    modal.find('select  option[value="VIETTEL"]').attr("selected", "selected");
                    break;
                case 'MOBIFONE':
                    modal.find('select  option[value="MOBIFONE"]').attr("selected", "selected");
                    break;
                case 'VINAPHONE':
                    modal.find('select  option[value="VINAPHONE"]').attr("selected", "selected");
                    break;
                case 'GATE':
                    modal.find('select  option[value="GATE"]').attr("selected", "selected");
                    break;
                case 'ZING':
                    modal.find('select  option[value="ZING"]').attr("selected", "selected");
                    break;
                case 'SCOIN':
                    modal.find('select  option[value="SCOIN"]').attr("selected", "selected");
                    break;
                case 'VCOIN':
                    modal.find('select  option[value="VCOIN"]').attr("selected", "selected");
                    break;
                case 'VIETNAMMOBILE':
                    modal.find('select  option[value="VIETNAMMOBILE"]').attr("selected", "selected");
                    break;
                case 'BIT':
                    modal.find('select  option[value="BIT"]').attr("selected", "selected");
                    break;
            }

            if (status == 1) {
                modal.find('select[name="status"]  option[value="1"]').attr("selected", "selected");
            } else if (status == 3) {
                modal.find('select[name="status"]  option[value="3"]').attr("selected", "selected");
            }
        });
    });
</script>

@endsection