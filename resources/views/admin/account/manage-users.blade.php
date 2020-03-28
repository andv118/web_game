@extends('admin.master')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">QUẢN LÝ NGƯỜI DÙNG</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Quản lý người dùng</a></li>
                    <li class="breadcrumb-item active">Danh sách</li>
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
                            {{ $errors->first('cash') }}
                        </div>
                        @endif

                    </div>
                    <!-- END Thông báo -->

                    <!-- BEGIN reset tai khoan -->
                    <div class="row" style="padding: 10px;border-bottom: 1px solid #dee2e6">
                        <a href="{{Route('admin.reset-users')}}" style="margin: 0 5px;" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn reset toàn bộ tài khoản thành viên về 0đ?')">RESET tài khoản thành viên về 0
                        </a>
                    </div>
                    <!-- END reset tai khoan -->

                    <!-- BEGIN tìm kiếm -->
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title"><i class="fa fa-list"></i> {{$title}} (<span style="color: red;">{{number_format($total)}}</span>)</h3>
                        </div>

                        <form class="form-inline" action="{{Route('admin.manage-users')}}" method="GET" style="padding: 10px;border-bottom: 1px solid #dee2e6">
                            <div class="col-md-4 form-group" style="padding: 5px;">
                                <div class="row">
                                    <label>ID#:</label>
                                    <input name="id" type="text" placeholder="ID#" class="form-control" value="{{ isset($dataBack['id']) ? $dataBack['id'] : '' }}">
                                </div>
                            </div>

                            <div class="col-md-4 form-group" style="padding: 5px;">
                                <div class="row">
                                    <label>Người dùng:</label>
                                    <input name="keyword" type="text" placeholder="Tên đăng nhập" class="form-control" value="{{ isset($dataBack['keyword']) ? $dataBack['keyword'] : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4 form-group" style="padding: 5px;">
                                <div class="row">
                                    <button style="margin: 0 5px;" type="submit" class="btn btn-success">Tìm kiếm</button>
                                    <a href="{{Route('admin.manage-users')}}" style="margin: 0 5px;" class="btn btn-primary">Tất cả</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END tìm kiếm -->

                    <!-- BEGIN: data -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="1" style="text-align: center;">ID</th>
                                    <th colspan="1" style="text-align: center;">Tên đăng nhập</th>
                                    <th colspan="1" style="text-align: center;">Email</th>
                                    <th colspan="1" style="text-align: center;">SĐT</th>
                                    <th colspan="1" style="text-align: center;">Số dư</th>
                                    <th colspan="1" style="text-align: center;">Nhóm</th>
                                    <th colspan="2" style="text-align: center;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $user)
                                <tr>
                                    <td style="text-align: center;">{{$user->id}}</td>
                                    <td style="text-align: center;">{{$user->name}}</td>
                                    <td style="text-align: center;">{{$user->email}}</td>
                                    <td style="text-align: center;">{{$user->user_phone}}</td>
                                    <td style="text-align: center;">{{number_format($user->cash) . 'đ'}}</td>
                                    <td style="text-align: center;">
                                        @if($user->is_admin == 1) Admin
                                        @else Thành viên
                                        @endif
                                    </td>
                                    <td style="text-align: center;"><button rel="{{Route('admin.update-users',$user->id)}}" type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_update_user" data-userid="{{$user->user_id}}" data-name="{{$user->name}}" data-agent="{{$user->user_agent}}" data-locked="{{$user->locked}}" data-email="{{$user->email}}" data-phone="{{$user->user_phone}}" data-cash="{{$user->cash}}"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                    <td style="text-align:center;"><a title="Xóa" href="{{Route('admin.delete-users',$user->id)}}" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa -{{$user->name}} ?')"><i class="fas fa-times-circle"></i> Xóa</a></td>
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
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@include('admin.account.update')

<script>
    $(document).ready(function() {
        $('#modal_update_user').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var userId = button.data('userid')
            var userName = button.data('name')
            var agent = button.data('agent')
            var locked = button.data('locked')
            var email = button.data('email')
            var phone = button.data('phone')
            var cash = button.data('cash')

            var modal = $(this)
            modal.find('input[name="user_id"]').val(userId)
            modal.find('#user_name').text(userName)
            modal.find('input[name="user_agent"]').val(agent)
            modal.find('input[name="email"]').val(email)
            modal.find('input[name="phone"]').val(phone)
            modal.find('input[name="cash"]').val(cash)

            modal.find('select  option[value="0"]').removeAttr("selected");
            modal.find('select  option[value="1"]').removeAttr("selected");
            if (locked == 1) {
                modal.find('select  option[value="1"]').attr("selected", "selected");
            }
        })
    });
</script>


@endsection