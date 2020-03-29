@extends('user.masterlayout.master')
@section('content')

<script>
	$(document).ready(function() {
		// Thay đổi hệ số khi đổi vũ trụ
		$('select[name="server"]').change(function() {
			var server = $(this).val();
			if (server == 8) {
				$('#txtDiscount').val(7);
			} else {
				$('#txtDiscount').val(7);
			}
			updateMoney();
		});

		// Tính toán số tiền phải trả
		$('input[name="price"]').bind("keyup change", function() {
			updateMoney();
		})

		// update so vang nhan dc
		function updateMoney() {
			var min = 50000;
			var max = 500000;

			var unit = 'Ngọc';

			var number = $('input[name="price"]').val();
			number = parseInt(number.replace(/,/g, ''));

			if (typeof number != 'number' || typeof number === 'undefined' || number < min || number > max || isNaN(number) || number == null) {
				$('#txtPrice').html('Tiền nhập không đúng');
				return;
			}

			var heSo = $('#txtDiscount').val();
			var money = number * heSo / 1000;
			money = Math.round(money);
			money = money.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
			// console.log(money);
			$('#txtPrice').html('Tổng: ' + money + ' ' + unit);
			$('#txtPrice').removeClass().addClass('bounceIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).removeClass();
			});
		}

		// chuyển acc từ modal vào form
		$('button[type="submit"]').click(function() {
			var acc = $('#modal_acc').val();
			var pass = $('#modal_pass').val();
			var vang = $('#money').val();
			$('input[name="acc"]').val(acc);
			$('input[name="pass"]').val(pass);
			$('input[name="vang"]').val(vang);
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
			<h2 style="font-size: 30px;font-weight: bold;text-transform: uppercase">DỊCH VỤ BÁN NGỌC TỰ ĐỘNG</h2>
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
								<img src="public/client/assets/images/danhmuc/banngoc.jpg" alt="Bán vàng">
							</div>
						</div>
						<div class="row">
							<p style="margin-top: 15px" class="bb"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Bán ngọc tự động</p>
							<p style="margin-top: 15px" class="bb"><i class="fa fa-server" aria-hidden="true"></i> <a href="{{Route('dichvu.ngocrong.index')}}" style="color:#32c5d2">Dịch vụ ngọc rồng</a></p>
						</div>
					</div>

					<div class="col-md-7">
						<form id="thanhtoan_banvang" method="POST" action="{{Route('dichvu.ngocrong.ban-ngoc-pay')}}" accept-charset="UTF-8" class="">
							{{ csrf_field() }}

							<input name="acc" value="" class="form-control" type="hidden" placeholder="account">
							<input name="pass" value="" class="form-control" type="hidden" placeholder="password">
							<input name="vang" value="" class="form-control" type="hidden" placeholder="vang">

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

							<span class="mb-15 control-label bb">Nhập số tiền cần mua:</span>
							<div class="mb-15">
								<input name="price" autofocus="" value="50000" class="form-control t14 price " id="input_pack" type="text" placeholder="Số tiền">
								<span style="font-size: 14px;">Số tiền thanh toán phải từ <b style="font-weight:bold;">50,000đ</b> đến <b style="font-weight:bold;">500,000đ</b> </span>
							</div>

							<span class="mb-15 control-label bb">Hệ số:</span>
							<div class="mb-15">
								<input type="text" id="txtDiscount" class="form-control t14" placeholder="" value="7" readonly="">
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
							<a id="txtPrice" style="font-size: 20px;font-weight: bold" class="">Tổng: <span id="money" class="price">350 </span> Ngọc</a>
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
				</div>
			</div>
		</div>
	</div>
</div>

<!-- BEGIN: MODAL THANH TOÁN -->
@include('user.dichvu.ngocrong.modal_thanhtoan')
<!-- END: MODAL THANH TOÁN -->

@endsection