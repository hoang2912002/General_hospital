<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        Đa Khoa G37 trang Quản lý
    </title>
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/customer') }}/icon_page.png">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ asset('asset/admin') }}/css/fontawesome-free/all.min.css"> --}}
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('asset/admin') }}/css/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/css/jqvmap/jqvmap.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/css/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!--Box icon-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="{{ asset('asset/admin') }}/css/nucleo/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('asset/admin') }}/css/nucleo/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('asset/admin') }}/css/argon-dashboard.min.css?v=2.0.5" rel="stylesheet" />

    <!--Toastr-->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/css/toastr/toastr.min.css">

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @stack('css')
</head>

<body class="g-sidenav-show   bg-gray-100">
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>

    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('management.layout.left_sidebar')
    <main class="main-content position-relative border-radius-lg ps">

        @include('management.layout.header')

        <div class="container-fluid py-4">
            @yield('content')
            <br>
            @include('management.layout.footer')
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </main>
    {{-- @include('admin.layout.right_sidebar') --}}

    <script src="{{ asset('asset/admin') }}/js/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/jquery/jquery-ui.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/smooth-scrollbar.min.js"></script>

    <script src="{{ asset('asset/admin') }}/js/plugins/dragula/dragula.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/jkanban/jkanban.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/chartjs.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('asset/admin') }}/js/toastr/toastr.min.js"></script>
    {{-- <script src="{{ asset('asset/admin') }}/js/argon-dashboard.min.js?v=2.0.5"></script> --}}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        @if(Session::has('error'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
            toastr.error("{{ session('error') }}");
        @endif
        @if(Session::has('success'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
            toastr.success("{{ session('success') }}");
        @endif
    </script>
    @stack('js')
</body>

</html>
