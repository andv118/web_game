<div class="modal fade" id="modal_update_user" aria-modal="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cập nhật người dùng <b id="user_name" style="color: red;"></b></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body">
				<form class="form-horizontal" id="update_user" action="{{Route('admin.change-users')}}" method="POST">
					{{csrf_field()}}

					<input type="hidden" name="user_id" value="">

					<div class="row form-group">
						<label class="col-md-3 control-label"><b>IP/Agent:</b></label>
						<div class="col-md-9">
							<input class="form-control c-square c-theme" type="text" name="user_agent" placeholder="" required="" value="" readonly>
						</div>
					</div>

					<div class="row form-group">
						<label class="col-md-3 control-label"><b>Giao dịch:</b></label>
						<div class="col-md-9">
							<select name="locked" class="form-control c-square c-theme">
								<option value="0">Cho phép</option>
								<option value="1">Chặn giao dịch</option>
							</select>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-md-3 control-label"><b>Email:</b></label>
						<div class="col-md-9">
							<input class="form-control c-square c-theme" type="email" name="email" placeholder="Email của tài khoản này" value="">
						</div>
					</div>

					<div class="row form-group">
						<label class="col-md-3 control-label"><b>SĐT:</b></label>
						<div class="col-md-9">
							<input class="form-control c-square c-theme" type="phone" name="phone" placeholder="SĐ của tài khoản này" value="">
						</div>
					</div>

					<div class="row form-group">
						<label class="col-md-3 control-label"><b>Số dư:</b></label>
						<div class="col-md-9">
							<input class="form-control c-square c-theme" type="number" name="cash" require="" placeholder="Số tài khoản" value="">
						</div>
					</div>

					<div class="row form-group">
						<label class="col-md-3 control-label"><b>Mật khẩu mới:</b></label>
						<div class="col-md-9">
							<input class="form-control c-square c-theme" type="password" name="password" placeholder="Nhập vào nếu muốn đổi mật khẩu" value="">
						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer justify-content-right">
				<button type="submit" form="update_user" class="btn btn-primary">Sửa</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>