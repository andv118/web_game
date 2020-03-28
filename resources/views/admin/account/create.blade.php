@extends('admin.master')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-user-plus"></i> Thêm mới tài khoản</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Quản lý người dùng</a></li>
              <li class="breadcrumb-item active">Thêm mới tài khoản</li>
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
           <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tạo tài khoản <i class="fa fa-users"></i></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{Route('admin.save-users')}}" method="post">
                 {{ csrf_field() }} 

                 @if(count($errors)>0)
                 <div class="alert alert-danger" style="color:#fff;margin: 20px 0;text-align: center;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  @foreach($errors->all() as $err)
                  {{$err}} <br>
                  @endforeach
                </div>
                @endif
                
                @if(Session::has('thanhcong'))
                <div class="alert alert-success" style="color:#fff;margin: 20px 0;text-align: center;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{Session::get('thanhcong')}}
                </div>
                @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="">Tên tài khoản(<span style="color: red;">*</span>)</label>
                    <input type="text" name="username" class="form-control"  placeholder="Nhập họ và tên">
                  </div>
                  <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input type="number" name="phone" class="form-control"  placeholder="Nhập số điện thoại">
                  </div>
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" id="" placeholder="Nhập email">
                  </div>
                  
                  <div class="form-group">
                    <label>Quyền hạn (<span style="color: red;">*</span>)</label>
                    <select class="custom-select" name="role" required>
                      <option value="">--Chọn quyền--</option>
                      <option value="1">Admin</option>
                      <option value="0">Thành viên</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Mật khẩu (<span style="color: red;">*</span>)</label>
                    <input type="password" name="password" class="form-control" id="myInput" placeholder="Nhập mật khẩu">
                  </div>  
                  <div class="form-group">
                    <label for="">Xác nhận mật khẩu (<span style="color: red;">*</span>)</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu">
                  </div> 
                   <div class="form-group">
                   <input type="checkbox" onclick="myFunction()">Show Password
                  </div> 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tạo mới</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script type="text/javascript">
      function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>

@endsection