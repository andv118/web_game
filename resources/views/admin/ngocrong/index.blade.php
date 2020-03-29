@extends('admin.master')

@section('content')

<?php
if (isset($_GET["page"])) {
    $page = preg_replace("#[^0-9]#", "", $_GET["page"]);
} else {
    $page = 1;
}
$perPage = 30;
$stt = $perPage * ($page - 1);
?>

<!-- BEGIN: content-header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Ngọc Rồng</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Tài khoản game</a></li>
                    <li class="breadcrumb-item active">Ngọc Rồng</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- END: content-header -->

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

                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-list"></i> Danh sách tài khoản Ngọc Rồng (<span style="color: red;">{{number_format($total)}}</span>)</h3>
                        <div class="card-tools">
                            <div class="input-group-append">
                                <button class="btn btn-info" data-toggle="modal" data-target="#edit_modal"><i class="fa fa-plus"></i> Thêm mới</button>
                            </div>
                        </div>
                    </div>

                    <!-- BEGIN: Tìm kiếm -->
                    <form id="add_ngocrong" class="form-inline" action="{{Route('admin.tk_ngocrong')}}" method="GET" style="padding: 10px;border-bottom: 1px solid #dee2e6">

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="pwd">#ID:</label>
                                <input name="id" type="text" placeholder="#ID" class="form-control" value="{{ isset($dataBack['id']) ? $dataBack['id'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="pwd">Tên đăng nhập:</label>
                                <input name="infor" type="text" placeholder="Tên đăng nhập" class="form-control" value="{{ isset($dataBack['infor']) ? $dataBack['infor'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="pwd">Người đăng:</label>
                                <input name="user_post" type="text" placeholder="Tên đăng nhập CTV" class="form-control" value="{{ isset($dataBack['user_post']) ? $dataBack['user_post'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="pwd">Loại:</label>
                                <select name="status" class="form-control">
                                    <option value="">--Tất cả--</option>
                                    <option value="0">Chưa bán</option>
                                    <option value="1">Đã bán</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <button style="margin: 0 5px;" type="submit" class="btn btn-success">Tìm kiếm</button>
                                <a href="{{Route('admin.tk_ngocrong')}}" class="btn btn-primary">Tất cả</a>
                            </div>
                        </div>
                    </form>
                    <!-- END: Tìm kiếm -->

                    <!-- BEGIN: data -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="1" style="text-align: center;">STT</th>
                                    <th colspan="1" style="text-align: center;">#ID</th>
                                    <th colspan="1" style="text-align: center;">Người đăng</th>
                                    <th colspan="1" style="text-align: center;">Tài khoản|Mật khẩu </th>
                                    <th colspan="1" style="text-align: center;">Đăng ký</th>
                                    <th colspan="1" style="text-align: center;">Giá</th>
                                    <th colspan="1" style="text-align: center;">Trạng thái</th>
                                    <th colspan="2" style="text-align: center;">Thao tác</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td style="text-align: center;">{{$stt+=1}}</td>
                                    <td style="text-align: center;">{{$item->id}}</td>
                                    <td style="text-align: center;"><a href="{{Route('admin.manage-users').'?keyword='.$item->name}}">{{$item->name}}</a></td>
                                    <td style="text-align: center;">{{$item->info}}</td>
                                    <td style="text-align: center;">{{ $ngocrong->strDangKy($item->dk) }}</td>
                                    <td style="text-align: center;">{{number_format($item->cost) . "đ" }}</td>
                                    <td style="text-align: center;"> <?php if ($item->status == 1) echo "Đã bán";
                                                                        else echo "Chưa bán"; ?> </td>

                                    @if($item->status == 1)
                                    <td colspan="2" style="text-align: center;"></td>
                                    @else
                                    <td style="text-align: center;"><button id="update_ngocrong" type="button" data-toggle="modal" data-target="#modal_update_ngocrong" class="btn btn-info" data-id="{{$item->id}}" data-infor="{{$item->info}}" data-cost="{{$item->cost}}" data-dangky="{{$item->dk}}" data-server="{{$item->server}}" data-hanhtinh="{{$item->hanhtinh}}" data-detu="{{$item->detu}}" data-bongtai="{{$item->bongtai}}" data-note="{{$item->note}}" data-active="{{$item->active}}" data-stick="{{$item->stick}}"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                    <td style="text-align:center;"><a href="{{Route('admin.delete_ngocrong',$item->id)}}" title="Xóa" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa toàn tài khoản?')"><i class="fas fa-times-circle"></i> Xóa</a></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="justify-panel" style="margin: 30px 0;display: flex;justify-content: center;align-items: center;">
                            {{$data->appends(request()->query())->links()}}
                        </div>
                    </div>
                     <!-- END: data -->
                </div>
            </div>
        </div>
</section>

@include('admin.ngocrong.modal')

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

<script>
    $(document).ready(function() {
        $('#update_ngocrong').on('click', function(event) {
            $('#modal_update_ngocrong').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                // console.log(123);

                var id = button.data('id')
                var infor = button.data('infor') 
                var cost = button.data('cost')
                var dangky = button.data('dangky')
                var server = button.data('server')
                var hanhtinh = button.data('hanhtinh')
                var detu = button.data('detu')
                var bongtai = button.data('bongtai')
                var note = button.data('note')
                var active = button.data('active')
                var stick = button.data('stick')

                // console.log(stick)

                var modal = $(this)
                modal.find('.modal-title').text('Sửa tài khoản Ngọc Rồng #' + id)
                modal.find('input[name="id"]').val(id)
                modal.find('input[name="infor"]').val(infor)
                modal.find('input[name="cost"]').val(cost)
                modal.find('input[name="note"]').val(note)
                selectOption(modal.find('select[name="dangky"]'), dangky);
                selectOption(modal.find('select[name="server"]'), server);
                selectOption(modal.find('select[name="hanhtinh"]'), hanhtinh);
                selectOption(modal.find('select[name="detu"]'), detu);
                selectOption(modal.find('select[name="bongtai"]'), bongtai);
                selectOption(modal.find('select[name="active"]'), active);
                selectOption(modal.find('select[name="stick"]'), stick);

            })
        });

        function selectOption(select, value) {
            $(select).find('option').each(function(i, e) {
                if ($(e).val() == value) {
                    $(select).prop('selectedIndex', i);
                }
            });
        }
    });
</script>

@endsection