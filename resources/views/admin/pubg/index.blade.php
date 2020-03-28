@extends('admin.master')

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

?>


                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">PUPG</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="#">Tài khoản game</a></li>
                                        <li class="breadcrumb-item active">Pubg</li>
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title"><i class="fa fa-list"></i> Danh sách tài khoản Pubg (<span style="color: red;">{{number_format($total)}}</span>)</h3>
                                            <div class="card-tools">
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" data-toggle="modal" data-target="#add-nick"><i class="fa fa-plus"></i> Thêm mới</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- tìm kiếm -->
                                        <form class="form-inline" action="/action_page.php" style="padding: 10px;border-bottom: 1px solid #dee2e6">
                                            <div class="form-group" style="padding: 5px;">
                                                <label for="email">Mã ID#:</label>
                                                <input type="number" placeholder="Mã ID..." class="form-control" id="email">
                                            </div>
                                            <div class="form-group" style="padding: 5px;">
                                                <label for="pwd">Tên đăng nhập:</label>
                                                <input type="text" placeholder="Tên đăng nhập..." class="form-control" id="pwd">
                                            </div>
                                            <div class="form-group" style="padding: 5px;">
                                                <label for="pwd">Người đăng:</label>
                                                <input type="text" placeholder="Tên đăng nhập CTV..." c class="form-control" id="pwd">
                                            </div><br><br>
                                            <div class="form-group" style="padding: 5px;">
                                                <label for="pwd">Loại:</label>
                                                <select class="form-control">
                                                    <option value="">--Tất cả--</option>
                                                    <option value="1">Đã bán</option>
                                                    <option value="2">Chưa bán</option>
                                                </select>
                                            </div><br>
                                            <button style="margin: 0 5px;" type="submit" class="btn btn-success">Tìm kiếm</button>
                                            <a href="{{Route('admin.tk_ngocrong')}}" class="btn btn-warning">Tất cả</a>
                                        </form>
                                        <!-- end -->

                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th colspan="1" style="text-align: center;">STT</th>
                                                        <th colspan="1" style="text-align: center;">#ID</th>
                                                        <th colspan="1" style="text-align: center;">Người đăng</th>
                                                        <th colspan="1" style="text-align: center;">Tài khoản|Mật khẩu </th>
                                                        <th colspan="1" style="text-align: center;">Đăng nhập</th>
                                                        <th colspan="1" style="text-align: center;">Giá</th>
                                                        <th colspan="1" style="text-align: center;">Trạng thái</th>
                                                        <th colspan="2" style="text-align: center;">Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $stt = 0; ?>
                                                    @foreach($data as $item)
                                                    <tr>
                                                        <td style="text-align: center;">{{$stt+=1}}</td>
                                                        <td style="text-align: center;">{{$item['id']}}</td>
                                                        <td style="text-align: center;"><a href="{{Route('admin.manage-users').'?keyword='.$item['user_name']}}">{{$item['user_name']}}</a></td>
                                                        <td style="text-align: center;">{{$item['info']}}</td>
                                                        <td style="text-align: center;">{{$item['dangnhap']}}</td>
                                                        <td style="text-align: center;">{{number_format($item['cost']) . "đ"}}</td>
                                                        <td style="text-align: center;">
                                                            @if($item['status']==1)
                                                            Đã bán
                                                            @else
                                                            Chưa bán
                                                            @endif
                                                        </td>
                                                        @if($item['status']==1)
                                                        <td style="text-align:center;"><button title="Xóa" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger"><i class="fas fa-times-circle"></i> Xóa</button></td>
                                                        @else
                                                        <td style="text-align: center;"><button title="Cập nhật quyền" type="button" class="btn btn-info load-modal"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                                        <td style="text-align:center;"><button title="Xóa" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger"><i class="fas fa-times-circle"></i> Xóa</button></td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <div class="justify-panel" style="margin: 30px 0;display: flex;justify-content: center;align-items: center;">
                                                {{$pubg->appends(request()->query())->links()}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->

                    <!-- Thêm mới nick Ngọc rồng -->
                    <div id="add-nick" class="modal fade" style="padding-right: 23%!important;" role="dialog">
                        <div class="modal-dialog" style="margin-left: 22%;">
                            <!-- Modal content-->
                            <div class="modal-content" style="width: 900px;">
                                <div class="modal-header">
                                    <h4 class="modal-title">Thêm tài khoản Pubg</h4>
                                </div>

                                <div class="modal-body">
                                    <form class="form-horizontal" action="/admin/ngoc-rong/add" enctype="multipart/form-data" method="POST">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group m-b-10 c-square ">
                                                        <span class="input-group-addon" id="basic-addon1">Thông tin</span>
                                                        <input type="text" class="form-control c-square c-theme" name="info" value="" placeholder="Tài khoản|Mật khẩu" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group m-b-10 c-square ">
                                                        <span class="input-group-addon" id="basic-addon1">Giá</span>
                                                        <input type="text" class="form-control c-square c-theme price" name="cost" value="" placeholder="Nhập giá bán" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group m-b-10 c-square ">
                                                        <span class="input-group-addon" id="basic-addon1">Đăng ký</span>
                                                        <select class="form-control c-square c-theme" name="dk" required>
                                                            <option value="">Chọn loại đăng ký</option>
                                                            <?php for ($i = 1; $i < 3; $i++) : ?>
                                                                <option value="<?php echo $i; ?>" <?php if ($i == 1) : ?>selected<?php endif; ?>><?php echo str_dk($i); ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group m-b-10 c-square ">
                                                        <span class="input-group-addon" id="basic-addon1">Server</span>
                                                        <select class="form-control c-square c-theme" name="server" required>
                                                            <option value="">Chọn loại Server</option>
                                                            <?php for ($i = 1; $i < 10; $i++) : ?>
                                                                <option value="<?php echo $i; ?>"><?php echo str_sv($i); ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group m-b-10 c-square ">
                                                        <span class="input-group-addon" id="basic-addon1">Hành Tinh</span>
                                                        <select class="form-control c-square c-theme" name="hanhtinh" required>
                                                            <option value="">Chọn loại hành tinh</option>
                                                            <?php for ($i = 1; $i < 4; $i++) : ?>
                                                                <option value="<?php echo $i; ?>"><?php echo str_ht($i); ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group m-b-10 c-square ">
                                                        <span class="input-group-addon" id="basic-addon1">Sơ Sinh Có Đệ</span>
                                                        <select class="form-control c-square c-theme" name="detu" required>
                                                            <option value="">Chọn loại</option>
                                                            <?php for ($i = 1; $i < 3; $i++) : ?>
                                                                <option value="<?php echo $i; ?>"><?php echo str_dt($i); ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group m-b-10 c-square ">
                                                        <span class="input-group-addon" id="basic-addon1">Bông tai</span>
                                                        <select class="form-control c-square c-theme" name="bongtai" required>
                                                            <option value="">Chọn loại bông tai</option>
                                                            <?php for ($i = 1; $i < 3; $i++) : ?>
                                                                <option value="<?php echo $i; ?>"><?php echo str_bt($i); ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </div>
                                                </div>


                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group m-b-10 c-square ">
                                                        <span class="input-group-addon" id="basic-addon1">Ghi chú</span>
                                                        <textarea class="form-control c-square c-theme" name="note" value="" placeholder="Ghi chú cho tài khoản này" rows="6" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group m-b-10 c-square ">
                                                        <span class="input-group-addon" id="basic-addon1">Loại</span>
                                                        <select class="form-control c-square c-theme" name="active" required>
                                                            <option value="0">Kích Hoạt</option>
                                                            <option value="1">Không kích hoạt</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group m-b-10 c-square ">
                                                        <span class="input-group-addon" id="basic-addon1">Ghim</span>
                                                        <select class="form-control c-square c-theme" name="stick" required>
                                                            <option value="0">Không</option>
                                                            <option value="1">Ghim lên</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group m-b-10 c-square ">
                                                        <span class="input-group-addon" id="basic-addon1">Ảnh đại diện</span>
                                                        <input type="file" class="form-control" id="thumb" name="thumb" accept="image/*" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group m-b-10 c-square ">
                                                        <span class="input-group-addon" id="basic-addon1">Ảnh thông tin</span>
                                                        <input type="file" class="form-control" id="info" name="imginfo[]" accept="image/*" multiple required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div style="clear: both"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info" id="d3" style="">Thêm mới</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Xác nhận xóa nick -->
                    <div id="confirm-delete" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Xác nhận xóa</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn có muốn xóa tài khoản này ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End -->


                    <style type="text/css">
                        .input-group {
                            margin: 10px 0;
                        }

                        .input-group .input-group-addon {
                            border: 1px solid #d0d7de;
                            background: #fafafa;
                            padding: 5px;
                        }
                    </style>

                    @endsection