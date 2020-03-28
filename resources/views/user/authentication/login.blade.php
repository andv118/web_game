@extends('user.masterlayout.master')

@section('content')

<!-- BEGIN: PAGE LOGIN CONTENT -->
<div class="login-box">

	<!-- /.login-logo -->
	<div class="login-box-body box-custom">
		<p class="login-box-msg">Đăng nhập hệ thống</p>
		<span class="help-block" style="text-align: center;color: #dd4b39">
			<strong></strong>
		</span>

		<form action="{{Route('login_user')}}" method="POST">
			{{ csrf_field() }}
			@if(count($errors)>0)
			<div class="alert alert-danger" style="color:red;margin: 20px 0;text-align: center;">
				@foreach($errors->all() as $err)
				{{$err}} <br>
				@endforeach
			</div>
			@endif
			@if(Session::has('flag'))
			<div class="alert alert-{{Session::get('flag')}}" style="color:red;margin: 20px 0;text-align: center;">{{Session::get('message')}}</div>
			@endif
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="username" value="" placeholder="Tài khoản của bạn" required>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>

			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-6">
	                <div class="checkbox icheck">
	                    <label style="color: #666">
	                        <input type="checkbox" name="remember" id="remember" > Ghi nhớ
	                    </label>
	                </div>
                </div>
            </div>
            <div class="row">
            	<!-- /.col -->
            	<div class="col-xs-12">
            		<button type="submit" class="btn btn-primary btn-block btn-flat" style="margin: 0 auto;">Đăng nhập</button>
            	</div>
            	<!-- /.col -->
            </div>
        </form>

        <div class="social-auth-links text-center">
        	<p style="margin-top: 5px">- HOẶC -</p>
        	<a href="/loginfb"class="btn  btn-social btn-facebook btn-flat d-inline-block"><i class="fa fa-facebook"></i>Sử dụng FB</a>                   
        	<a href="{{Route('register')}}" class="btn  btn-social btn-google btn-flat"><i class="icon-key icons"></i>Tạo tài khoản</a>
        </div>
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
		font-size: 20px;;
		font-weight: bold;
	}

	.box-custom{
		border: 1px solid #cccccc;
		padding: 20px;

		color: #666;
    }
</style>
<!-- END: PAGE LOGIN CONTENT -->


@endsection