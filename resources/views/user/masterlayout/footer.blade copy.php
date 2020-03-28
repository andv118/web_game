@if(!empty($settings[10]))

<div class="modal fade" id="noticeModal" role="dialog" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Thông báo</h4>
			</div>

			<div class="modal-body" style="font-family: helvetica, arial, sans-serif;">
				{!!$settings[10]!!}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		if ($.cookie('noticeModal') != '1') {

			$('#noticeModal').modal('show')
			//show popup here

			var date = new Date();
			var minutes = 60 * 12;
			date.setTime(date.getTime() + (minutes * 60 * 1000));
			$.cookie('noticeModal', '1', {
				expires: date
			});
		}
	});
</script>
@endif


<div class="modal fade" id="LoadModal" role="dialog" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="loader" style="text-align: center"><img src="public/client/assets/images/loader.gif" style="width: 50px;height: 50px;display: none"></div>
		<div class="modal-content">
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.load-modal').each(function(index, elem) {
			$(elem).unbind().click(function(e) {
				e.preventDefault();
				e.preventDefault();
				var curModal = $('#LoadModal');
				curModal.find('.modal-content').html("<div class=\"loader\" style=\"text-align: center\"><img src=\"public/client/assets/images/loader.gif\" style=\"width: 50px;height: 50px;\"></div>");
				curModal.modal('show').find('.modal-content').load($(elem).attr('rel'));
			});
		});

	});
</script>


<footer class="c-layout-footer c-layout-footer-3 c-bg-dark">
	<div class="c-prefooter">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="c-container c-first">
						<div class="c-content-title-1">
							<h3 class="c-font-uppercase c-font-bold c-font-white">Về <span class="c-theme-font">{{$settings[0]}}</span>
							</h3>
							<div class="c-line-left hide"></div>
							<p class="c-text" style="color: #d8d8d8;"><b>{{$settings[8]}}</b></p>
						</div>
						<ul class="c-links">
							<li><a href="#" style="color: #d8d8d8;text-transform: uppercase;font-weight: 10;">Giới thiệu</a></li>
							<li><a href="#" style="color: #d8d8d8;text-transform: uppercase;font-weight: 10;">Hướng dẫn mua nick</a></li>
							<li><a href="#" style="color: #d8d8d8;text-transform: uppercase;font-weight: 10;">Hướng dẫn mua nick trả góp</a></li>
							<li><a href="#" style="color: #d8d8d8;text-transform: uppercase;font-weight: 10;"> Liên hệ/góp ý</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="c-container c-last">
						<div class="c-content-title-1">
							<h3 class="c-font-uppercase c-font-bold c-font-white">Chi tiết liên hệ</h3>
							<div class="c-line-left hide"></div>
							<p>{{$settings[9]}}</p>
						</div>
						<ul class="c-socials">
							<li><a href="{{$settings[4]}}" target="_blank"><i class="icon-social-facebook"></i></a></li>
							<li><a href="{{$settings[5]}}" target="_blank"><i class="icon-social-youtube"></i></a></li>
						</ul>
						<ul class="c-address">
							<!--<li><i class="icon-pointer c-theme-font"></i> One Boulevard, Beverly Hills</li>-->
							<li><i class="icon-call-end c-theme-font"></i>
								<a href="tel:<?php echo str_replace(".", "", $settings[2]); ?>" class="c-font-regular"><?php echo $settings[2]; ?> Hotline: 0396 498 015 (8h-22h)</a>
							</li>
							<li><i class="icon-clock c-theme-font"></i><span class="c-font-regular"> 7h30 - 22h30 (hàng ngày)</span></li>
							<li><span class="c-font-regular">
									2020 © SHOPHANO.COM </span></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="c-container c-first">
						<div class="c-content-title-1">
							<h3 class="c-font-uppercase c-font-bold c-font-white">Fanpage</span>
							</h3>
						</div>
						<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FShophano-310014816372012%2F&tabs=timeline&width=340&height=250&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=504532413830741" width="340" height="250" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
					</div>
				</div>


				

			</div>
		</div>
	</div>
	</div>
</footer><!-- END: LAYOUT/FOOTERS/FOOTER-5 -->

<div class="c-layout-go2top">
	<i class="icon-arrow-up"></i>
</div>

<!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v6.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your customer chat code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="114881616820155"
  logged_in_greeting="Hi ! Bạn Cần Hỗ Trợ Gì ?"
  logged_out_greeting="Hi ! Bạn Cần Hỗ Trợ Gì ?">
      </div>


@include('user.atm_modal.index')