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

<!-- BEGIN: Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Random</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a>Tài khoản game</a></li>
                    <li class="breadcrumb-item active">Random</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- END: Header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- BEGIN: Thông báo -->
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
                        <h3 class="card-title"><i class="fa fa-list"></i> Danh sách tài khoản Random(<span style="color: red;">{{number_format($total)}}</span>)</h3>
                        <div class="card-tools">
                            <div class="input-group-append">
                                <button class="btn btn-info" data-toggle="modal" data-target="#edit_modal_random"><i class="fa fa-plus"></i> Thêm mới</button>
                            </div>
                        </div>
                    </div>


                    <!-- BEGIN: Tìm kiếm -->
                    <form class="form-inline" action="{{Route('admin.tk_random')}}" method="GET" style="padding: 10px;border-bottom: 1px solid #dee2e6">

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
                                <label for="pwd">Trạng thái:</label>
                                <select name="status" class="form-control">
                                    <option value="">--Tất cả--</option>
                                    <option value="0" <?php if (asset($dataBack['status']) && $dataBack['status'] == 0) echo "selected"; ?>>Chưa bán</option>
                                    <option value="1" <?php if (asset($dataBack['status']) && $dataBack['status'] == 1) echo "selected"; ?>>Đã bán</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label>Loại:</label>
                                <select name="type" class="form-control">
                                    <option value="0" <?php if (asset($dataBack['type']) && $dataBack['type'] == 0) echo "selected"; ?>>Random Ngọc Rồng</option>
                                    <option value="1" <?php if (asset($dataBack['type']) && $dataBack['type'] == 1) echo "selected"; ?>>Random PUBG</option>
                                    <option value="2" <?php if (asset($dataBack['type']) && $dataBack['type'] == 2) echo "selected"; ?>>Random Liên Quân</option>
                                    <option value="3" <?php if (asset($dataBack['type']) && $dataBack['type'] == 3) echo "selected"; ?>>Random Free Fire</option>
                                    <option value="4" <?php if (asset($dataBack['type']) && $dataBack['type'] == 4) echo "selected"; ?>>Random Liên Minh</option>
                                    <option value="5" <?php if (asset($dataBack['type']) && $dataBack['type'] == 5) echo "selected"; ?>>Random Mở Rương</option>
                                    <option value="" <?php if (asset($dataBack['type']) && $dataBack['type'] == null) echo "selected"; ?>>--Tất cả--</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <button style="margin: 0 5px;" type="submit" class="btn btn-success">Tìm kiếm</button>
                                <a href="{{Route('admin.tk_random')}}" class="btn btn-primary">Tất cả</a>
                            </div>
                        </div>
                    </form>
                    <!-- END: Tìm kiếm -->

                    <!-- BEGIN: Data -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="1" style="text-align: center;">STT</th>
                                    <th colspan="1" style="text-align: center;">#</th>
                                    <th colspan="1" style="text-align: center;">Người đăng</th>
                                    <th colspan="1" style="text-align: center;">Tài khoản|Mật khẩu </th>
                                    <th colspan="1" style="text-align: center;">Danh mục</th>
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
                                    <td style="text-align: left;">{{$item->info}}</td>
                                    <td style="text-align: center;">{{ $random->getType($item->type) }}</td>
                                    <td style="text-align: center;">{{number_format($item->cost) . "đ" }}</td>
                                    <td style="text-align: center;"> <?php if ($item->status == 1) echo "Đã bán";
                                                                        else echo "Chưa bán"; ?> </td>

                                    @if($item->status == 1)
                                    <td colspan="2" style="text-align: center;"></td>
                                    @else
                                    <td style="text-align: center;"><button type="button" data-toggle="modal" data-target="#update_modal_random" class="btn btn-info update_random " data-id="{{$item->id}}" data-infor="{{$item->info}}" data-type="{{$item->type}}"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                    <td style="text-align:center;"><a href="{{Route('admin.delete_random',$item->id)}}" title="Xóa" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa toàn tài khoản?')"><i class="fas fa-times-circle"></i> Xóa</a></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="justify-panel" style="margin: 30px 0;display: flex;justify-content: center;align-items: center;">
                            {{ $data->appends(request()->query())->links() }}
                        </div>

                    </div>
                    <!-- END: Data -->

                </div>
            </div>
        </div>
    </div>
</section>



<!-- END: content -->

@include('admin.random.modal')

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
        var arrCategory = [
            ['[NR] Vận May Ngọc Rồng 20K', '[NR] Vận May Ngọc Rồng 50K', '[NR] Vận May Ngọc Rồng 100K'],
            ['[PUBG] Vận May PUBG 10K', '[PUBG] Vận May PUBG 50K', '[PUBG] Vận May PUBG 100K'],
            ['[LQ] Vận May Liên Quân 10K', '[LQ] Vận May Liên Quân 50K', '[LQ] Vận May Liên Quân 100K'],
            ['[FF] Vận May Free Fire 10K', '[FF] Vận May Free Fire 50K', '[FF] Vận May Free Fire 100K'],
        ];

        $('#select_type').change(function() {
            var type = $(this).val();
            updateCategory(type);
        });

        $('#select_type_update').change(function() {
            $('#select_category_update').find('option').remove();
            $('#select_category_update').append('<option value="">Chọn loại</option>');
            var type = $(this).val();
            var option = '';
            arrCategory.forEach(function(item, index) {
                if (type == index) {
                    item.forEach(function(value, index) {
                        option = '<option value="' + index + '">' + value + '</option>';
                        $('#select_category_update').append(option);
                    });
                }
            })
        });

        $('.update_random').on('click', function(event) {
            $('#update_modal_random').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                // console.log(123);
                var id = button.data('id')
                var infor = button.data('infor')
                var type = button.data('type')
                // console.log(type)
                var modal = $(this)
                modal.find('input[name="id"]').val(id)
                modal.find('#update_random_id').text(id)
                modal.find('input[name="infor"]').val(infor)
                selectOption(modal.find('select[name="type"]'), type);
            })
        });

        function selectOption(select, value) {
            $(select).find('option').each(function(i, e) {
                if ($(e).val() == value) {
                    $(select).prop('selectedIndex', i);
                }
            });
        }

        function updateCategory(type) {
            $('#select_category').find('option').remove();
            $('#select_category').append('<option value="">Chọn loại</option>');
            var option = '';
            arrCategory.forEach(function(item, index) {
                if (type == index) {
                    item.forEach(function(value, index) {
                        option = '<option value="' + index + '">' + value + '</option>';
                        $('#select_category').append(option);
                    });
                }
            })
        }

    });
</script>

@endsection