@extends('admin.master')
@section('content')

<!-- BEGIN Content Header  -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">LỊCH SỬ MUA TOÀN HỆ THỐNG</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Giao dịch</li>
                    <li class="breadcrumb-item active">lịch sử mua</li>
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
                    <form class="form-inline" action="{{Route('admin.giao-dich.delete_all_buy')}}" method="POST" style="padding: 10px;border-bottom: 1px solid #dee2e6">
                        {{ csrf_field() }}
                        <button style="margin: 0 5px;" type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa toàn bộ lịch sử mua?')"> <i class="fas fa-times-circle"></i> XÓA TOÀN BỘ LỊCH SỬ MUA</button>
                    </form>

                    <form class="form-inline" action="{{Route('admin.giao-dich.history_buy')}}" method="GET" style="padding: 10px;border-bottom: 1px solid #dee2e6">

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="email">Mã ID#:</label>
                                <input name="id" type="text" placeholder="Mã ID" class="form-control" value="{{ isset($dataBack['id']) ? $dataBack['id'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="email">Người mua:</label>
                                <input name="user_name" type="text" placeholder="Tài khoản mua..." class="form-control" value="{{ isset($dataBack['user_name']) ? $dataBack['user_name'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <label>Danh mục game:</label>
                                <select class="form-control" name="game_type">
                                    <option value="">-- Tất cả --</option>
                                    <option value="1" <?php if (isset($dataBack) && $dataBack['game_type'] == 1) {
                                                            echo "selected";
                                                        } ?>>Liên Minh</option>
                                    <option value="2" <?php if (isset($dataBack) && $dataBack['game_type'] == 2) {
                                                            echo "selected";
                                                        } ?>>Liên Quân</option>
                                    <option value="3" <?php if (isset($dataBack) && $dataBack['game_type'] == 3) {
                                                            echo "selected";
                                                        } ?>>Ngọc Rồng</option>
                                    <option value="4" <?php if (isset($dataBack) && $dataBack['game_type'] == 4) {
                                                            echo "selected";
                                                        } ?>>Free Fire</option>
                                    <option value="5" <?php if (isset($dataBack) && $dataBack['game_type'] == 5) {
                                                            echo "selected";
                                                        } ?>>Đột Kích</option>
                                    <option value="6" <?php if (isset($dataBack) && $dataBack['game_type'] == 6) {
                                                            echo "selected";
                                                        } ?>>Zing Speed</option>
                                    <option value="7" <?php if (isset($dataBack) && $dataBack['game_type'] == 7) {
                                                            echo "selected";
                                                        } ?>>BUBG</option>
                                    <option value="8" <?php if (isset($dataBack) && $dataBack['game_type'] == 8) {
                                                            echo "selected";
                                                        } ?>>Random</option>
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

                        <div class="col-md-4 form-group" style="padding: 5px;">
                            <div class="row">
                                <button style="margin: 0 5px;" type="submit" class="btn btn-success">Tìm kiếm</button>
                                <a href="{{Route('admin.giao-dich.history_buy')}}" style="margin: 0 5px;" class="btn btn-primary">Tất cả</a>
                            </div>
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
                                    <th colspan="1" style="text-align: center;">Game</th>
                                    <th colspan="1" style="text-align: center;">Danh mục</th>
                                    <th colspan="1" style="text-align: center;">Số tiền</th>
                                    <th colspan="1" style="text-align: center;">Chi tiết</th>
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
                                        <td style="text-align: center;">{{$item->game_name}}</td>
                                        <td style="text-align: left;">{{$item->type}}</td>
                                        <td style="text-align: center;">{{number_format($item->cost) . "đ"}}</td>
                                        <td style="text-align: left;">{{$item->desc}}</td>
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

@endsection