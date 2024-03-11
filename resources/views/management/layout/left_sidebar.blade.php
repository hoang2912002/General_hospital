<aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main">
        <div class="sidenav-header ">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0"
                href=""
                target="_blank">
                <img src="" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold "></span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link active"
                        aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class='fa ni bx bxs-home text-sm opacity-10' style="color: #7a7a7a;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboards</span>
                    </a>
                    <div class="collapse  show " id="dashboardsExamples">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> H </span>
                                    <span class="sidenav-normal"> Homepage </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">USER</h6>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link "
                        aria-controls="pagesExamples" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class=" fa ni fa-solid fa-user text-sm opacity-10" style="color: #7a7a7a;"></i>
                        </div>
                        <span class="nav-link-text ms-1">User</span>
                    </a>
                    <div class="collapse " id="pagesExamples">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('user.index') }}">
                                    <span class="sidenav-mini-icon"> U </span>
                                    <span class="sidenav-normal"> User </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#book" class="nav-link "
                        aria-controls="book" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class=" fa ni fa-solid fa-regular fa-calendar-check text-sm opacity-10" style="color: #7a7a7a;"></i>

                        </div>
                        <span class="nav-link-text ms-1">Book</span>
                    </a>
                    <div class="collapse " id="book">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> B </span>
                                    <span class="sidenav-normal"> Book </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#applicationsExamples" class="nav-link "
                        aria-controls="applicationsExamples" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">

                            <i class="fa ni fa-solid fa-user-shield text-sm opacity-10" style="color: #7a7a7a;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Decentralization</span>
                    </a>
                    <div class="collapse " id="applicationsExamples">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('group.index') }}">
                                    <span class="sidenav-mini-icon"> G </span>
                                    <span class="sidenav-normal"> Group </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> R </span>
                                    <span class="sidenav-normal"> Role </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#ecommerceExamples" class="nav-link "
                        aria-controls="ecommerceExamples" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa ni fa-solid fa-cart-plus text-sm opacity-10" style="color: #7a7a7a;"></i>

                        </div>
                        <span class="nav-link-text ms-1">Bill</span>
                    </a>
                    <div class="collapse " id="ecommerceExamples">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> B </span>
                                    <span class="sidenav-normal"> Bill </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#authExamples" class="nav-link " aria-controls="authExamples"
                        role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa ni fa-solid fa-capsules text-sm opacity-10" style="color: #7a7a7a;"></i>
                        </div>
                        <span class="nav-link-text ms-1 ">Medicines</span>
                    </a>
                    <div class="collapse " id="authExamples">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal"> Prescription </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> M </span>
                                    <span class="sidenav-normal"> Medicines </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> T </span>
                                    <span class="sidenav-normal"> Type of medicines </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> M </span>
                                    <span class="sidenav-normal"> Manufactureres </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#equipment" class="nav-link " aria-controls="equipment"
                        role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa ni fa-solid fa-hospital text-sm opacity-10" style="color: #7a7a7a;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Equipment</span>
                    </a>
                    <div class="collapse " id="equipment">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Service </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#service" class="nav-link " aria-controls="service"
                        role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">

                            <i class="fa ni fa-solid fa-book-open text-sm opacity-10" style="color: #7a7a7a;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Service</span>
                    </a>
                    <div class="collapse " id="service">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Shift </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> R </span>
                                    <span class="sidenav-normal"> Room </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
