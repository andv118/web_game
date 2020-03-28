@extends('user.masterlayout.master')
@section('content')

<script>
	$(document).ready(function() {
		// Thay đổi hệ số khi đổi vũ trụ
		$('select[name="server"]').change(function() {
			var server = $(this).val();
			updateMoney();
		});

		// Tính toán số tiền phải trả
		var arrPrice = [
			"150000",
			"250000",
			"150000",
			"150000",
			"200000",
			"100000",
			"100000",
			"170000",
			"100000",
			"100000",
			"170000",
			"1000000"
		];
		$('input[type="checkbox"]').change(function() {
			updateMoney();
		});

		// update so vang nhan dc
		function updateMoney() {
			var unit = 'VNĐ';
			var totalPrice = 0;
			var itemselect = '';
			if ($('input[type="checkbox"]').length > 0) {
				$('input[type="checkbox"]:checked').each(function(i) {
					var valCheckbox = $(this).val();
					totalPrice += parseInt(arrPrice[valCheckbox]);
					if (itemselect == '') {
						itemselect += $(this).val();
					} else {
						itemselect += '|' + $(this).val();
					}
				})
			}
			console.log(totalPrice);
			totalPrice = Math.round(totalPrice);
			totalPrice = totalPrice.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
			// console.log(totalPrice);
			$('#txtPrice').html('Tổng: ' + totalPrice + ' ' + unit);
			$('input[name="vang"]').val(totalPrice);
			$('input[name="item"]').val(itemselect);
			$('#txtPrice').removeClass().addClass('bounceIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).removeClass();
			});
		}

		// chuyển acc từ modal vào form
		$('button[type="submit"]').click(function() {
			var acc = $('#modal_acc').val();
			var pass = $('#modal_pass').val();
			$('input[name="acc"]').val(acc);
			$('input[name="pass"]').val(pass);
		});

	});
</script>

<div class="c-layout-page">
	<div class="c-size-lg c-overflow-hide c-bg-white font-roboto">
		<!--BEGIN: Thong bao  -->
		<div class="container">
			@if(Session::has('errors'))
			<div class="alert alert-danger alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>
				{{ Session::get('errors') }}
			</div>
			@elseif(Session::has('success'))
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>
				{{ Session::get('success') }}
			</div>
			@endif
		</div>
		<!--END: Thong bao  -->
		<div class="text-center" style="margin-bottom: 50px;">
			<h2 style="font-size: 30px;font-weight: bold;text-transform: uppercase">DỊCH VỤ UP SỨC MẠNH SƯ PHỤ</h2>
			<div class="row  hidden-sm hidden-md hidden-lg">
				<p style="margin-top: 15px;font-size: 23px" class="bb"><i class="fa fa-server" aria-hidden="true"></i> <a href="#" style="color:#32c5d2">Ngọc rồng</a></p>
			</div>
		</div>

		<div class="container detail-service">
			<div class="col-md-7" style="margin-bottom:20px;">
				<div class="row-flex-safari service-info">

					<div class="col-md-5 hidden-xs hidden-sm">
						<div class="row">
							<div class="news_image">
								<img src="public/client/assets/images/S34iyncQia_1560576591.jpg" alt="Bán vàng">
							</div>
						</div>
						<div class="row">
							<p style="margin-top: 15px" class="bb"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Up sức mạnh sư phụ</p>
							<p style="margin-top: 15px" class="bb"><i class="fa fa-server" aria-hidden="true"></i> <a href="{{Route('dichvu.ngocrong.index')}}" style="color:#32c5d2">Dịch vụ ngọc rồng</a></p>
						</div>
					</div>

					<div class="col-md-7">
						<form id="thanhtoan_banvang" method="POST" action="{{Route('dichvu.ngocrong.su-phu-pay')}}" accept-charset="UTF-8" class="">
							{{ csrf_field() }}

							<input name="acc" value="" class="form-control" type="hidden" placeholder="account">
							<input name="pass" value="" class="form-control" type="hidden" placeholder="password">
							<input name="vang" value="" class="form-control" type="hidden" placeholder="vang">
							<input name="item" value="" class="form-control" type="hidden" placeholder="item">

							<span class="mb-15 control-label bb">Chọn máy chủ:</span>
							<div class="mb-15">
								<select name="server" class="server-filter form-control t14" style="">
									<option value="1">Vũ trụ 1</option>
									<option value="2">Vũ trụ 2 </option>
									<option value="3">Vũ trụ 3 </option>
									<option value="4">Vũ trụ 4 </option>
									<option value="5">Vũ trụ 5 </option>
									<option value="6">Vũ trụ 6 </option>
									<option value="7">Vũ trụ 7 </option>
									<option value="8">Vũ trụ 8 </option>
								</select>
							</div>

							<span class="mb-15 control-label bb">Chọn:</span>
							<div class="simple-checkbox s-filter">
								<p>
									<input value="0" type="checkbox" id="0">
									<label for="0">Combo1 sơ sinh - 200tr sm tự chuẩn bị ( 500n ) - 150,000 VNĐ</label>
								</p>
								<p>
									<input value="1" type="checkbox" id="1">
									<label for="1">Combo2 200tr sm - 10ty sm tự chuẩn bị ( 500n ) - 250,000 VNĐ</label>
								</p>
								<p>
									<input value="2" type="checkbox" id="2">
									<label for="2">Combo2*1 : 200tr sm - 5ty sm tự chuẩn bị ( 450n ) - 150,000 VNĐ</label>
								</p>
								<p>
									<input value="3" type="checkbox" id="3">
									<label for="3">Combo2*2 : 5ty sm - 10ty sm tự chuẩn bị ( 450n ) - 150,000 VNĐ</label>
								</p>
								<p>
									<input value="4" type="checkbox" id="4">
									<label for="4">Combo3 10 ty sm - 20 ty sm tự chuẩn bị(500 n) - 200,000 VNĐ</label>
								</p>
								<p>
									<input value="5" type="checkbox" id="5">
									<label for="5">Combo3 * 1: 10 ty sm - 15 ty sm tự chuẩn bị(450 n) - 100,000 VNĐ</label>
								</p>
								<p>
									<input value="6" type="checkbox" id="6">
									<label for="6">Combo3 * 2: 15 ty sm - 20 ty sm tự chuẩn bị(500 n) - 100,000 VNĐ</label>
								</p>
								<p>
									<input value="7" type="checkbox" id="7">
									<label for="7">Combo4 20 ty sm - 30 ty sm tự chuẩn bị(500 n) - 170,000 VNĐ</label>
								</p>
								<p>
									<input value="8" type="checkbox" id="8">
									<label for="8">Combo4 * 1: 30 ty sm - 35 ty sm tự chuẩn bị(500 n) - 100,000 VNĐ</label>
								</p>
								<p>
									<input value="9" type="checkbox" id="9">
									<label for="9">Combo4 * 2: 35 ty sm - 40 ty sm tự chuẩn bị(450 n) - 100,000 VNĐ</label>
								</p>
								<p>
									<input value="10" type="checkbox" id="10">
									<label for="10">Combo5 30 ty sm - 40 ty sm tự chuẩn bị(500 n) - 170,000 VNĐ</label>
								</p>
								<p>
									<input value="11" type="checkbox" id="11">
									<label for="11">Combo6 sơ sinh - 40 ty sm tự chuẩn bị(1200 n) - 1,000,000 VNĐ</label>
								</p>
							</div>

						</form>
					</div>
				</div>
			</div>

			<div class="col-md-5">
				<div class="row emply-btns">
					<div class="col-md-8 col-md-offset-2">
						<div class=" emply-btns text-center">
							<input type="hidden" name="selected" value="1000">
							<input type="hidden" name="server" value="0">
							<a id="txtPrice" style="font-size: 20px;font-weight: bold" class="">Tổng: <span id="money" class="price">0 </span> VNĐ</a>
							@if(Auth::check())
							<button data-toggle="modal" data-target="#pay_modal" type="button" style="font-size: 20px;" class="followus"><i class="fa fa-credit-card" aria-hidden="true"></i> Thanh toán</button>
							@else
							<a style="font-size: 20px;" class="followus" href="{{Route('login')}}" title=""><i class="fa fa-key" aria-hidden="true"></i> Đăng nhập để thanh toán</a>
							@endif
						</div>
					</div>
				</div>

				<div class="row emply-btns box-body" style="color: #505050;padding:20px;line-height: 2;margin-top: 30px">
					<p><span style="color:#e74c3c"><strong>Sau khi thanh toán vui lòng theo dõi quá trình</strong></span></p>
					<p>Đơn hàng sẽ bị huỷ nếu cung cấp sai thông tin</p>

					<p>Shop Nick<strong></strong>&nbsp;có nhận dịch vụ<strong>&nbsp;Úp Sức Mạnh Sư Phụ</strong></p>

					<p>Với Phương Châm :&nbsp;<strong>Uy Tín- Nhanh gọn -Giá cả phải chăng</strong>. Chắc chắn sẽ làm hài lòng bạn</p>

					<p><strong>Yêu cầu :&nbsp;</strong></p>

					<p>- Chuẩn bị đủ&nbsp;<strong>số ngọc trong acc</strong>&nbsp;( ngọc mua bùa , mở giới hạn sức mạnh , và 1 vài thứ cần thiết trong việc up )</p>

					<p>- Về việc chuẩn bị ngọc bạn có thể&nbsp;<strong>mua ngọc</strong>&nbsp;-&nbsp;<strong>mua vàng</strong>&nbsp;ở web <strong><span style="color:#000000"></span></strong>&nbsp;luôn ^^ giá bao đẹp</p>

					<p>-<strong>Để đảm bảo quá trình úp ra nhanh gọn hiệu quả yêu cầu bạn không được vào nick trong quá trình úp.</strong></p>

				</div>

			</div>
		</div>
	</div>
</div>

<!-- BEGIN: MODAL THANH TOÁN -->
@include('user.dichvu.ngocrong.modal_thanhtoan')
<!-- END: MODAL THANH TOÁN -->

@endsection