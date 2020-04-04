@extends('admin.master')
@section('content')

<!-- BEGIN Content Header  -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">LỊCH SỬ GIAO DỊCH TOÀN HỆ THỐNG</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Giao dịch</li>
                    <li class="breadcrumb-item active">lịch sử giao dịch</li>
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
                    <form class="form-inline" action="{{Route('admin.giao-dich.delete_all_transaction')}}" method="POST" style="padding: 10px;border-bottom: 1px solid #dee2e6">
                        {{ csrf_field() }}
                        <button style="margin: 0 5px;" type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa toàn bộ lịch sử giao dịch?')"> <i class="fas fa-times-circle"></i> XÓA TOÀN BỘ LỊCH SỬ GIAO DỊCH</button>
                    </form>

                    <form class="form-inline" action="{{Route('admin.giao-dich.history_transaction')}}" method="GET" style="padding: 10px;border-bottom: 1px solid #dee2e6">

                        <div class="col-md-5 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="email">Người mua:</label>
                                <input name="user_name" type="text" placeholder="Tài khoản mua..." class="form-control" value="{{ isset($dataBack['user_name']) ? $dataBack['user_name'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-5 form-group" style="padding: 5px;">
                            <div class="row">
                                <label>Giao dịch:</label>
                                <select class="form-control" name="transaction">
                                    <option value="">-- Tất cả --</option>
                                    <option value="1" <?php if (isset($dataBack) && $dataBack['transaction'] == 1) {
                                                            echo "selected";
                                                        } ?>>Hoàn tiền</option>
                                    <option value="2" <?php if (isset($dataBack) && $dataBack['transaction'] == 2) {
                                                            echo "selected";
                                                        } ?>>Chuyển tiền</option>
                                    <option value="3" <?php if (isset($dataBack) && $dataBack['transaction'] == 3) {
                                                            echo "selected";
                                                        } ?>>Nhận tiền</option>
                                    <option value="4" <?php if (isset($dataBack) && $dataBack['transaction'] == 4) {
                                                            echo "selected";
                                                        } ?>>Nạp tiền</option>
                                    <option value="5" <?php if (isset($dataBack) && $dataBack['transaction'] == 5) {
                                                            echo "selected";
                                                        } ?>>Mua tài khoản</option>
                                    <option value="6" <?php if (isset($dataBack) && $dataBack['transaction'] == 6) {
                                                            echo "selected";
                                                        } ?>>Đặt cọc</option>
                                    <option value="7" <?php if (isset($dataBack) && $dataBack['transaction'] == 7) {
                                                            echo "selected";
                                                        } ?>>Bán tài khoản</option>
                                    <option value="8" <?php if (isset($dataBack) && $dataBack['transaction'] == 8) {
                                                            echo "selected";
                                                        } ?>>Dịch vụ</option>
                                    <option value="9" <?php if (isset($dataBack) && $dataBack['transaction'] == 9) {
                                                            echo "selected";
                                                        } ?>>Vòng quay</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-5 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="pwd">Từ ngày: </label>
                                <input name="started_at" type="date" placeholder="Từ ngày" class="form-control" value="{{ isset($dataBack['started_at']) ? $dataBack['started_at'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-5 form-group" style="padding: 5px;">
                            <div class="row">
                                <label for="pwd">Đến ngày: </label>
                                <input name="ended_at" type="date" placeholder="Đến ngày" class="form-control" value="{{ isset($dataBack['ended_at']) ? $dataBack['ended_at'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-2 form-group" style="padding: 5px;">
                            <div class="row">
                                <button style="margin: 0 5px;" type="submit" class="btn btn-success">Tìm kiếm</button>
                                <a href="{{Route('admin.giao-dich.history_transaction')}}" style="margin: 0 5px;" class="btn btn-primary">Tất cả</a>
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
                                    <th colspan="1" style="text-align: center;">Giao dịch </th>
                                    <th colspan="1" style="text-align: center;">Số tiền</th>
                                    <th colspan="1" style="text-align: center;">Số dư cuối</th>
                                    <th colspan="1" style="text-align: center;">Nội dung</th>
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
                                        <td style="text-align: left;">{{ $transaction->getTradeType($item->trade_type) }}</td>
                                        <td style="text-align: center;">{{number_format($item->amount) . "đ"}}</td>
                                        <td style="text-align: center;">{{number_format($item->last_amount) . "đ"}}</td>
                                        <td style="text-align: left;">{{$item->content}}</td>
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