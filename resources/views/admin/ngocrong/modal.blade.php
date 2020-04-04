<!-- BEGIN: ADD MODAL BOX -->
<div class="modal fade" id="edit_modal" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Thêm tài khoản Ngọc Rồng mới</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="add_ngocrong_123" action="{{ Route('admin.add_ngocrong') }}" class="form-horizontal" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Thông tin tài khoản:</b></span>
                                <input name="infor" class="form-control c-square c-theme" type="text" placeholder="Tài khoản|Mật khẩu" required="" value="">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Giá:</b></span>
                                <input class="form-control c-square c-theme" type="number" name="cost" placeholder="Nhập giá bán" required="" value="">
                            </div>
                        </div>

                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Đăng ký:</b></span>
                                <select class="form-control c-square c-theme" name="dangky" required>
                                    <option value="">Chọn loại đăng ký</option>
                                    <option value="1" selected >Ảo</option>
                                    <option value="2">Gmail Full</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Server:</b></span>
                                <select class="form-control" name="server" required>
                                    <option value="">Chọn loại Server</option>
                                    <option value="1">Vũ Trụ 1 sao</option>
                                    <option value="2">Vũ Trụ 2 sao</option>
                                    <option value="3">Vũ Trụ 3 sao</option>
                                    <option value="4">Vũ Trụ 4 sao</option>
                                    <option value="5">Vũ Trụ 5 sao</option>
                                    <option value="6">Vũ Trụ 6 sao</option>
                                    <option value="7">Vũ Trụ 7 sao</option>
                                    <option value="8">Vũ Trụ 8 sao</option>
                                    <option value="9">SV Nước Ngoài</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Hành tinh:</b></span>
                                <select class="form-control c-square c-theme" name="hanhtinh" required>
                                    <option value="">Chọn loại hành tinh</option>
                                    <option value="1">Xayda</option>
                                    <option value="2">Namec</option>
                                    <option value="3">Trái đất</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Sơ sinh có đệ:</b></span>
                                <select class="form-control c-square c-theme" name="detu" required>
                                    <option value="1">Có</option>
                                    <option value="2" selected>Không</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Bông tai:</b></span>
                                <select class="form-control c-square c-theme" name="bongtai" required>
                                    <option value="1" selected>Có</option>
                                    <option value="2">Không</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Ghi chú:</b></span>
                                <input class="form-control c-square c-theme" name="note" value="Nick Ngon Giá Rẻ" placeholder="Ghi chú cho tài khoản này" rows="6" required=""></input>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Loại:</b></span>
                                <select class="form-control c-square c-theme" name="active" required>
                                    <option value="0" selected>Chưa Kích hoạt</option>
                                    <option value="1">Đã Kích hoạt</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Ghim:</b></span>
                                <select class="form-control c-square c-theme" name="stick" required>
                                    <option value="0">Kông</option>
                                    <option value="1">Ghim lên</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <br>


                    <div id="image" class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Ảnh đại diện:</b></span>
                                <input name="thumb" type="file" class="form-control" accept="image/*" required="true">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Ảnh thông tin:</b></span>
                                <input type="file" class="form-control" name="imginfo[]" accept="image/*" multiple="" required="true"> </div>
                        </div>
                    </div>
                </form>

            </div>

            <div class="modal-footer justify-content-right">
                <button type="submit" class="btn btn-primary" form="add_ngocrong_123">Thêm mới</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- END: ADD MODAL BOX -->

<!-- BEGIN: UPDATE MODAL BOX -->
<div class="modal fade" id="modal_update_ngocrong" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Sửa tài khoản Ngọc Rồng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="change_ngocrong" action="{{ Route('admin.change_ngocrong') }}" class="form-horizontal" method="POST">
                    {{ csrf_field() }}

                    <input name="id" type="hidden" required="" value="">

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Thông tin tài khoản:</b></span>
                                <input name="infor" class="form-control c-square c-theme" type="text" placeholder="Tài khoản|Mật khẩu" required="" value="">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Giá:</b></span>
                                <input class="form-control c-square c-theme" type="number" name="cost" placeholder="Nhập giá bán" required="" value="">
                            </div>
                        </div>

                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Đăng ký:</b></span>
                                <select class="form-control c-square c-theme" name="dangky" required>
                                    <option value="">Chọn loại đăng ký</option>
                                    <option value="1">Ảo</option>
                                    <option value="2">Gmail Full</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Server:</b></span>
                                <select class="form-control" name="server" required>
                                    <option value="">Chọn loại Server</option>
                                    <option value="1">Vũ Trụ 1 sao</option>
                                    <option value="2">Vũ Trụ 2 sao</option>
                                    <option value="3">Vũ Trụ 3 sao</option>
                                    <option value="4">Vũ Trụ 4 sao</option>
                                    <option value="5">Vũ Trụ 5 sao</option>
                                    <option value="6">Vũ Trụ 6 sao</option>
                                    <option value="7">Vũ Trụ 7 sao</option>
                                    <option value="8">Vũ Trụ 8 sao</option>
                                    <option value="9">SV Nước Ngoài</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Hành tinh:</b></span>
                                <select class="form-control c-square c-theme" name="hanhtinh" required>
                                    <option value="">Chọn loại hành tinh</option>
                                    <option value="1">Xayda</option>
                                    <option value="2">Namec</option>
                                    <option value="3">Trái đất</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Sơ sinh có đệ:</b></span>
                                <select class="form-control c-square c-theme" name="detu" required>
                                    <option value="1">Có</option>
                                    <option value="2" selected>Không</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Bông tai:</b></span>
                                <select class="form-control c-square c-theme" name="bongtai" required>
                                    <option value="1" selected>Có</option>
                                    <option value="2">Không</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Ghi chú:</b></span>
                                <input class="form-control c-square c-theme" name="note" value="" placeholder="Ghi chú cho tài khoản này" rows="6" required=""></input>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Loại:</b></span>
                                <select class="form-control c-square c-theme" name="active" required>
                                    <option value="0">Chưa kích hoạt</option>
                                    <option value="1">Đã kích hoạt</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="input-group m-b-10 c-square">
                                <span class="input-group-addon"><b>Ghim:</b></span>
                                <select class="form-control c-square c-theme" name="stick" required>
                                    <option value="0">Kông</option>
                                    <option value="1">Ghim lên</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <div class="modal-footer justify-content-right">
                <button type="submit" class="btn btn-primary" form="change_ngocrong">Sửa</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- END: UPDATE MODAL BOX -->X