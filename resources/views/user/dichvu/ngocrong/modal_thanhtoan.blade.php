
<!-- BEGIN: MODAL THANH TOÁN -->
<div class="modal fade" id="pay_modal" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="loader" style="text-align: center"><img src="/assets/images/loader.gif" style="width: 50px;height: 50px;display: none"></div>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Xác nhận thông tin thanh toán</h4>
			</div>
			<div class="modal-body">

				<span class="mb-15 control-label bb">Tên đăng nhập:</span>

				<div class="mb-15">
					<input id="modal_acc" type="text" required="" class="form-control t14" placeholder="Tên đăng nhập trong game ngọc rồng" value="">
				</div>
				<span class="mb-15 control-label bb">Mật khẩu đăng nhập:</span>

				<div class="mb-15">
					<input id="modal_pass" type="password" required="" class="form-control t14" placeholder="******" value="">
				</div>

			</div>
			<div class="modal-footer">
				<button form="thanhtoan_banvang" type="submit" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold loading" id="d3" style="">Xác nhận thanh toán</button>
				<button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>
<!-- END: MODAL THANH TOÁN -->