@extends('admin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">BẢNG ĐIỀU KHIỂN</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Bảng điều khiển</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- BEGIN: Bảng thống kê -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <p>Thành viên</p>
                        <h3>{{$users}}</h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <p class="small-box-footer">{{$day . " ngày qua: " . $usersPerformance}}</p>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <p>Tổng số dư</p>
                        <h3>{{number_format($amounts)}}</h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <p class="small-box-footer">{{$day . " ngày qua: " . $amountsPercent}}<sup>%</sup></p>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <p>Thẻ đã gạch</p>
                        <h3>{{$cards}}</h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-card"></i>
                    </div>
                    <p class="small-box-footer">{{$day . " ngày qua: " . $cardsPerformance}}</p>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <p>Tiền đã nạp</p>
                        <h3>{{ number_format($cardsAmount)}}<sup>đ</sup></h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                    <p class="small-box-footer">{{$day . " ngày qua: " . number_format($cardsAmountPerformance)}}<sup>đ</sup></p>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <p>Tổng doanh thu</p>
                        <h3>{{ number_format($doanhThu['tong'])}}<sup>đ</sup></h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                    <p class="small-box-footer">Tổng số nick đã bán: {{ $acc['tong']}}</p>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <p>Doanh thu hôm nay</p>
                        <h3>{{ number_format($doanhThu['HomNay'])}}<sup>đ</sup></h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                    <p class="small-box-footer">Số nick đã bán hôm nay: {{ $acc['HomNay']}}</p>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <p>Doanh thu tháng này</p>
                        <h3>{{ number_format($doanhThu['ThangNay'])}}<sup>đ</sup></h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                    <p class="small-box-footer">Số nick đã bán tháng này: {{ $acc['ThangNay']}}</p>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <p>Doanh thu tháng trước</p>
                        <h3>{{ number_format($doanhThu['ThangTruoc'])}}<sup>đ</sup></h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                    <p class="small-box-footer">Số nick đã bán tháng trước: {{ $acc['ThangTruoc']}}</p>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- END: Bảng thống kê -->

        <!-- BEGIN: Thống kê theo danh mục -->
        <div class="card card-success">
            <div class="card-header border-transparent">
                <h2 class="card-title c-font-uppercase">THỐNG KÊ HÔM NAY / THÁNG NÀY</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="stat" class="table table-bordered table-striped table-custom-res">
                        <thead>
                            <tr>
                                <td colspan="2" style="width:30%;font-weight:bold;text-align:center">Doanh Thu Ngày</td>
                                <td colspan="2" style="width:30%;font-weight:bold;text-align:center">Doanh Thu Tháng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width:30%;font-weight:bold;">Ngọc Rồng</td>
                                <td>{{ number_format($arrdoanhthugame['ngoc_rong']['day']) . 'đ'}}</td>
                                <td style="width:30%;font-weight:bold;">Ngọc Rồng</td>
                                <td>{{ number_format($arrdoanhthugame['ngoc_rong']['mon']) . 'đ' }}</td>
                            </tr>

                            <tr>
                                <td style="width:30%;font-weight:bold;">Dịch Vụ</td>
                                <td>{{ number_format($arrdoanhthugame['dich_vu']['day']) . 'đ'}}</td>
                                <td style="width:30%;font-weight:bold;">Dịch Vụ</td>
                                <td>{{ number_format($arrdoanhthugame['dich_vu']['mon']) . 'đ' }}</td>
                            </tr>

                            <tr>
                                <td style="width:30%;font-weight:bold;">Random Ngọc Rồng</td>
                                <td>{{ number_format($arrdoanhthugame['random']['day']) . 'đ'}}</td>
                                <td style="width:30%;font-weight:bold;">Random Ngọc Rồng</td>
                                <td>{{ number_format($arrdoanhthugame['random']['mon']) . 'đ' }}</td>
                            </tr>


                            <tr>
                                <td style="width:30%;font-weight:bold;">Mua lượt quay</td>
                                <td>{{ number_format($arrdoanhthugame['vong_quay']['day']) . 'đ'}}</td>
                                <td style="width:30%;font-weight:bold;">Mua lượt quay</td>
                                <td>{{ number_format($arrdoanhthugame['vong_quay']['mon']) . 'đ' }}</td>
                            </tr>

                        </tbody>

                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- END: Thống kê theo danh mục -->

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection