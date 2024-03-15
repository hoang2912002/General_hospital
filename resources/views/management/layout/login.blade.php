<html lang="en" class="">

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

</head>

<body class="bg-gray-100">


    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>



    <main class="main-content mt-0 ps">
        <div class="page-header align-items-start min-vh-50 pt-7 pb-9 m-3 border-radius-lg"
            style="background-image: url('{{ asset('img') }}/general_hospital/management/background/6327035de6b80312b6eaed9a_footer-bg.png');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Trang quản lý Đa khoa G37!</h1>
                        <p class="text-lead text-white">Vui lòng nhập tài khoản mật khẩu để đăng nhập.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card mt-5">
                        <div class="card-header pb-0 text-start">
                            <h3 class="font-weight-bolder">Đăng nhập</h3>
                            {{-- <p class="mb-0">Enter your email and password to sign in</p> --}}
                        </div>
                        <div class="card-body">
                            <form role="form" class="text-start" action="{{ route('login.processLogin') }}" method="POST">
                                @csrf
                                @method('POST')
                                <label>Email</label>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email" value="{{ old('name') }}">
                                    @error('email')
                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @if(Session::has('email'))
                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                            {{ session('email') }}
                                        </div>

                                    @endif
                                </div>
                                <label>Mật khẩu</label>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password">
                                    @error('password')
                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @if(Session::has('password'))
                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                        {{ session('password') }}
                                    </div>

                                @endif
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" checked="" name="remember">
                                    <label class="form-check-label" for="rememberMe" >Ghi nhớ đăng nhập</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100 mt-4 mb-0">Đăng nhập</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </main>


{{--

    <iframe id="_hjSafeContext_9590759" title="_hjSafeContext" tabindex="-1" aria-hidden="true" src="about:blank"
        style="display: none !important; width: 1px !important; height: 1px !important; opacity: 1; pointer-events: none !important; overflow: visible;"></iframe>
</body><iframe id="__JSBridgeIframe_1.0__" title="jsbridge___JSBridgeIframe_1.0__"
    style="display: none;"></iframe><iframe id="__JSBridgeIframe_SetResult_1.0__"
    title="jsbridge___JSBridgeIframe_SetResult_1.0__" style="display: none;"></iframe><iframe id="__JSBridgeIframe__"
    title="jsbridge___JSBridgeIframe__" style="display: none;"></iframe><iframe id="__JSBridgeIframe_SetResult__"
    title="jsbridge___JSBridgeIframe_SetResult__" style="display: none;"></iframe> --}}

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('asset/admin') }}/js/toastr/toastr.min.js"></script>
@error('success')
<script>
    successMessage('{{ $message }}');
</script>
@enderror
@error('error')
<script>
    errorMessage('{{ $message }}');
</script>
@enderror
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

