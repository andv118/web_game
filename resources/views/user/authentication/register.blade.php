@extends('user.masterlayout.master')

@section('content')

<!-- BEGIN: PAGE REGISTER CONTENT -->
	<div class="login-box">

		<!-- /.login-logo -->
		<div class="login-box-body box-custom">
			<p class="login-box-msg">Đăng ký thành viên</p>

			<span class="help-block" style="text-align: center;color: #dd4b39">
				<strong></strong>
			</span>

			<form action="{{Route('register_user')}}" method="POST">
				{{ csrf_field() }}
				@if(count($errors)>0)
				<div class="alert alert-danger" style="color:red;margin: 20px 0;text-align: center;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					@foreach($errors->all() as $err)
					{{$err}} <br>
					@endforeach
				</div>
				@endif
				
				@if(Session::has('thanhcong'))
				<div class="alert alert-success" style="color:red;margin: 20px 0;text-align: center;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				   {{Session::get('thanhcong')}}
			   </div>
				@endif
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="username" value="" placeholder="Tài khoản"  required="true">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>

				</div>

				<div class="form-group has-feedback">
					<input type="email" class="form-control" name="email" value="" placeholder="Email"  required="true">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
					<input type="number" class="form-control number" maxlength="11" name="phone" value="" placeholder="Số điện thoại"  required="true">
					<span class="glyphicon glyphicon-phone form-control-feedback"></span>
				</div>


				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="password" placeholder="Mật khẩu" required="true">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>

				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="password_confirmation" placeholder="Xác nhận mật khẩu" required="true">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>

				<div class="row">
					<!-- /.col -->
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat" style="margin: 0 auto;">Đăng ký</button>
					</div>
					<!-- /.col -->
				</div>

				<div class="social-auth-links text-center">
					<p style="margin-top: 5px">- HOẶC -</p>
					<a href="#" class="btn  btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Google+</a>
				</div>
			</form>

			<!-- /.social-auth-links -->
		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

    <style>
        .login-box, .register-box {
            width: 400px;
            margin: 7% auto;
            padding: 20px;;
        }

        @media (max-width: 767px){
            .login-box, .register-box {
                width: 100%;
            }

        }

        .login-box-msg, .register-box-msg {
            margin: 0;
            text-align: center;
            padding: 0 20px 20px 20px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        .box-custom{
            border: 1px solid #cccccc;
            padding: 20px;
            color: #666;
        }
    </style>
	<!-- END: PAGE REGISTER CONTENT -->

@endsection