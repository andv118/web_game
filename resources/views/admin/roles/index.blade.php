@extends('admin.master')

@section('content')

@if(Session::has('success-update'))
<script type="text/javascript">
    $(document).ready(function() {
        alert('Cập nhật thành công !');

    });
</script>
@endif
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Phân quyền</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Quản lý người dùng</a></li>
                    <li class="breadcrumb-item active">Phân quyền</li>
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
                        @endif

                    </div>
                    <!-- END Thông báo -->

                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title"><i class="fa fa-list"></i> {{$title}} (<span style="color: red;">{{number_format($total)}}</span>)</h3>
                        </div>

                        <!-- BEGIN tìm kiếm -->
                        <form class="form-inline" action="{{Route('admin.roles')}}" method="GET" style="padding: 10px;border-bottom: 1px solid #dee2e6">

                            <div class="col-md-4 form-group" style="padding: 5px;">
                                <div class="row">
                                    <label>Người dùng:</label>
                                    <input name="keyword" type="text" placeholder="Tên đăng nhập" class="form-control" value="{{ isset($dataBack['keyword']) ? $dataBack['keyword'] : '' }}">
                                </div>
                            </div>

                            <div class="row">
                                <button style="margin: 0 5px;" type="submit" class="btn btn-success">Tìm kiếm</button>
                                <a href="{{Route('admin.roles')}}" style="margin: 0 5px;" class="btn btn-primary">Tất cả</a>
                            </div>
                        </form>
                        <!-- END tìm kiếm -->

                    </div>

                    <div class="card-body table-responsive p-0">

                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="1" style="text-align: center;">STT</th>
                                    <th colspan="1" style="text-align: center;">Tên đăng nhập</th>
                                    <th colspan="1" style="text-align: center;">Email</th>
                                    <th colspan="1" style="text-align: center;">SĐT</th>
                                    <th colspan="1" style="text-align: center;">Nhóm</th>
                                    <th colspan="2" style="text-align: center;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 0; ?>
                                @foreach($data as $user)
                                <tr>
                                    <td style="text-align: center;">{{$stt+=1}}</td>
                                    <td style="text-align: center;">{{$user->name}}</td>
                                    <td style="text-align: center;">{{$user->email}}</td>
                                    <td style="text-align: center;">{{$user->user_phone}}</td>
                                    <td style="text-align: center;">
                                        @if($user->is_admin == 1) Admin
                                        @else Thành viên
                                        @endif
                                    </td>
                                    <td style="text-align: center;"><button title="Cập nhật quyền" type="button" class="btn btn-info load-modal" data-toggle="modal" data-target="#myModal{{$user->id}}"><i class="fa fa-edit"></i> Cập nhật quyền</button></td>
                                    <td style="text-align:center;"><a title="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa?')" href="{{Route('admin.delete-users',$user->id)}}" class="btn btn-danger"><i class="fas fa-times-circle"></i> Xóa</a></td>
                                </tr>

                                <!-- Modal -->
                                <div id="myModal{{$user->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" style="text-align: center;">Cập nhật quyền</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div><b>Tài khoản:</b> {{$user->name}}</div>
                                                <form method="get" action="{{Route('admin.update_roles',$user->id)}}">
                                                    <select class="form-control" name="role" required="true" style="margin: 15px 0;">
                                                        @if($user->is_admin==1)
                                                        <option value="1">Admin</option>
                                                        <option value="0">Thành viên</option>
                                                        @endif
                                                    </select>
                                                    <button type="submit" style="width: 30%;" class="btn btn-info"><i class="fas fa-retweet"></i> Cập nhật</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="justify-panel" style="margin: 30px 0;display: flex;justify-content: center;align-items: center;">
                            {{$data->appends(request()->query())->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection