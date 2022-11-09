<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/issb-logo.png') }}" type="image/png" sizes="16x16">
    <title>ISSB | Login</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('/css/font-awesome.min.css')}}" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('bootstrap-3.4.1-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{ asset('sweetalert/sweet-alert.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">


    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        .text-center.mt-4 {
            margin: 20px 5px;
        }
        .form-control{
            padding: 1.375rem .75rem;
            font-size: 1.5rem;
        }
    </style>
</head>
<body id="app-layout">
    <div class="text-center mt-4"><img src="{{ asset('assets/images/issb-logo.png') }}" width="100" alt="Logo" class="img-circle">
        <h1 class="mb-5">ISSB PSY-TEST-SYSTEM</h1>
    </div>
    @yield('content')

    @section('footer_scripts')
        <!-- JavaScripts -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        {{-- <script src="{{asset('bootstrap-3.4.1-dist/js/bootstrap.min.js')}}"></script> --}}
        <script src="{{asset('sweetalert/sweet-alert.js')}}"></script>
        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    @show

</body>
</html>
