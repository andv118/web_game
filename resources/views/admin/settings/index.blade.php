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
                <h1 class="m-0 text-dark">Cài đặt trang web</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Cài đặt</a></li>
                    <li class="breadcrumb-item active">Cài đặt trang web</li>
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
                    </div>

                    <div class="card-body table-responsive p-0">
                        <form method="POST" action="{{Route('admin.save_settings')}}" accept-charset="UTF-8" class="form-horizontal form-charge" style="padding-left: 25%;padding-top: 30px;">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-md-3 control-label">Tên trang web:</label>
                                <div class="col-md-6">
                                    <input class="form-control c-square c-theme " name="name" type="text" required placeholder="Tên của trang web" value="{{$data['0']}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tiêu đề trang web:</label>
                                <div class="col-md-6">
                                    <input class="form-control c-square c-theme " name="title" type="text" required placeholder="Tiêu đề của trang web" value="{{$data['1']}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Số điện thoại:</label>
                                <div class="col-md-6">
                                    <input class="form-control c-square c-theme " name="hotline" type="text" required placeholder="Số điện thoại liên hệ" value="{{$data['2']}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Email:</label>
                                <div class="col-md-6">
                                    <input class="form-control c-square c-theme " name="email" type="text" maxlength="32" required placeholder="Email liên hệ" value="{{$data['3']}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Facebook:</label>
                                <div class="col-md-6">
                                    <input class="form-control c-square c-theme " name="facebook" type="text" required placeholder="Link Page Facebook" value="{{$data['4']}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Youtube:</label>
                                <div class="col-md-6">
                                    <input class="form-control c-square c-theme " name="youtube" type="text" required placeholder="Link kênh Youtube" value="{{$data['5']}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Description:</label>
                                <div class="col-md-6">
                                    <textarea class="form-control c-square c-theme " rows="5" name="description" required placeholder="Cách nhau bởi dấu phẩy.l">{{$data['6']}}</textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Keywords:</label>
                                <div class="col-md-6">
                                    <textarea class="form-control c-square c-theme " name="keywords" required placeholder="Cách nhau bởi dấu phẩy">{{$data['7']}}</textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Giới thiệu:</label>
                                <div class="col-md-6">
                                    <textarea class="form-control c-square c-theme " name="introduce" required placeholder="Chuyên mua bán nick các game... an toàn. Tin cậy nhanh chóng. Giao dịch tự động 24/24" rows="8">{{$data['8']}}</textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Giới thiệu 2:</label>
                                <div class="col-md-6">
                                    <textarea class="form-control c-square c-theme " name="introduce2" required placeholder="Chúng tôi làm việc một cách chuyên nghiệp, uy tín, nhanh chóng và luôn đặt quyền lợi của bạn lên hàng đầu" rows="8">{{$data['9']}}</textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Thông báo:</label>
                                <div class="col-md-6">
                                    <textarea class="form-control c-square c-theme " name="topup" required placeholder="Để trống nếu không muốn nhảy thông báo" rows="8">{{$data['10']}}</textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Thông báo ở đua TOP:</label>
                                <div class="col-md-6">
                                    <textarea class="form-control c-square c-theme " name="top_news" required placeholder="" rows="8">{{$data['11']}}</textarea>

                                </div>
                            </div>

                            <div class="row form-group checkbox">
                                <label class="col-md-2 control-label">Bảo trì website:</label>
                                <div class="col-md-6">
                                    <input type="checkbox" data-toggle="toggle" <?php if ($data['12'] == 'on') {  echo 'checked'; } ?> >
                                    <textarea style="display: none;" name="maintenance" required>{{$data['12']}}</textarea>
                                </div>
                            </div>

                            <script>
                                $('input[type="checkbox"]').change(function(e) {
                                    if (this.checked) {
                                        $('textarea[name="maintenance"]').text('on')
                                    } else {
                                        $('textarea[name="maintenance"]').text('off')
                                    }
                                });
                            </script>

                            <!-- <label class="col-md-3 control-label">Bảo Trì Website:</label>
                            <label class="switch">
                                <input type="checkbox" value="" class="switch-label">
                                <span class="slider round"></span>
                            </label> -->


                            <div class="form-group c-margin-t-40">
                                <div class="col-md-offset-3 col-md-6">
                                    <button class="btn btn-success" type="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i class="fas fa-cog"></i> Lưu cài đặt</button>

                                    <script>
                                        $(".form-charge").submit(function() {
                                            $('.btn-submit').button('loading');
                                        });
                                    </script>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection