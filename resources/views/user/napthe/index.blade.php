@extends('user.masterlayout.master')

@section('content')

<!-- BEGIN: PAGE CONTENT -->
<div class="m-t-20 visible-sm visible-xs"></div>

<div class="container">

	<!-- Thông báo -->
	<div class="flash-message">
		@if (session('status'))
		<div class="alert alert-{{ session('status') }} alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			{{ session('msg') }}
		</div>
		@endif
	</div>

	<div class="c-layout-sidebar-menu c-theme ">
		<div class="row">
			@include("user/leftmenu/index")
		</div>
	</div>

	<div class="c-layout-sidebar-content ">
		<!-- BEGIN: PAGE CONTENT -->
		<!-- BEGIN: CONTENT/SHOPS/SHOP-CUSTOMER-DASHBOARD-1 -->
		<div class="c-content-title-1">
			<h3 class="c-font-uppercase c-font-bold" style="text-align: center;">Nạp tiền vào tài khoản</h3>
			<div class="c-line-center"></div>
		</div>

		<form action="{{Route('xac_nhan_nap_the')}}" method="POST" accept-charset="UTF-8" class="form-horizontal form-charge">
			{{csrf_field()}}

			<div class="form-group">
				<label class="col-md-3 control-label">Tài khoản:</label>
				<div class="col-md-6">
					<input class="form-control  c-square c-theme" type="text" value="{{Auth::user()->name}}" readonly>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Loại thẻ:</label>
				<div class="col-md-6">
					<select class="form-control  c-square c-theme" name="telco" id="type" required>
						<option value="">Chọn loại thẻ</option>
						<option value="VIETTEL">Viettel</option>
						<option value="MOBIFONE">Mobifone</option>
						<option value="VINAPHONE">Vinaphone</option>
						<option value="GATE">Gate</option>
						<option value="ZING">Zing</option>
						<option value="SCOIN">Scoin</option>
						<option value="VCOIN">Vcoin</option>
						<option value="VIETNAMMOBILE">VIETNAMMOBILE</option>
						<option value="BIT">BIT</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Mệnh giá:</label>
				<div class="col-md-6">
					<select class="form-control  c-square c-theme" name="amount" id="amount" required>
						<option value="">Chọn mệnh giá, chọn sai mất thẻ</option>
						<option value="10000">10,000đ</option>
						<option value="20000">20,000đ</option>
						<option value="30000">30,000đ</option>
						<option value="50000">50,000đ</option>
						<option value="100000">100,000đ</option>
						<option value="200000">200,000đ</option>
						<option value="300000">300,000đ</option>
						<option value="500000">500,000đ</option>
						<option value="1000000">1,000,000đ</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Mã số thẻ:</label>
				<div class="col-md-6">
					<input class="form-control  c-square c-theme " name="code" type="text" maxlength="16" required placeholder="" required="" autofocus>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Số serial:</label>
				<div class="col-md-6">
					<input class="form-control c-square c-theme " name="serial" type="text" maxlength="16" required placeholder="" required="">
				</div>
			</div>

			<div class="form-group c-margin-t-40">
				<div class="col-md-offset-3 col-md-6">
					<button type="submit" class="btn btn-submit c-theme-btn c-btn-square c-btn-uppercase c-btn-bold btn-block" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">Nạp thẻ</button>
					<script>
						$(".form-charge").submit(function() {
							$('.btn-submit').button('loading');
						});
					</script>
				</div>
			</div>
		</form>

		<div class="" style="margin: 35px 0px;border: 1px solid #cccccc;padding: 15px">
			<p><span style="color:#e74c3c"><strong>Lưu ý</strong></span></p>

			<p>Nếu thẻ bị trễ, vui lòng chờ sau vài phút để nhận tiền</p>
			<p>Chọn sai mệnh giá sẽ mất thẻ và không được cộng tiền!</p>
		</div>
		<!-- END: PAGE CONTENT -->

		<!-- BEGIN: LOG NAP THE -->
		<div class="text-center" style="margin: 15px 0">
			<h2>Nạp thẻ gần đây</h2>
		</div>
		<table id="hand_card_recent" class="table table-striped table-custom-res">
			<tbody>
				<tr>
					<th>Thời gian</th>
					<th>Nhà mạng</th>
					<th>Mã thẻ</th>
					<th>Serial</th>
					<th>Mệnh giá</th>
					<th>Kết quả</th>
				</tr>
			</tbody>
			<tbody>
				@foreach($dataLog as $k=>$v)
				<tr>
					<td>{{$v->date}}</td>
					<td>{{$v->tel}}</td>
					<td>{{$v->pin}}</td>
					<td>{{$v->serial}}</td>
					<td>{{number_format($v->amount,0) . "đ"}}</td>
					<td>{{$v->desc}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
			{{ $dataLog->links() }}
		</div>
		<!-- END: LOG NAP THE -->
	</div>
</div>
<!-- END: PAGE CONTENT -->

@endsection