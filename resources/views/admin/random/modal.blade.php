 <!-- BEGIN: ADD MODAL BOX -->
 <div class="modal fade" id="edit_modal_random" aria-modal="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="exampleModalLabel">Thêm tài khoản Random mới</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>

             <div class="modal-body">
                 <form id="add_random" action="{{ Route('admin.create_random') }}" class="form-horizontal" method="POST">
                     {{ csrf_field() }}

                     <div class="row">
                         <div class="col-lg-6 col-md-12 col-sm-12">
                             <div class="input-group m-b-10 c-square">
                                 <span class="input-group-addon"><b>Danh mục:</b></span>
                                 <select id="select_type" class="form-control c-square c-theme" name="type" required>
                                     <option value="">--Tất cả--</option>
                                     <option value="0">Random Ngọc Rồng</option>
                                     <option value="1">Random PUBG</option>
                                     <option value="2">Random Liên Quân</option>
                                     <option value="3">Random Free Fire</option>
                                     <option value="4">Random Liên Minh</option>
                                     <option value="5">Random Mở Rương</option>
                                 </select>
                             </div>
                         </div>

                         <div class="col-lg-6 col-md-12 col-sm-12">
                             <div class="input-group m-b-10 c-square">
                                 <span class="input-group-addon"><b>Loại:</b></span>
                                 <select id="select_category" class="form-control" name="category" required>
                                     <option value="">Chọn loại:</option>
                                 </select>
                             </div>
                         </div>
                     </div>

                     <br>

                     <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                             <div class="input-group m-b-10 c-square">
                                 <span class="input-group-addon"><b>Tài khoản:</b></span>
                                 <textarea class="form-control c-square c-theme" name="infor" value="" placeholder="Tài khoản|Mật khẩu|Mật khẩu cấp 2 (nếu có)" rows="6" required=""></textarea>
                             </div>
                         </div>
                     </div>
                 </form>

             </div>

             <div class="modal-footer justify-content-right">
                 <button type="submit" class="btn btn-primary" form="add_random">Thêm mới</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng </button>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>
 <!-- END: ADD MODAL BOX -->

 <!-- BEGIN: UPDATE MODAL BOX -->
 <div class="modal fade" id="update_modal_random" aria-modal="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="exampleModalLabel">Sửa tài khoản Random # <span id="update_random_id_abc"></span> </h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>

             <div class="modal-body">
             <form id="update_random_ok" action="{{ Route('admin.update_random') }}" class="form-horizontal" method="POST">
                     {{ csrf_field() }}

                     <input name="id" value="" type="hidden" required=""></input>

                     <div class="row">
                         <div class="col-lg-6 col-md-12 col-sm-12">
                             <div class="input-group m-b-10 c-square">
                                 <span class="input-group-addon"><b>Danh mục:</b></span>
                                 <select id="select_type_update" class="form-control c-square c-theme" name="type" required>
                                     <option value="">--Tất cả--</option>
                                     <option value="0">Random Ngọc Rồng</option>
                                     <option value="1">Random PUBG</option>
                                     <option value="2">Random Liên Quân</option>
                                     <option value="3">Random Free Fire</option>
                                     <option value="4">Random Liên Minh</option>
                                     <option value="5">Random Mở Rương</option>
                                 </select>
                             </div>
                         </div>

                         <div class="col-lg-6 col-md-12 col-sm-12">
                             <div class="input-group m-b-10 c-square">
                                 <span class="input-group-addon"><b>Loại:</b></span>
                                 <select id="select_category_update" class="form-control" name="category" required>
                                     <option value="">Chọn loại:</option>
                                 </select>
                             </div>
                         </div>
                     </div>

                     <br>

                     <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                             <div class="input-group m-b-10 c-square">
                                 <span class="input-group-addon"><b>Tài khoản:</b></span>
                                 <input class="form-control c-square c-theme" name="infor" value="" placeholder="Tài khoản|Mật khẩu|Mật khẩu cấp 2 (nếu có)" rows="6" required=""></input>
                             </div>
                         </div>
                     </div>
                 </form>

             </div>

             <div class="modal-footer justify-content-right">
                 <button type="submit" class="btn btn-primary" form="update_random_ok">Sửa</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng </button>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>
 <!-- END: UPDATE MODAL BOX -->