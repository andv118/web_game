<div class="row">
	<div class="col-md-12 col-sm-6 col-xs-6 m-t-15 m-b-20">
		<!-- BEGIN: LAYOUT/SIDEBARS/SHOP-SIDEBAR-DASHBOARD -->
		<div class="c-content-title-3 c-title-md c-theme-border">
			<h3 class="c-left c-font-uppercase">Menu tài khoản</h3>
			<div class="c-line c-dot c-dot-left "></div>
		</div>

		<div class="c-content-ver-nav">
			<ul class="c-menu c-arrow-dot c-square c-theme">
				<li><a href="{{Route('profile')}}" class="">Thông tin tài khoản</a></li>
				<li><a href="{{Route('giao-dich.lich-su.index')}}" class="">Lịch sử giao dịch</a></li>
			</ul>
		</div>
	</div>

	<div class="col-md-12 col-sm-6 col-xs-6 m-t-15">
		<div class="c-content-title-3 c-title-md c-theme-border">
			<h3 class="c-left c-font-uppercase">Menu giao dịch</h3>
			<div class="c-line c-dot c-dot-left "></div>
		</div>
		<div class="c-content-ver-nav m-b-20">
			<ul class="c-menu c-arrow-dot c-square c-theme">
				<li><a href="{{Route('nap_the')}}" class="">Nạp thẻ tự động</a></li>
				<li><a href="{{Route('giao-dich.the-cao.index')}}" class="">Thẻ cào đã nạp</a></li>
				<li><a href="" data-toggle="modal" data-target="#atm_modal">Nạp tiền từ ATM - Ví Điện Tử</a></li>
				<li><a href="{{Route('giao-dich.tai-khoan.index')}}" class="">Tài khoản đã mua</a></li>
				<li><a href="{{Route('giao-dich.dich-vu.index')}}" class="">Dịch vụ đã mua</a></li>
				<li><a href="{{Route('giao-dich.qua-tang.index')}}" class="">Lịch sử nhận quà</a></li>
			</ul>
		</div>
	</div>
</div>

