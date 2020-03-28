<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8"/>
  <title>{{$settings[1]}}</title>
  <meta name="description" content="{{$settings[6]}}">
  <meta name="keywords" content="{{$settings[7]}}">
  <base href="{{asset('')}}">
  <link rel="shortcut icon" href="public/client/assets/images/ico.png" type="image/x-icon">
  <link rel="canonical" href="">
  <meta content="" name="author"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta property="og:type" content="website"/>
  <meta property="og:url" content=""/>
  <meta property="og:title" content="{{$settings[1]}}"/>
  <meta property="og:description" content="{{$settings[6]}}"/>
  <meta property="og:image" content="public/client/assets/images/image-share.jpg"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport"/>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet' type='text/css'>
  <link href="public/client/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="public/client/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="public/client/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
  <link href="public/client/assets/css/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN: BASE PLUGINS  -->
  <link href="public/client/assets/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
  <link href="public/client/assets/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"/>
  <link href="public/client/assets/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css"/>
  <link href="public/client/assets/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
  <link href="public/client/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
  <!-- END: BASE PLUGINS -->

  <!-- BEGIN THEME STYLES -->
  <link href="public/client/assets/css/bootstrap-social.css" rel="stylesheet" type="text/css"/>
  <link href="public/client/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
  <link href="public/client/assets/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
  <link href="public/client/assets/css/default.css" rel="stylesheet" id="style_theme" type="text/css"/>
  <link href="public/client/assets/css/custom.css" rel="stylesheet" type="text/css"/>
  
  <link rel="stylesheet" href="public/client/assets/css/owl-carousel/owl.carousel.css">
  <link rel="stylesheet" href="public/client/assets/css/owl-carousel/owl.theme.css">
  <link rel="stylesheet" href="public/client/assets/css/owl-carousel/owl.transitions.css">
  
  <script src="public/client/assets/js/plugins/jquery-2.1.0.min.js"></script>
  <script src="public/client/assets/js/plugins/bootstrap.min.js"></script>
  <script src="public/client/assets/js/plugins/owl.carousel.min.js"></script>
  <script src="public/client/assets/js/plugins/slider.js"></script>
  <script src="public/client/assets/js/bootstrap3-typeahead.min.js"></script>
  <script src="public/client/assets/js/plugins/jquery.cookie.js"></script>
  <link href="public/client/assets/css/style.css?v=699669" rel="stylesheet" type="text/css"/>
  <!-- END THEME STYLES -->
  <style>
        .ui-autocomplete {
          max-height: 500px;
          overflow-y: auto;
          overflow-x: hidden;
        }

        .input-group-addon {
          background-color: #FAFAFA;
        }

        .input-group .input-group-btn > .btn, .input-group .input-group-addon {
          background-color: #FAFAFA;
        }

        .modal {
          text-align: center;
        }

        @media  screen and (min-width: 768px) {
          .modal:before {
            display: inline-block;
            vertical-align: middle;
            content: " ";
            height: 100%;
          }
        }

        @media (min-width: 992px) and (max-width: 1200px) {
          .c-layout-header-fixed.c-layout-header-topbar .c-layout-page {
            margin-top: 245px;
          }
        }

        @media  screen and (max-width: 767px) {
          .modal-dialog:before {
            margin-top: 75px;
            display: inline-block;
            vertical-align: middle;
            content: " ";
            height: 100%;
          }

          .modal-dialog {
            width: 100%;

          }

          .modal-content {
            margin-right: 20px;
          }
        }

        .modal-dialog {
          display: inline-block;
          text-align: left;


        }

        .mfp-wrap {
          z-index: 20000 !important;
        }

        .c-content-overlay .c-overlay-wrapper {
          z-index: 6;
        }

        .z7 {
          z-index: 7 !important;
        }
   </style>

<body class="c-layout-header-fixed c-layout-header-mobile-fixed c-layout-header-topbar c-layout-header-topbar-collapse">

      <!-- BEGIN: HEADER -->
      @include('user.masterlayout.header')
      <!-- END: HEADER -->

      <!-- BEGIN: PAGE CONTAINER -->
      <div class="c-layout-page">
          
          <!-- main content -->
          @yield('content')
          <!-- end main content -->

          <style type="text/css">

             .hover:hover {
               transition: 0.2s;
               transform: scale(1.1);
             }

             .classWithPad:hover{
              transition: 0.2s;
              transform: scale(1.1);
             }

          </style>
      </div>
      <!-- END: PAGE CONTAINER -->

      <!-- BEGIN: FOOTER -->
      @include('user.masterlayout.footer')
      <!-- END: FOOTER -->

      <!-- BEGIN: THEME SCRIPTS -->
      <script src="public/client/assets//js/jquery-migrate.min.js" type="text/javascript"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <!-- <script src="public/client/assets//js/bootstrap.min.js" type="text/javascript"></script> -->
      <script src="public/client/assets//js/plugins/jquery.smooth-scroll.js" type="text/javascript"></script>
      <script src="public/client/assets//js/js.cookie.js" type="text/javascript"></script>
      <script src="public/client/assets//js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
      <script src="public/client/assets//js/jquery.counterup.min.js" type="text/javascript"></script>
      <script src="public/client/assets//js/jquery.waypoints.min.js" type="text/javascript"></script>
      <script src="public/client/assets//js/jquery.fancybox.pack.js" type="text/javascript"></script>
      <script src="public/client/assets//js/bootbox.min.js" type="text/javascript"></script>
      <script src="public/client/assets//js/hideShowPassword.min.js" type="text/javascript"></script>
      <script src="public/client/assets//js/components.js" type="text/javascript"></script>
      <script src="public/client/assets//js/app.js" type="text/javascript"></script>
      <script>
        $(document).ready(function () {
          App.init(); // init core
        });
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })


          $(".menu-main-mobile a").click(function() {

              if( $(this).closest("li").hasClass("c-open")){
                  $(this).closest("li").removeClass("c-open");
          }
          else{
                  $(this).closest("li").addClass("c-open");
          }
          });
      </script>
      <!-- END: THEME SCRIPTS -->

      <!-- BEGIN: PAGE SCRIPTS -->
      <script src="public/client/assets//js/jquery.mask.min.js" type="text/javascript"></script>
      <script src="public/client/assets//js/bootstrap-datepicker.min.js" type="text/javascript"></script>
      <script src="public/client/assets//js/bootstrap-timepicker.min.js" type="text/javascript"></script>
      <script src="public/client/assets//js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
      <script src="public/client/assets//js/datepicker.js" type="text/javascript"></script>
      <script src="public/client/assets//js/common.js" type="text/javascript"></script>
       <!-- END: PAGE SCRIPTS -->

</body>
</html>
