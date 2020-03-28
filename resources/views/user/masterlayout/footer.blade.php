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
					<div class="c-container c-last">
						<div class="c-content-title-1">
							<h3 class="c-font-uppercase c-font-bold c-font-white"><strong style="font-size: 24px;">CHÚNG TÔI Ở ĐÂY</strong></h3>
							<div class="c-line-left hide"></div>
							<p style="color:#dddddd;font-size: 16px;">{!!$settings[9]!!}</p>
						</div>
						<ul class="c-address" style="margin-top: 35%;">
							<li><span class="c-font-regular"> 
								<p class="c-copyright c-font-grey">2019 © vận hành bởi <a style="color: #32c5d2 !important">Hano TV</a> <span class="c-font-grey-3"> </span>
								</p>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-md-4">
					<div class="c-container c-first">
						<div class="c-content-title-1">
							<h3 class="c-font-uppercase c-font-bold c-font-white">
								<strong style="font-size: 24px;font-family:Verdana,Geneva,sans-serif;">
									Về <span class="c-theme-font">{!!$settings[0]!!}</span>
								</strong>
							</h3>
							<div class="c-line-left hide"></div>
							<p class="c-text" style="color: #d8d8d8;"><b>{!!$settings[8]!!}</b></p>
						</div>
					</div>
				</div>

				<div class="col-md-4">
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
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
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