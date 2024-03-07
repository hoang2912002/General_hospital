<nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky "
            id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm">
                            <i class='fa ni bx bxs-home text-sm opacity-10' style="color: #ffffff;"></i>
                        </li>
                        <li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
                                href="{{(isset($name_page)) ? route( $name_page['route']) : '#' }}">{{ $name_page['total'] ?? ' ' }}</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ $name_page['name'] ?? ' ' }}</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0 text-white">{{ $name_page['name'] ?? ' ' }}</h6>
                </nav>
                <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
                    <a href="javascript:;" class="nav-link p-0">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </div>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex flex-row-reverse" id="navbar">
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">

                            <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user me-sm-1" aria-hidden="true"></i>
                                {{-- <span class="d-sm-inline d-none">{{ Auth::user()->User->name }}</span> --}}
                            </a>
                            <ul style="top: 0.25rem!important;" class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a class="dropdown-item border-radius-md" href="">
                                        <span style="margin-right: 20px;" class="font-weight-bold">LogOut</span>
                                        <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
