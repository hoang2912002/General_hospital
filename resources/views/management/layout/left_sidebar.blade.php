<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "id="sidenav-main">
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
                    <a data-bs-toggle="collapse" href="#myprofile" class="nav-link active"
                        aria-controls="myprofile" role="button" aria-expanded="false">
                        <div
                            class=" text-center d-flex align-items-center justify-content-center">
                            <img src="{{(isset(Auth::user()->User->doctor->image)) ? asset(Auth::user()->User->doctor->image) : 'https://dautubanthan.net/wp-content/uploads/2021/12/A%CC%89nh-avatar-facebook-theo-phong-ca%CC%81ch-do%CC%9Bn-gia%CC%89n.jpg'  }} "
                            alt="profile_image" class="" alt="" srcset="" class="avatar"
                            style="vertical-align: middle;width: 1.775rem;height: 1.775rem; border-radius: 50%;">
                        </div>
                        <span class="nav-link-text ms-1 pe-2">{{ Auth::user()->User->first_name . ' '  .  Auth::user()->User->last_name }}</span>
                    </a>
                    <div class="collapse  show " id="myprofile">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('user.profile')}}">
                                    <span class="sidenav-mini-icon"> T </span>
                                    <span class="sidenav-normal"> Trang cá nhân </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('user.setting')}}">
                                    <span class="sidenav-mini-icon"> C </span>
                                    <span class="sidenav-normal"> Cài đặt </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('login.logout')}}">
                                    <span class="sidenav-mini-icon"> Đ </span>
                                    <span class="sidenav-normal"> Đăng xuất </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
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
                                <a class="nav-link " href="{{ route('index')}}">
                                    <span class="sidenav-mini-icon"> T </span>
                                    <span class="sidenav-normal"> Trang chủ </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Người dùng</h6>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link "
                        aria-controls="pagesExamples" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class=" fa ni fa-solid fa-user text-sm opacity-10" style="color: #7a7a7a;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Người dùng</span>
                    </a>
                    <div class="collapse " id="pagesExamples">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('user.index') }}">
                                    <span class="sidenav-mini-icon"> N </span>
                                    <span class="sidenav-normal"> Người dùng </span>
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
                        <span class="nav-link-text ms-1">Lịch hẹn</span>
                    </a>
                    <div class="collapse " id="book">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> L </span>
                                    <span class="sidenav-normal"> Lịch hẹn </span>
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
                        <span class="nav-link-text ms-1">Phân quyền</span>
                    </a>
                    <div class="collapse " id="applicationsExamples">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('group.index') }}">
                                    <span class="sidenav-mini-icon"> N </span>
                                    <span class="sidenav-normal"> Nhóm </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('role.index') }}">
                                    <span class="sidenav-mini-icon"> V </span>
                                    <span class="sidenav-normal"> Vai trò </span>
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
                        <span class="nav-link-text ms-1">Hóa đơn</span>
                    </a>
                    <div class="collapse " id="ecommerceExamples">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> H </span>
                                    <span class="sidenav-normal"> Hóa đơn </span>
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
                        <span class="nav-link-text ms-1 ">Thuốc</span>
                    </a>
                    <div class="collapse " id="authExamples">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="">
                                    <span class="sidenav-mini-icon"> TT </span>
                                    <span class="sidenav-normal"> Toa thuốc </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('medicine.index') }}">
                                    <span class="sidenav-mini-icon"> T </span>
                                    <span class="sidenav-normal"> Thuốc </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('category.index') }}">
                                    <span class="sidenav-mini-icon"> L </span>
                                    <span class="sidenav-normal"> Loại thuốc </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('manufacturer.index') }}">
                                    <span class="sidenav-mini-icon"> NX </span>
                                    <span class="sidenav-normal"> Nhà sản xuất </span>
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
                        <span class="nav-link-text ms-1">Dịch vụ</span>
                    </a>
                    <div class="collapse " id="equipment">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('service.index') }}">
                                    <span class="sidenav-mini-icon"> D </span>
                                    <span class="sidenav-normal"> Dịch vụ </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#appointment" class="nav-link " aria-controls="appointment"
                        role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">

                            <i class="fa ni fa-solid fa-book-open text-sm opacity-10" style="color: #7a7a7a;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Phân công</span>
                    </a>
                    <div class="collapse " id="appointment">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('shift.index') }}">
                                    <span class="sidenav-mini-icon"> L </span>
                                    <span class="sidenav-normal"> Lương </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('room.index') }}">
                                    <span class="sidenav-mini-icon"> PC </span>
                                    <span class="sidenav-normal"> Phân công </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('shift.index') }}">
                                    <span class="sidenav-mini-icon"> C </span>
                                    <span class="sidenav-normal"> Ca làm việc </span>
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
                        <span class="nav-link-text ms-1">Trang thiết bị</span>
                    </a>
                    <div class="collapse " id="service">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('room.index') }}">
                                    <span class="sidenav-mini-icon"> p </span>
                                    <span class="sidenav-normal"> Phòng </span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('room.index') }}">
                                    <span class="sidenav-mini-icon"> TB </span>
                                    <span class="sidenav-normal"> Thiết bị y tế </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
