@extends('user.masterlayout.master')

@section('content')

<!-- BEGIN: PAGE CONTENT -->
<div class="c-layout-page">
	<!-- BEGIN: PAGE CONTENT -->
	<div class="m-t-20 visible-sm visible-xs"></div>


	<div class="container c-size-md ">
		<div class="col-md-12">
			<div class="text-center">
				<center>
					<h2 class="c-font-bold c-font-28">ID: {{Auth::user()->id}}</h2>
					<h2 class="c-font-bold c-font-28">{{Auth::user()->name}}</h2>
					<h2 class="c-font-22">@if(Auth::user()->is_admin==1) Admin @else Thành viên @endif</h2>
					<h2 class="c-font-22 c-font-red">{{Auth::user()->cash}} đ</h2>
				</center>

			</div>

		</div>
	</div>
	<div class="c-layout-page" style="margin-top: 20px;">
		<div class="container">
			<div class="c-layout-sidebar-menu c-theme ">
				@include("user/leftmenu/index")
			</div>				
			<div class="c-layout-sidebar-content ">
				<!-- BEGIN: PAGE CONTENT -->
				<!-- BEGIN: CONTENT/SHOPS/SHOP-CUSTOMER-DASHBOARD-1 -->
				<div class="c-content-title-1">
					<h3 class="c-font-uppercase c-font-bold"><i class="fa fa-user"></i> Thông tin tài khoản</h3>
					<div class="c-line-left"></div>
				</div>
				<table class="table table-striped">
					<tbody>
						<tr>
							<th scope="row">ID của bạn:</th>
							<th><span class="c-font-uppercase">{{Auth::user()->id}}</span></th>
						</tr>
						<tr>
							<th scope="row">Tên tài khoản:</th>
							<th>{{Auth::user()->name}}</th>
						</tr>
						<tr>
							<th scope="row">Số dư tài khoản:</th>
							<td><b class="text-danger">{{Auth::user()->cash}} đ</b></td>
						</tr>
						<tr>
							<th scope="row">Địa chỉ Email:</th>
							<td>{{Auth::user()->email}}</td>
						</tr>
						<tr>
							<th scope="row">SĐT:</th>
							<td>{{Auth::user()->user_phone}}</td>
						</tr>
						<tr>
							<th scope="row">Nhóm tài khoản: </th>
							<td>@if(Auth::user()->is_admin==1) Admin @else Thành viên @endif</td>
						</tr>

					</tbody>
				</table>

            <!-- END: PAGE CONTENT -->
        </div>
    </div>
</div>


@endsection