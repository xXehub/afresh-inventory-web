<!doctype html>
<html lang="en" dir="ltr">

<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Models\Admin\WebModel;
use Illuminate\Support\Facades\Session;

$web = WebModel::first();
?>

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{$web->web_deskripsi}}">
    <meta name="author" content="{{$web->web_nama}}">
    <meta name="keywords" content="">

    <!-- FAVICON -->
    @if($web->web_logo == '' || $web->web_logo == 'default.png')
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/assets/default/web/default.png')}}" />
    @else
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/web/' . $web->web_logo)}}" />
    @endif

    <!-- TITLE -->
    <title>{{$title}} | {{$web->web_nama}}</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ url('/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{url('/assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{url('/assets/css/dark-style.css')}}" rel="stylesheet" />
    <link href="{{url('/assets/css/transparent-style.css')}}" rel="stylesheet">
    <link href="{{url('/assets/css/skin-modes.css')}}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{url('/assets/css/icons.css')}}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{url('/assets/colors/color1.css')}}" />

    <style>
        html,body{
            overflow: auto;
        }
    </style>
</head>

<body class="app sidebar-mini ltr">

    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{url('/assets/images/loader.svg')}}" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                <!-- CONTAINER OPEN -->
                @yield('content')
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="{{url('/assets/js/jquery.min.js')}}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{url('/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{url('/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- SWEET-ALERT JS -->
    <script src="{{url('/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{url('/assets/js/sweet-alert.js')}}"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="{{url('/assets/js/show-password.min.js')}}"></script>

    <!-- GENERATE OTP JS -->
    <script src="{{url('/assets/js/generate-otp.js')}}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{url('/assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>

    <!-- Color Theme js -->
    <script src="{{url('/assets/js/themeColors.js')}}"></script>

    <!-- CUSTOM JS -->
    <script src="{{url('/assets/js/custom.js')}}"></script>

    @if(Session::get('status') == 'success')
    <script>
        $(document).ready(function() {
            swal({
                title: "{{Session::get('msg')}}",
                type: "success"
            });
        });
    </script>
    @elseif(Session::get('status') == 'error')
    <script>
        $(document).ready(function() {
            swal({
                title: "{{Session::get('msg')}}",
                type: "error"
            });
        });
    </script>
    @endif

    @yield('scripts')

</body>

</html>