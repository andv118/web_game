<div class="modal-header">
  <h4 class="modal-title">Thêm tài khoản Random mới</h4>
</div>

<div class="modal-body">
  <form class="form-horizontal" action="/admin/random/add" method="POST">
    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <div class="input-group m-b-10 c-square ">
            <span class="input-group-addon" id="basic-addon1">Danh mục</span>
            <select class="form-control c-square c-theme" name="game" id="game" required>
              <option value="">Chọn danh mục</option>

            </select>
          </div>
        </div>                        
        <div class="col-md-6">
          <div class="input-group m-b-10 c-square ">
            <span class="input-group-addon" id="basic-addon1">Loại</span>
            <select class="form-control c-square c-theme" name="type" id="type" required>
              <option value="">Chọn loại</option>

            </select>
          </div>
        </div>                          

      </div>
      <hr/>
      <div class="row">
        <div class="col-md-12">
          <div class="input-group m-b-10 c-square ">
            <span class="input-group-addon" id="basic-addon1">Tài khoản</span>
            <textarea class="form-control c-square c-theme" name="list" value="" placeholder="Tài khoản|Mật khẩu|Mật khẩu cấp 2 (nếu có)" rows="6" required></textarea>
          </div>
        </div> 
      </div>
    </div>

    <button type="submit" class="btn btn-info"  id="d3" style="">Thêm mới</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>

  </div>
</form>
<div style="clear: both"></div>
</div>


<style type="text/css">
  .input-group-addon{
    border: 1px solid #d0d7de;;
    padding: 5px 5px;
    background-color: #FAFAFA;
  }
</style>