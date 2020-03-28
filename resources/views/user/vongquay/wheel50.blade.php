@extends('user.masterlayout.master')

@section('content')

<!-- BEGIN: PAGE CONTENT -->
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet' type='text/css'>
<link href="public/client/assets/home/vong-quay/style.css" rel="stylesheet" type="text/css" />

<div class="c-layout-page">
	<div class="c-content-box c-size-lg c-overflow-hide c-bg-white font-roboto">
		
		<div class="container">
			@if(Session::has('err'))
				
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>{{Session::get('err')}}</strong>
				</div>

			@elseif(Session::has('success'))

				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>{{Session::get('success')}}</strong>
				</div>

			@endif
		</div>
		<div class="c-content-title-1 pd50">
			<h3 class="c-center c-font-uppercase c-font-bold">Vòng Quay Vàng 50k </h3>
			<div class="c-line-center c-theme-bg"></div>
			<input type="hidden" name="_token" value="{{csrf_token()}}">
		</div>

		<div class="col-lg-6 col-md-12" style="float: initial;margin: 0 auto">

            <div class="btn-top">
            	<a class="thele btn btn-success m-btn m-btn--custom m-btn--icon m-btn--pill">
            		<span>
            			<i class="la la-cloud-upload"></i>
            			<span>Thể Lệ</span>
            		</span>
            	</a>
            	<a  class="uytin btn btn-success m-btn m-btn--custom m-btn--icon m-btn--pill">
            		<span>
            			<i class="la la-cloud-upload"></i>
            			<span>Uy Tín</span>
            		</span>
            	</a>
            	<a href="{{Route('giao-dich.qua-tang.index')}}" target="_blank" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--pill">
            		<span>
            			<i class="la la-cloud-upload"></i>
            			<span>Nick đã trúng</span>
            		</span>
            	</a>
            </div>

            <div class="c-content-box c-size-md c-bg-white">
            	<!-- <div class="container"> -->
            		<div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">

            			<div class="row row-flex-safari game-list" style="display: flex; flex-wrap: wrap">
            				    <div class="item item-left">
	            					<section class="rotation">
	            						<div class="play-spin">
	            							<a class="ani-zoom"  id="start-played1"><img src="public/client/assets/home/vong-quay/image/IMG_3478.png" alt="Play Center"></a>
	            							<img style="width: 80%;max-width: 80%;opacity: 1;" src="public/client/assets/home/vong-quay/image/quayvang20.jpg" alt="Play" id="rotate-play">  
	            						</div>
	            						<div class="text-center">           
	            							<h3 class="num-play"><?php if(Auth::check()) :?>Bạn còn <span>{{Auth::user()->point_50}}</span> lượt quay.<?php endif; ?></h3>
	            							<li>
	            								<?php if(Auth::check()) :?>
	            									<?php if(Auth::user()->cash >= 50000) : ?>
	            										<a style="#" class="buy ani-zoom btn-img deposit-btn disabled" style="width:60%">
	            											<img src="public/client/assets/home/vong-quay/image/mualuot.png" alt="">
	            										</a>

	            										<?php else: ?>
	            											<a style="" class="ani-zoom btn-img deposit-btn disabled" href="/nap-the" style="width:60%">
	            												<img src="public/client/assets/home/vong-quay/image/mualuot.png" alt="">
	            											</a>                                
	            										<?php endif; ?>
	            									<?php endif; ?>
	            								</li>
	            							</div>
	            					</section>    
        					    </div>
            				</div>
            				<div class="table-body scrollbar-inner">
            					<table class="table table-bordered">
            						<tbody></tbody>
            					</table>
            				</div>
            			</div>
            			<!-- </div> -->
            		</div>
            	</div>

            	<div class="modal fade" id="modalBuy" role="dialog" aria-hidden="true">
            		<div class="modal-dialog" role="document">
            			<div class="modal-content">
            				<form method="POST" action="{{Route('buy_vong_quay_50k')}}" accept-charset="UTF-8" class="form-horizontal" id="mua">
            					{{csrf_field()}}
            					<div class="modal-header">
            						<h5 class="modal-title" id="exampleModalLabel">Bạn muốn mua thêm lượt quay?</h5>
            					</div>
            					<div class="modal-body">
            						Một lượt quay có giá 50k, vui lòng bấm vào nút xác nhận để hoàn tất thanh toán
            					</div>
            					<div class="modal-footer">
            						<input type="hidden" name="id" class="id" value=""/>
            						<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
            						<button type="submit" class="btn btn-danger m-btn m-btn--custom">Xác nhận</button>
            					</div>
            				</form>
            			</div>
            		</div>
            	</div>

            	<div class="modal fade" id="theleModal" role="dialog" aria-hidden="true">
            		<div class="modal-dialog" role="document">
            			<div class="modal-content">
            				<div class="modal-header">
            					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            						<span aria-hidden="true">×</span>
            					</button>
            					<h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Thể Lệ</h4>
            				</div>

            				<div class="modal-body" style="font-family: helvetica, arial, sans-serif;">
            					<p>&nbsp;<strong><span style="font-size:18px"><span style="color:#000000">Giá 1 Lần Quay 50k - Khi có đủ 50K anh em chỉ&nbsp;cần nhấp&nbsp;QUAY là sẽ&nbsp;QUAY!&nbsp;<br>
            					Quay Trúng vàng&nbsp;ae vô</span>&nbsp;</span><span style="font-size:22px"><a href="https://shophano.com/user/withdrawservice/237694"><span style="color:#8e44ad">Đây</span></a></span><span style="font-size:18px">&nbsp;<span style="color:#000000">để nhận vàng.</span></span></strong></p>

            					<p><strong><span style="font-size:18px"><span style="color:#2ecc71">ĐẶC BIỆT</span><span style="color:#000000">: KHÔNG CÓ TỈ LỆ QUAY TRƯỢT.</span></span></strong></p>

            					<p><span style="color:#000000"><strong><span style="font-size:18px">Chúc anh em quay trúng được nhiều vàng&nbsp;nhé!</span></strong></span>&nbsp;</p>
            				</div>
            				<div class="modal-footer">
            					<button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
            				</div>
            			</div>
            		</div>
            	</div>

            	<div class="modal fade" id="uytinModal" role="dialog" aria-hidden="true">
            		<div class="modal-dialog" role="document">
            			<div class="modal-content">
            				<div class="modal-header">
            					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            						<span aria-hidden="true">×</span>
            					</button>
            					<h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Uy Tín</h4>
            				</div>

            				<div class="modal-body" style="font-family: helvetica, arial, sans-serif;">
            					<h1><strong><span style="color:#000000">Vận Hành Bởi&nbsp;</span><a href="https://www.youtube.com/channel/UCSmmfIgYf-ynZzjDKsLjaaw"><span style="color:#000000">HANOTV</span></a><span style="color:#000000">- Được Quảng Cáo từ các youtuber nỗi tiếng!</span></strong></h1>
            				</div>
            				<div class="modal-footer">
            					<button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
            				</div>
            			</div>
            		</div>
            	</div>

            	<div class="modal fade" id="noticeModal" role="dialog" aria-hidden="true">
            		<div class="modal-dialog" role="document">
            			<div class="modal-content">
            				<div class="modal-header">
            					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            						<span aria-hidden="true">×</span>
            					</button>
            					<h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Thông báo</h4>
            				</div>

            				<div class="modal-body content-popup" style="font-family: helvetica, arial, sans-serif;">
            					Vòng quay may mắn
            				</div>
            				<div class="modal-footer">
            					<button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
            				</div>
            			</div>
            		</div>
            	</div>

	
            </div>
        </div>
	</div>
</div>

<!-- END PAGE CONTENT -->

<!-- style layout -->
<style type="text/css">
	#start-played1{
		cursor: pointer;
	}
	.c-content-client-logos-slider-1 .item{
		width: 85%;
		margin: auto;
	}

	@media (min-width: 992px){
		.c-layout-header-fixed.c-layout-header-topbar .c-layout-page {
			margin-top: 80px!important;
		}

	}
</style>

<!-- script vòng quay -->

<script type="text/javascript">

	$(document).ready(function(){
		$(".buy").on("click", function(){
			$("#modalBuy").modal('show');
		})
		$(".thele").on("click", function(){
			$("#theleModal").modal('show');
		})
		$(".uytin").on("click", function(){
			$("#uytinModal").modal('show');
		})
	});
</script>

<script type="text/javascript">
	$(document).ready(function(e){

		var roll_check = true;
		var num_loop = 4;
		var angle_gift = '';
		var num_gift = 8;
		var gift_detail = '';
		var num_roll_remain = 0;
		var angles = 0;

	    //Click nút quay
	    $('body').delegate('#start-played1', 'click', function(){
	    	if(roll_check){
	    		roll_check = false;
	    	    var _token = $('input[name="_token"]').val();
	    		$.ajax({
	    			url: "{{Route('load_vong_quay_50k')}}",
	    			datatype:'json',
	    			data:{
	    				_token: _token
	    			},
	    			type: 'post',
	    			success: function (result) {

	    				var data = JSON.parse(result);

	    				if(data.status=='ERROR'){
	    					roll_check = true;
	    					$('#rotate-play').css({"transform": "rotate(0deg)"});
	    					$('.content-popup').text(data.msg);
	    					$('#noticeModal').modal('show');
	    					return;
	    				}
	    				if(data.status=='LOGIN'){
	    					location.href = "{{Route('login_user')}}";
	    					return;
	    				}

	    				gift_detail = data.msg;
	    				num_roll_remain = gift_detail.num_roll_remain;
	    				$('#rotate-play').css({"transform": "rotate(0deg)"});
	    				angles = 0;
	    				angle_gift = gift_detail.pos*(360/num_gift);
	    				loop();
	    			},
	    			error: function(){
	    				$('.content-popup').text('Có lỗi xảy ra. Vui lòng thử lại!');
	    				$('#noticeModal').modal('show');
	    			}
	    		})
	    	}
	    });

	    function loop() {
	    	$('#rotate-play').css({"transform": "rotate("+angles+"deg)"});

	    	if((parseInt(angles)-10)<=-(((num_loop*360)+angle_gift))){
	    		angles = parseInt(angles) - 2;
	    	}else{
	    		angles = parseInt(angles) - 10;
	    	}

	    	if(angles >= -((num_loop*360)+angle_gift)){
	    		requestAnimationFrame(loop);
	    	}else{
	    		roll_check = true;
	    		$('.content-popup').text('Kết quả: '+gift_detail.name);
	    		$('#noticeModal').modal('show');
	    		$('.num-play span').text(num_roll_remain);
	    		if(num_roll_remain==0){
	    			$('.deposit-btn').show();
	    		}else{
	    			$('.deposit-btn').hide();
	    		}
	    	}
	    }
   
    });
</script>

<style>
	.h3, h3 {
		font-size: 24px;
	}
	.h1, .h2, .h3, h1, h2, h3 {
		margin-top: 20px;
		margin-bottom: 10px;
	}
	.ui-autocomplete {
		max-height: 500px;
		overflow-y: auto;
		overflow-x: hidden;
	}

	.input-group-addon {
		background-color: #FAFAFA;
	}

	.input-group .input-group-btn > .btn, .input-group .input-group-addon {
		background-color: #FAFAFA;
	}

	.modal {
		text-align: center;
	}

	@media    screen and (min-width: 768px) {
		.modal:before {
			display: inline-block;
			vertical-align: middle;
			content: " ";
			height: 100%;
		}
	}

	@media (min-width: 992px) and (max-width: 1200px) {
		.c-layout-header-fixed.c-layout-header-topbar .c-layout-page {
			margin-top: 245px;
		}
	}

	@media screen and (max-width: 767px) {
		.modal-dialog:before {
			margin-top: 75px;
			display: inline-block;
			vertical-align: middle;
			content: " ";
			height: 100%;
		}

		.modal-dialog {
			width: 100%;

		}

		.modal-content {
			margin-right: 20px;
		}
	}

	.modal-dialog {
		display: inline-block;
		text-align: left;

	}

	.mfp-wrap {
		z-index: 20000 !important;
	}

	.c-content-overlay .c-overlay-wrapper {
		z-index: 6;
	}

	.z7 {
		z-index: 7 !important;
	}

	.nickdaquay{position:fixed;
		z-index:9999;
		bottom:170px;
		right:0px;
		max-width: 15%;
		min-width: 120px;
		min-height: 120px;}
	.anhbymanh{position:fixed;
		z-index:9999;
		bottom:80px;
		left:0px;
		max-width: 29%;
		min-height: 20px;}
		.napthebymanh{position:fixed;
			z-index:9999;
			bottom:100px;
			right:0px;
			max-width: 15%;
			min-height: 40px;
			min-width: 100px;
		}
		.flex-list .item {
			width: 50%;
			padding: 0 30px;
		}
		.rotation {
			text-align: center;
		}
		section {
			padding: 30px 0;
		}
		.rotation .play-spin {
			width: 100%;
			position: relative;
			margin: 0 auto;
		}
		.rotation .play-spin .ani-zoom {
			position: absolute;
			display: block;
			width: 110px;
			z-index: 5;
			top: calc(50% - 70px);
			left: calc(50% - 55px);
		}
		.ani-zoom {
			-webkit-transition: all .2s linear;
			-moz-transition: all .2s linear;
			-ms-transition: all .2s linear;
			-o-transition: all .2s linear;
			transition: all .2s linear;
		}
		img {
			max-width: 100%;
		}
		img {
			vertical-align: middle;
		}
		img {
			border: 0;
		}
		.text-center {
			text-align: center;
		}
		li{
			list-style: none;
		}

		.form-notication-bottom {
			position: fixed;
			bottom: 20px;
			left: 10px;
			width: 330px;
			height: auto;
			background-color: #fff;
			border-radius: 40px;
			z-index: 1;
			box-shadow: 2px 2px 10px 2px hsla(0,0%,60%,.2);
			animation: example 8s infinite;
			max-width: calc(90% - 10px);
			overflow: hidden;
		}


		@keyframes  example{0%{bottom: -100px;}25%{bottom: 20px;} 50%{bottom: 20px;}100%{bottom: -100px;}}

		li {
			list-style-type: none
		}
		.history {
			width: 40% !important;
		}
		@media  only screen and (max-width: 800px) {
			.c-content-client-logos-slider-1 .item {
				width: 90%;
			}

			#rotate-play {
				width: 100% !important;
				max-width: 100% !important;
			}
			.rotation .play-spin .ani-zoom img {
				width: 85% !important;
			}
			.history {
				width: 100% !important;
			}
		}
		.c-content-box.c-size-md{
			padding: 0
		}
		.pd50{
			padding-top: 50px;
		}
		.list-roll{
			margin-top: 30px;
			margin-bottom: 30px;
		}

		@media  screen and (min-width: 800px) {
			.list-roll-inner{
				width: 85%;
				margin-top: 30px;
				max-height: 400px;
				overflow-y: scroll;
				margin:0 auto;
			}
		}

		@media  screen and (min-width: 1600px) {
			.list-roll-inner{
				width: 85%;
				margin-top: 30px;
				max-height: 600px;
				overflow-y: scroll;
				margin:0 auto;
			}
		}
		.btn-top{
			display: flex;
			justify-content: center;
			margin-bottom: 30px
		}
		.btn-top .btn{
			margin-left: 15px;
			margin-right: 15px;
			padding: 6px 20px;
		}
		.btn-top span{
			font-size: 25px;
		}
		@media  screen and (max-width: 640px) {
			.btn-top span{
				font-size: 17px;
			}
		}

</style>




@endsection