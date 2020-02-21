<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} {{ ucfirst(config('multiauth.prefix')) }}</title>

        <!-- Scripts -->
{{--        <script src="{{ asset('js/app.js') }}" defer></script>--}}

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{ asset('admin_assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/vendors/css/vendor.bundle.base.css') }}">
        <!-- endinject -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('admin_assets/css/style.css') }}">
        <!-- endinject -->
        <link rel="shortcut icon" href="images/favicon.png" />

        @yield('styles')
    </head>
<body>

    <div id="app" class="container-scroller">
        @include('.vendor.multiauth.includes.nav')

        <main>
            @yield('content')
        </main>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.addons.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('admin_assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin_assets/js/misc.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/zbo48vv2tfmw94an8n1ejbmyq8pabmf3nzbbga7e86ddsakw/tinymce/5/tinymce.min.js"></script>
{{--    <script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>--}}
    <!-- endinject -->
    <!-- Custom js for this page-->
{{--    <script src="{{ asset('admin_assets/js/dashboard.js') }}"></script>--}}
    <!-- End custom js for this page-->
    @yield('scripts')

</body>

</html>
