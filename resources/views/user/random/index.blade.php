@extends('user.masterlayout.master')

@section('content')


<div class="c-content-box c-size-md c-bg-white">
    <div class="container">

        <!-- Thông báo -->
        <div class="flash-message">
            @if (Session::has('message'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ Session::get('message') }}
            </div>
            @elseif(Session::has('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ Session::get('error') }}
            </div>
            @elseif($errors->any())
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ $errors->first() }}
            </div>
            @endif

        </div>
        <!-- END Thông báo -->

        <!-- Begin: Testimonals 1 component -->
        <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl">
            <!-- Begin: Title 1 component -->
            <div class="c-content-title-1">
                <h3 class="c-center c-font-uppercase c-font-bold">{{$title}}</h3>
                <div class="c-line-center c-theme-bg"></div>
            </div>

            <div class="row row-flex-safari game-list" style="margin-top: 20px;">
                <?php foreach ($data as $val) : ?>

                    <div class="col-sm-6 col-md-3" id="">
                        <div class="classWithPad">

                            <div class="image">
                                <a>
                                    @if($val->cost == 20000)
                                    <img src="public/client/assets/images/randomnr20k.jpg">
                                    @elseif($val->cost == 50000)
                                    <img src="public/client/assets/images/randomnr50k.jpg">
                                    @elseif($val->cost == 100000)
                                    <img src="public/client/assets/images/randomnr100k.jpg">
                                    @endif
                                    <span class="ms">MS: {{$val->id}}</span>
                                </a>
                            </div>

                            <div class="description">
                                Thử vận may ngay
                            </div>

                            <div class="attribute_info" style="margin-top: 10px;min-height: 93px;">
                                <div class="row">
                                    <div class="col-xs-6 a_att">
                                        Hành Tinh: <b>???</b>
                                    </div>
                                    <div class="col-xs-6 a_att">
                                        Vũ Trụ: <b>???</b>
                                    </div>
                                </div>
                            </div>

                            <div class="a-more">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="price_item">
                                            {{number_format($val->cost)}}đ
                                        </div>
                                    </div>
                                    <div class="col-xs-6 ">
                                        <div class="view">
                                            <a id="mua_random" data-id="{{$val->id}}" data-type="{{$val->type}}" data-cost="{{$val->cost}}" data-category="{{$val->category}}" data-toggle="modal" data-target="#buy_random">Mua ngay</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                <?php endforeach ?>
            </div>
            <!-- End-->
        </div>
        <!-- End-->
        <div class="paginate" style="display: flex;justify-content: center;">

            {{$data->links()}}

        </div>
    </div>
</div>

@include('user.random.buy')

<script>
    $(document).ready(function() {
        $('#buy_random').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // console.log(123);
            var id = button.data('id')
            var type = button.data('type') // Extract info from data-* attributes
            var cost = button.data('cost')
            var category = button.data('category')
            var game = type.replace("Random", " ");
            cost = cost.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")

            console.log(game)

            var modal = $(this)
            modal.find('input[name="id"]').val(id)
            modal.find('#id_random').text(id)
            modal.find('#type').text(type)
            modal.find('#category').text(category)
            modal.find('#game').text(game)
            modal.find('#cost').text(cost + 'đ')

        })
    });
</script>


<style type="text/css">
    .classWithPad: {
        margin-bottom: 20px !important;
    }


    .classWithPad .image {
        position: relative;
    }

    .classWithPad .image .ms {

        position: absolute;
        padding: 2px 7px;
        background-color: #a94442;
        top: 5px;
        right: 0;
        color: #fff;
        font-weight: 700;
        font-size: 15px;

    }

    .description {
        border-radius: 0;
        display: block;
        padding: 8px;
        background-color: #8a6969;
        font-weight: 700;
        line-height: 1;
        font-size: 75%;
        color: #fff !important;
        text-align: center;

    }

    .price_item {
        text-align: center;
        border: 1px solid red;
        padding: 5px;
        color: red;
    }

    .item-list .a-more .view {
        text-align: center;
        color: #ffffff;
        background: #32c5d2;
        border-color: #32c5d2;
        padding: 6px;
        font-size: 17px;
        font-weight: 400;
        text-transform: uppercase;
    }

    .attribute_info .a_att {
        font-size: 15px;
        padding: 5px;
        text-align: center;
        margin-bottom: 5px;
    }


     

   @media only screen and (max-width: 768px){
    .row-flex-safari .classWithPad {
      height: 400px!important;
      max-height: 430px!important;
       margin-bottom: 20px;
     }

  }


   @media only screen and (max-width: 414px){
    .row-flex-safari .classWithPad {
      height: 456px!important;
    max-height: 512px!important;
       margin-bottom: 20px;
     }

  }



  @media only screen and (max-width: 320px){
    .row-flex-safari .classWithPad {
      height: 411px!important;
      min-height: 450px!important;
    }

  }
</style>

@endsection