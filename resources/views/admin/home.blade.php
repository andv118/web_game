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

        <!-- /.row -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-piggy-bank"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Doanh thu nạp thẻ tháng này</span>
                        <span class="info-box-number">
                            {{number_format($doanhthuthang) . "đ"}}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Doanh thu nạp thẻ hôm nay</span>
                        <span class="info-box-number"> {{ number_format($doanhthungay) . "đ" }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-tag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tài khoản còn lại</span>
                        <span class="info-box-number">{{number_format($acc_conlai)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tài khoản đã bán</span>
                        <span class="info-box-number">{{number_format($acc_daban)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tài khoản người dùng</span>
                        <span class="info-box-number">{{number_format($users)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

        </div>

        <!-- BEGIN: Thống kê theo tháng -->
        <div class="card card-success">
            <div class="card-header border-transparent">
                <h2 class="card-title c-font-uppercase">THỐNG KÊ HÀNG THÁNG</h2>
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
                        <tbody>
                            <tr class="">
                                <td style="width:30%;font-weight:bold;">Tháng 1</td>
                                <td> {{number_format($arrdoanhthucacthang[1]) ."đ" }}</td>
                                <td style="width:30%;font-weight:bold;">Tháng 7</td>
                                <td> {{number_format($arrdoanhthucacthang[7]) ."đ" }}</td>
                            </tr>
                            <tr class="">
                                <td style="width:30%;font-weight:bold;">Tháng 2</td>
                                <td> {{number_format($arrdoanhthucacthang[2]) ."đ" }}</td>
                                <td style="width:30%;font-weight:bold;">Tháng 8</td>
                                <td> {{number_format($arrdoanhthucacthang[8]) ."đ" }}</td>
                            </tr>

                            <tr>
                                <td style="width:30%;font-weight:bold;">Tháng 3</td>
                                <td> {{number_format($arrdoanhthucacthang[3]) ."đ" }}</td>
                                <td style="width:30%;font-weight:bold;">Tháng 9</td>
                                <td> {{number_format($arrdoanhthucacthang[9]) ."đ" }}</td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight:bold;">Tháng 4</td>
                                <td> {{number_format($arrdoanhthucacthang[4]) ."đ" }}</td>
                                <td style="width:30%;font-weight:bold;">Tháng 10</td>
                                <td> {{number_format($arrdoanhthucacthang[10]) ."đ" }}</td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight:bold;">Tháng 5</td>
                                <td> {{number_format($arrdoanhthucacthang[5]) ."đ" }}</td>
                                <td style="width:30%;font-weight:bold;">Tháng 11</td>
                                <td> {{number_format($arrdoanhthucacthang[11]) ."đ" }}</td>

                            </tr>
                            <tr>
                                <td style="width:30%;font-weight:bold;">Tháng 6</td>
                                <td> {{number_format($arrdoanhthucacthang[6]) ."đ" }}</td>
                                <td style="width:30%;font-weight:bold;">Tháng 12</td>
                                <td> {{number_format($arrdoanhthucacthang[12]) ."đ" }}</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- END: Thống kê theo tháng -->

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
                        <tbody>
                            <tr class="">
                                <td style="width:30%;font-weight:bold;">Liên Quân Mobile</td>
                                <td>đ</td>
                                <td style="width:30%;font-weight:bold;">PUBG Mobile</td>
                                <td>đ</td>
                            </tr>
                            <tr class="">
                                <td style="width:30%;font-weight:bold;">Ngọc Rồng</td>
                                <td>đ</td>
                                <td style="width:30%;font-weight:bold;">Free Fire</td>
                                <td>đ</td>
                            </tr>


                            <tr>
                                <td style="width:30%;font-weight:bold;">Vận May Ngọc Rồng 20K</td>
                                <td>đ</td>
                                <td style="width:30%;font-weight:bold;">Vận May Ngọc Rồng 50K</td>
                                <td>đ</td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight:bold;">Vận May Ngọc Rồng 100K</td>
                                <td>đ</td>
                                <td style="width:30%;font-weight:bold;">Mua lượt quay</td>
                                <td>đ</td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight:bold;">Lập Thẻ Siêu Phẩm</td>
                                <td>đ</td>
                                <td style="width:30%;font-weight:bold;">Máy Quay Quà</td>
                                <td>đ</td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight:bold;">Gắp Nick Ngẫu Nhiên</td>
                                <td>đ</td>
                                <td style="width:30%;font-weight:bold;">Súng Bắn Quà</td>
                                <td>đ</td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight:bold;">Thử Vận May Vàng</td>
                                <td>đ</td>
                                <td style="width:30%;font-weight:bold;">Súng Bắn Quà</td>
                                <td>đ</td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight:bold;">Vận May Liên Quân 10K</td>
                                <td>đ</td>
                                <td style="width:30%;font-weight:bold;">Vận May Liên Quân 50K</td>
                                <td>đ</td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight:bold;">Vận May Liên Quân 100K</td>
                                <td>đ</td>
                                <td style="width:30%;font-weight:bold;">Vận May Free Fire 10K</td>
                                <td>đ</td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight:bold;">Vận May Free Fire 50K</td>
                                <td>đ</td>
                                <td style="width:30%;font-weight:bold;">Vận May Free Fire 100K</td>
                                <td>đ</td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight:bold;">Vận May PUBG 10K</td>
                                <td>đ</td>
                                <td style="width:30%;font-weight:bold;">Vận May PUBG 50K</td>
                                <td>đ</td>
                            </tr>
                            <tr>
                                <td style="width:30%;font-weight:bold;">Vận May PUBG 100K</td>
                                <td>đ</td>
                                <td style="width:30%;font-weight:bold;">Dịch Vụ</td>
                                <td>đ</td>
                            </tr>



                        </tbody>

                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- END: Thống kê theo danh mục -->


        <!-- Main row -->
        <div class="row">
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-12 connectedSortable">

                <!-- Map card -->
                <div style="display: none;" class="card bg-gradient-primary">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            Bản đồ
                        </h3>
                        <!-- card tools -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Date range">
                                <i class="far fa-calendar-alt"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body">
                        <!-- <div id="world-map" style="height: 250px; width: 100%;"></div> -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119211.75060264279!2d105.53251430175315!3d20.97791258945977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134507b74fcee35%3A0xc694456710cedd95!2zUXXhu5FjIE9haSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1578468654516!5m2!1svi!2s" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                    <!-- /.card-body-->
                    <div class="card-footer bg-transparent" style="display: none;">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.card -->

                <!-- Calendar -->
                <div class="card bg-gradient-success">
                    <div class="card-header border-0">

                        <h3 class="card-title">
                            <i class="far fa-calendar-alt"></i>
                            Lịch
                        </h3>
                        <!-- tools card -->
                        <div class="card-tools">
                            <!-- button with a dropdown -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-bars"></i></button>
                                <div class="dropdown-menu float-right" role="menu">
                                    <a href="#" class="dropdown-item">Thêm sự kiện mới</a>
                                    <a href="#" class="dropdown-item">Xóa sự kiện</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">Xem lịch</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pt-0">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection