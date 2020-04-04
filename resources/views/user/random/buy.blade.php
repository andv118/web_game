<!-- BEGIN: Modal Buy -->
<div class="modal fade" id="buy_random_ngocrong" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Xác nhận mua tài khoản Random</h4>
            </div>

            <div class="modal-body">

                <form id="form_buy_random" method="POST" action="{{Route('random.buy_acc')}}" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="id">
                </form>

                <div class="tab-content">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th colspan="2">Thông tin thanh toán # <span id="id_random"></span> </th>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>Loại:</td>
                                <th id="type"></th>
                            </tr>
                            <tr>
                                <td>Danh mục:</td>
                                <th id="category"></th>
                            </tr>
                            <tr>
                                <td>Tên game:</td>
                                <th id="game"></th>
                            </tr>
                            <tr>
                                <td>Giá tiền:</td>
                                <th id="cost" class="text-info"></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer justify-content-right">
                @if(!Auth::check())
                <div class="row">
                    <label class="col-md-12 form-control-label text-danger" style="text-align: center;margin: 10px 0; ">Bạn phải đăng nhập mới có thể mua tài khoản tự động.</label>
                </div>
                <a type="button" href="{{Route('login')}}" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Đăng nhập</a>
                @else
                <button type="submit" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" form="form_buy_random">Mua Ngay</button>
                @endif

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng </button>
            </div>
        </div>
    </div>
</div>
<!-- END: Modal Buy -->