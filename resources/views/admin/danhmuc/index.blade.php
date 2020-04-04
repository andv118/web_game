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
                <h1 class="m-0 text-dark">Quản lý danh mục</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item active">Quản lý danh mục</li>
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
                        <h3 class="card-title"><i class="fa fa-list"></i> Danh sách danh mục (<span style="color: red;">{{number_format(count($data))}}</span>)</h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td style="text-align: center;"><b>STT</b></td>
                                    <td style="text-align: center;"><b>Tên danh mục</b></td>
                                    <td style="text-align: center;"><b>Tag</b></td>
                                    <td style="text-align: center;"><b>Trạng thái</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 0; ?>
                                @foreach($data as $v)
                                <tr>
                                    <td style="text-align: center;"><?php echo $stt += 1; ?></td>
                                    <td style="text-align: center;">{{$v->tendanhmuc}}</td>
                                    <td style="text-align: center;">{{$v->keyword}}</td>
                                    <td style="text-align: center;">
                                        @if($v->stt==1)
                                        <label class="switch">
                                            <input type="checkbox" value="{{$v->id}}" class="switch-label" checked>
                                            <span class="slider round"></span>
                                        </label>
                                        @else
                                        <label class="switch">
                                            <input type="checkbox" value="{{$v->id}}" class="switch-label">
                                            <span class="slider round"></span>
                                        </label>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{csrf_field()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->



<script type="text/javascript">
    $(document).ready(function() {
        $('.switch-label').click(function() {
            var id = $(this).val();
            var _token = $("input[name='_token']").val();

            $.ajax({
                url: "{{Route('admin.update_danhmuc')}}",
                type: "post",
                data: {
                    id: id,
                    _token: _token
                },
                success: function(result) {}
            });
        });
    });
</script>

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
@endsection