@extends('admin.master')
@section('content')


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Lịch sử quay số toàn hệ thống</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Giao dịch</a></li>
                    <li class="breadcrumb-item active">Lịch sử quay số toàn hệ thống</li>
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
                        <h3 class="card-title"><i class="fa fa-list"></i> Lịch sử quay số toàn hệ thống (<span style="color: red;">{{number_format($total)}}</span>)</h3>
                    </div>

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

                    <!-- BEGIN: Tìm kiếm -->
                    <form class="form-inline" action="{{Route('admin.giao-dich.delete_all_wheel')}}" method="POST" style="padding: 10px;border-bottom: 1px solid #dee2e6">
                        {{ csrf_field() }}
                        <button style="margin: 0 5px;" type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa toàn bộ lịch sử vòng quay?')"> <i class="fas fa-times-circle"></i> XÓA TOÀN BỘ LỊCH SỬ VÒNG QUAY</button>
                    </form>

                    <form class="form-inline" action="{{Route('admin.giao-dich.history_whell')}}" method="GET" style="padding: 10px;border-bottom: 1px solid #dee2e6">
                        <div class="form-group" style="padding: 5px;">
                            <label for="email">#ID:</label>
                            <input name="id" type="number" placeholder="#ID" class="form-control" id="email">
                        </div>
                        <div class="form-group" style="padding: 5px;">
                            <label style="border: 1px solid #ced4da;padding:10px 3px;" for="pwd"><i class="fa fa-calendar"></i></label>
                            <input name="started_at" type="date" placeholder="Từ ngày" class="form-control" id="pwd">
                        </div>
                        <div class="form-group" style="padding: 5px;">
                            <label style="border: 1px solid #ced4da;padding:10px 3px;" for="pwd"><i class="fa fa-calendar"></i></label>
                            <input name="ended_at" type="date" placeholder="Đến ngày" class="form-control" id="pwd">
                        </div>
                        <br>
                        <button style="margin: 0 5px;" type="submit" class="btn btn-success">Tìm kiếm</button>
                        <a href="{{Route('admin.giao-dich.history_whell')}}" class="btn btn-primary">Tất cả</a>
                    </form>
                    <!-- END: Tìm kiếm -->

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="1" style="text-align: center;">Thời gian</th>
                                    <th colspan="1" style="text-align: center;">ID</th>
                                    <th colspan="1" style="text-align: center;">Người dùng</th>
                                    <th colspan="1" style="text-align: center;">Danh mục</th>
                                    <th colspan="1" style="text-align: center;">Nội dung</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($total>0)

                                @foreach($data as $item)
                                <tr>
                                    <td style="text-align: center;">{{$item->date}}</td>
                                    <td style="text-align: center;">{{$item->id}}</td>
                                    <td style="text-align: center;"><a href="{{Route('admin.manage-users').'?keyword='.$item->name}}">{{$item->name}}</a></td>
                                    <td style="text-align: center;">{{ $wheel->getCategory($item->type, $item->cost) }}</td>
                                    <td style="text-align: center;">{{$item->content}}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" style="text-align: center;">Không có dữ liệu</td>
                                </tr>
                                @endif
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
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

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