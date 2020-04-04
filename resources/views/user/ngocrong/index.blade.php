@extends('user.masterlayout.master')

@section('content')


<div class="container">

    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-info" role="alert">
                <h2 class="alert-heading" style="text-align: center;text-transform: uppercase;">{!!$title!!}</h2>
            </div>
        </div>
    </div>

    <!-- BEGIN: Tim kiem -->
    <div class="row" style="margin-bottom: 15px">
        <div class="m-l-10 m-r-10">
            <form class="form-inline m-b-10" action="{{Route('ngoc_rong','all')}}" role="form" method="get">

                <div class="col-md-3 col-sm-4 p-5 field-search">
                    <div class="input-group c-square">
                        <span class="input-group-addon">Tìm kiếm</span>
                        <input name="keyword" type="text" class="form-control c-square" value="{{old('keyword')}}" placeholder="Tìm kiếm">
                        <input type="hidden" name="search" value="1">
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 p-5 field-search">
                    <div class="input-group c-square">
                        <span class="input-group-addon">Mã số</span>
                        <input type="number" class="form-control c-square" value="{{old('id')}}" placeholder="Mã số" name="id">
                    </div>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                    <div class="input-group c-square">
                        <span class="input-group-addon">Giá tiền</span>
                        <select style="" class="form-control c-square" name="price">
                            <option value="">Chọn giá tiền</option>
                            <option value="1" <?php if (old('price') == 1) {
                                                    echo 'selected';
                                                } ?>>Dưới 50K</option>
                            <option value="2" <?php if (old('price') == 2) {
                                                    echo 'selected';
                                                } ?>>Từ 50K - 200K</option>
                            <option value="3" <?php if (old('price') == 3) {
                                                    echo 'selected';
                                                } ?>>Từ 200K - 500K</option>
                            <option value="4" <?php if (old('price') == 4) {
                                                    echo 'selected';
                                                } ?>>Từ 500K - 1 Triệu</option>
                            <option value="5" <?php if (old('price') == 5) {
                                                    echo 'selected';
                                                } ?>>Trên 1 Triệu</option>
                            <option value="6" <?php if (old('price') == 6) {
                                                    echo 'selected';
                                                } ?>>Trên 5 Triệu</option>
                            <option value="7" <?php if (old('price') == 7) {
                                                    echo 'selected';
                                                } ?>>Trên 10 Triệu</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                    <div class="input-group c-square">
                        <span class="input-group-addon">Trạng thái</span>
                        <select name="status" class="form-control c-square">
                            <option value="0" <?php if (old('status') == '0') {
                                                    echo 'selected';
                                                } ?>>Chưa bán</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                    <div class="input-group c-square">
                        <span class="input-group-addon">Bông tai</span>
                        <select name="bongtai" class="form-control c-square">
                            <option value="">-- Không chọn --</option>
                            <option value="1" <?php if (old('bongtai') == 1) {
                                                    echo 'selected';
                                                } ?>>Có</option>
                            <option value="2" <?php if (old('bongtai') == 2) {
                                                    echo 'selected';
                                                } ?>>không</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                    <div class="input-group c-square">
                        <span class="input-group-addon">Nick Sơ Sinh Có Đệ</span>
                        <select name="detu" class="form-control c-square">
                            <option value="">-- Không chọn --</option>
                            <option value="1" <?php if (old('detu') == 1) {
                                                    echo 'selected';
                                                } ?>>Có</option>
                            <option value="2" <?php if (old('detu') == 2) {
                                                    echo 'selected';
                                                } ?>>không</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                    <div class="input-group c-square">
                        <span class="input-group-addon">Hành Tinh</span>
                        <select name="hanhtinh" class="form-control c-square">
                            <option value="">-- Không chọn --</option>
                            <option value="1" <?php if (old('hanhtinh') == 1) {
                                                    echo 'selected';
                                                } ?>>Xayda</option>
                            <option value="2" <?php if (old('hanhtinh') == 2) {
                                                    echo 'selected';
                                                } ?>>Namec</option>
                            <option value="3" <?php if (old('hanhtinh') == 3) {
                                                    echo 'selected';
                                                } ?>>Trái đất</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                    <div class="input-group c-square">
                        <span class="input-group-addon">Server</span>
                        <select name="servers" class="form-control c-square">
                            <option value="">-- Không chọn --</option>
                            <option value="1" <?php if (old('servers') == 1) {
                                                    echo 'selected';
                                                } ?>>Vũ Trụ 1 sao</option>
                            <option value="2" <?php if (old('servers') == 2) {
                                                    echo 'selected';
                                                } ?>>Vũ Trụ 2 sao</option>
                            <option value="3" <?php if (old('servers') == 3) {
                                                    echo 'selected';
                                                } ?>>Vũ Trụ 3 sao</option>
                            <option value="4" <?php if (old('servers') == 4) {
                                                    echo 'selected';
                                                } ?>>Vũ Trụ 4 sao</option>
                            <option value="5" <?php if (old('servers') == 5) {
                                                    echo 'selected';
                                                } ?>>Vũ Trụ 5 sao</option>
                            <option value="6" <?php if (old('servers') == 6) {
                                                    echo 'selected';
                                                } ?>>Vũ Trụ 6 sao</option>
                            <option value="7" <?php if (old('servers') == 7) {
                                                    echo 'selected';
                                                } ?>>Vũ Trụ 7 sao</option>
                            <option value="8" <?php if (old('servers') == 8) {
                                                    echo 'selected';
                                                } ?>>Vũ Trụ 8 sao</option>
                            <option value="9" <?php if (old('servers') == 9) {
                                                    echo 'selected';
                                                } ?>>SV nước ngoài</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-12  p-5 field-search">
                    <div class="input-group c-square">
                        <span class="input-group-addon">Đăng ký</span>
                        <select name="dangky" class="form-control c-square">
                            <option value="">-- Không chọn --</option>
                            <option value="1" <?php if (old('dangky') == 1) {
                                                    echo 'selected';
                                                } ?>>Ảo</option>
                            <option value="2" <?php if (old('dangky') == 2) {
                                                    echo 'selected';
                                                } ?>>Gmail Full</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 p-5 no-radius">
                    <button type="submit" class="btn c-square c-theme c-btn-green">Tìm kiếm</button>
                    <a class="btn c-square m-l-0 btn-danger" href="{{Route('ngoc_rong','all')}}">Tất cả</a>
                </div>
            </form>
        </div>
    </div>
    <!-- END: Tim kiem -->

    <!-- BEGIN: List item -->
    @if(sizeof($data) == 0)
    <div class="alert alert-info">
        <strong>
            <a href="{{Route('ngoc_rong','all')}}">
                <p class="text-center text-muted">MÃ SỐ NICK NÀY CÓ NGƯỜI ĐÃ MUA TRƯỚC ĐÓ HOẶC ĐANG ĐẶT CỌC BẠN VUI LÒNG CHỌN NICK KHÁC CẢM ƠN !</p>
            </a>
        </strong>
    </div>
    @elseif(old('id') != null && isset($data[0]->active) && $data[0]->active == 0)
    <div class="alert alert-info">
        <strong>
            <a href="{{Route('ngoc_rong','all')}}">
                <p class="text-center text-muted">MÃ SỐ NICK NÀY CÓ NGƯỜI ĐÃ MUA TRƯỚC ĐÓ HOẶC ĐANG ĐẶT CỌC BẠN VUI LÒNG CHỌN NICK KHÁC CẢM ƠN !</p>
            </a>
        </strong>
    </div>
    @else
    <div class="row row-flex  item-list">
        @foreach($data as $value)
        <div class="col-sm-6 col-md-3">
            <div class="classWithPad">
                <div class="image">
                    <a title="Xem chi tiết" href="{{Route('chi_tiet_ngoc_rong',$value->id)}}">
                        <img src="{{ $ngocrong->getThumbnail($value->id) }}">
                        <span class="ms">MS:
                            <?php echo (int) $value->id; ?></span>
                    </a>
                </div>

                <div class="description">
                    {{ $ngocrong->strNote($value->note) }}
                </div>

                <div class="attribute_info">
                    <div class="row">
                        <div class="col-xs-6 a_att">
                            Hành Tinh: <b>{{ $ngocrong->strHanhTinh($value->hanhtinh) }}</b>
                        </div>

                        <div class="col-xs-6 a_att">
                            Server: <b>{{ $ngocrong->strServer($value->server) }}</b>
                        </div>

                        <div class="col-xs-6 a_att">
                            Bông tai: <b>{{ $ngocrong->strBongTai($value->bongtai) }}</b>
                        </div>

                        <div class="col-xs-6 a_att">
                            Đăng ký: <b>{{ $ngocrong->strDangKy($value->dk) }}</b>
                        </div>

                    </div>
                </div>

                <div class="a-more">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="price_item">
                                @if($value->status == 0)
                                {{ number_format($value->cost) . 'đ' }}
                                @else
                                Đã bán
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-6 ">
                            <div class="view">
                                <a title="Xem chi tiết" href="{{Route('chi_tiet_ngoc_rong',$value->id)}}">Chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    <!-- END: List item -->

    <!-- Pagination -->
    <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
        {{$data->appends(request()->query())->links()}}
    </div>
    <!-- END Pagination -->

</div>

@endsection