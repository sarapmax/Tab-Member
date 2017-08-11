<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Tab Member System</title>
        <!-- Vendor styles-->
        <!-- build:css(../app) css/vendor.css-->
        <!-- Animate.CSS-->
        <link rel="stylesheet" href="{{  asset('centric/vendor/animate.css/animate.css') }}">
        <!-- Bootstrap-->
        <link rel="stylesheet" href="{{  asset('centric/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Ionicons-->
        <link rel="stylesheet" href="{{  asset('centric/vendor/ionicons/css/ionicons.css') }}">
        <!-- Select2-->
        <link rel="stylesheet" href="{{  asset('centric/vendor/select2/dist/css/select2.css') }}">
        <!-- Datatables-->
        <link rel="stylesheet" href="{{  asset('centric/vendor/datatables/media/css/jquery.dataTables.css') }}">
        <!-- Sweet Alert-->
        <link rel="stylesheet" href="{{  asset('centric/vendor/sweetalert/dist/sweetalert.css') }}">
        <!-- Loaders.CSS-->
        <link rel="stylesheet" href="{{  asset('centric/vendor/loaders.css/loaders.css') }}">
        <!-- Material Floating Button-->
        <link rel="stylesheet" href="{{  asset('centric/vendor/ng-material-floating-button/mfb/dist/mfb.css') }}">
        <!-- Material Colors-->
        <link rel="stylesheet" href="{{  asset('centric/vendor/material-colors/dist/colors.css') }}">

        <link rel="stylesheet" href="{{  asset('bower_components/font-awesome/css/font-awesome.min.css') }}">

        <!-- endbuild-->
        <!-- Application styles-->
        <link rel="stylesheet" href="{{  asset('centric/css/app.css') }}">

        {{-- custom --}}
        <link rel="stylesheet" href="{{  asset('custom.css') }}">        

        {{-- via bower --}}
        <link href="{{ asset('bower_components/date-picker/css/datepicker.css') }}" rel="stylesheet">
    </head>
    <body class="theme-5">
        @yield('app')
    <!-- build:js(../app) js/vendor.js-->
    <!-- jQuery-->
    <script src="{{ asset('centric/vendor/jquery/dist/jquery.js') }}"></script>
    <!-- Bootstrap-->
    <script src="{{ asset('centric/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
    <!-- jQuery Browser-->
    <script src="{{ asset('centric/vendor/jquery.browser/dist/jquery.browser.js') }}"></script>
    <!-- Material Colors-->
    <script src="{{ asset('centric/vendor/material-colors/dist/colors.js') }}"></script>
    <!-- Bootstrap Filestyle-->
    <script src="{{ asset('centric/vendor/bootstrap-filestyle/src/bootstrap-filestyle.js') }}"></script>
    <!-- Select2-->
    <script src="{{ asset('centric/vendor/select2/dist/js/select2.js') }}"></script>
    <!-- Momentjs-->
    <script src="{{ asset('centric/vendor/moment/min/moment-with-locales.js') }}"></script>
    <script src="{{ asset('centric/vendor/gmaps/gmaps.js') }}"></script>
    <!-- Datatables-->
    <script src="{{ asset('centric/vendor/datatables/media/js/jquery.dataTables.js') }}"></script>
    <!-- Sweet Alert-->
    <script src="{{ asset('centric/vendor/sweetalert/dist/sweetalert-dev.js') }}"></script>
    <!-- Images Loaded-->
    <script src="{{ asset('centric/vendor/imagesloaded/imagesloaded.pkgd.js') }}"></script>
    <!-- Loaders.CSS-->
    <script src="{{ asset('centric/vendor/loaders.css/loaders.css.js') }}"></script>

    {{-- via bower --}}
    <script src="{{ asset('bower_components/date-picker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('bower_components/date-picker/js/bootstrap-datepicker-thai.js') }}"></script>
    <script src="{{ asset('bower_components/date-picker/js/locales/bootstrap-datepicker.th.js') }}"></script>

    {{-- <script src="{{ asset('webcamjs/webcam.js') }}"></script> --}}
    <script src="{{ asset('webcamjs/webcam.js') }}"></script>

    @include('sweet::alert')

    <!-- endbuild-->
    <!-- App script-->
    <script src="{{ asset('centric/js/app.js') }}"></script>

    <script type="text/javascript">
        $('.datepicker').datepicker({
            language:'th-th',
            format:'dd-mm-yyyy',
            autoclose: true,
        })

        // $(".datatable").datatable()
    </script>

    @yield('js')
  </body>
</html>