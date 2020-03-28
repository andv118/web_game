<!-- BEGIN: MODAL THANH TOAN -->
<div class="modal fade bd-example-modal-sm" id="modal_thanhtoan_ngocrong" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Xác nhận mua tài khoản</h4>
            </div>

            <div class="modal-body">

                <form id="form_buy_ngocrong" method="POST" action="{{Route('pay_ngoc_rong')}}" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="id">
                    <input type="hidden" name="cost">
                </form>

                <div class="c-content-tab-4 c-opt-3" role="tabpanel">

                    <ul class="nav nav-justified" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#thanhtoan" role="tab" data-toggle="tab" class="c-font-16" aria-expanded="true">Thanh toán</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#taikhoan" role="tab" data-toggle="tab" class="c-font-16" aria-expanded="false">Tài khoản</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="thanhtoan">
                            <ul class="c-tab-items p-t-0 p-b-0 p-l-5 p-r-5">
                                <li class="c-font-dark">

                                    <table cellpadding="10" class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Thông tin tài khoản # <span class="id_ngocrong"></span> </th>
                                            </tr>
                                            <tr>
                                                <td style="width:50%">Nhà phát hành:</td>
                                                <th>TeaMobi</th>
                                            </tr>
                                            <tr>
                                                <td style="width:50%">Tên game:</td>
                                                <th>Ngọc Rồng</th>
                                            </tr>
                                            <tr>
                                                <td style="width:50%">Giá tiền:</td>
                                                <th id="cost" class="text-info"></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </li>
                            </ul>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="taikhoan">
                            <ul class="c-tab-items p-t-0 p-b-0 p-l-5 p-r-5">
                                <li class="c-font-dark">

                                    <table cellpadding="10" class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Chi tiết tài khoản # <span class="id_ngocrong"></span> </th>
                                            </tr>
                                            <tr>
                                                <td style="width:50%">Hành tinh:</td>
                                                <th class="text-danger" id="hanhtinh"></th>
                                            </tr>
                                            <tr>
                                                <td style="width:50%">Server:</td>
                                                <th class="text-danger" id="server"></th>
                                            </tr>
                                            <tr>
                                                <td style="width:50%">Nick sơ sinh có đệ:</td>
                                                <th class="text-danger" id="detu"></th>
                                            </tr>
                                            <tr>
                                                <td style="width:50%">Bông tai:</td>
                                                <th class="text-danger" id="bongtai"></th>
                                            </tr>
                                            <tr>
                                                <td style="width:50%">Đăng ký:</td>
                                                <th class="text-danger" id="dangky"></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div style="clear: both"></div>
            </div>

            <div class="modal-footer">

                @if(!Auth::check())
                <div class="row">
                    <label class="col-md-12 form-control-label text-danger" style="text-align: center;margin: 10px 0; ">Bạn phải đăng nhập mới có thể thanh toán.</label>
                </div>
                <a type="button" href="{{Route('login')}}" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Đăng nhập</a>
                @else
                <button type="sumbit" form="form_buy_ngocrong" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Xác nhận mua</button>
                @endif

                <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<!-- END: MODAL THANH TOAN -->

<script>
    $(document).ready(function() {
        $('#modal_thanhtoan_ngocrong').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // console.log(123);
            var id = button.data('id')
            var cost = button.data('cost')
            var hanhtinh = button.data('hanhtinh') // Extract info from data-* attributes
            var server = button.data('server')
            var detu = button.data('detu')
            var bongtai = button.data('bongtai')
            var dangky = button.data('dangky')
            costFomat = cost.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")

            console.log(dangky)

            var modal = $(this)
            modal.find('input[name="id"]').val(id)
            modal.find('input[name="cost"]').val(cost)
            modal.find('.id_ngocrong').text(id)
            modal.find('#cost').text(costFomat + 'đ')
            modal.find('#hanhtinh').text(hanhtinh)
            modal.find('#server').text(server)
            modal.find('#detu').text(detu)
            modal.find('#bongtai').text(bongtai)
            modal.find('#dangky').text(dangky)
        })
    });
</script>