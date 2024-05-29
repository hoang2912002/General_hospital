@extends('management.layout.main')
@include('management.layout.form')
@push('css')
    <style>
        .img-responsive {
            max-width: 100%;
            max-height: 100%;
            height: auto;
            width: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endpush
@section('content')


        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Ảnh đại diện</h5>
                        <div class="row">
                            <div class="col-12 d-flex ">
                                <img class="img-responsive border-radius-lg shadow-lg mt-3"
                                    src="{{ (!empty(Auth::user()->User->staff->image)) ? asset(Auth::user()->User->staff->image) : 'https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/product-page.jpg' }}"
                                    alt="product_image">
                            </div>
                            <div class="col-12 mt-4">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary btn-sm mb-0 me-2"data-bs-toggle="modal" data-bs-target="#import">Sửa</button>&nbsp;
                                    <div class="modal fade" id="import" tabindex="-1" style="display: none;"aria-hidden="true">
                                        <div class="modal-dialog mt-lg-10">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalLabel">Thêm ảnh đại diện</h5>
                                                    <i class="fas fa-upload ms-3" aria-hidden="true"></i>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                {{-- import data user --}}
                                                <form action="{{route('user.update_image',Auth::user()->User->uuid)}}" method="POST" enctype="multipart/form-data" >
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <p>Thêm ảnh từ máy của bạn vào đây.</p>
                                                        <input type="file" placeholder="Browse file..."class="form-control mb-3" name="image">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"class="btn bg-gradient-secondary btn-sm"data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit"class="btn bg-gradient-primary btn-sm" name="import_excel">Sửa</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-dark btn-sm mb-0" type="button"
                                        name="button">Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card " id="basic-info">
                    <div class="card-header">
                        <h5>Thông tin cá nhân</h5>
                    </div>
                    <div class="card-body pt-0">
                        <form action="{{ route('user.update_private',Auth::user()->User->uuid) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label ">UUID</label>
                                    <div class="input-group">
                                        <input id="location" name="uuid" class="form-control" type="text"
                                            placeholder="Sydney, A" onfocus="focused(this)" onfocusout="defocused(this)" value="{{ Auth::user()->User->uuid }}" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label ">Vai trò</label>
                                    <div class="input-group">
                                        <input id="location" name="group_user" class="form-control" type="text"
                                            placeholder="Sydney, A" onfocus="focused(this)" onfocusout="defocused(this)" value="{{ Auth::user()->User->group_user[0]->name ?? '' }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Họ</label>
                                    <div class="input-group">
                                        <input id="last_name" name="last_name" class="form-control" type="text"
                                            placeholder="Alec" required="required" onfocus="focused(this)"
                                            onfocusout="defocused(this)" value="{{ Auth::user()->User->last_name }}">
                                    </div>
                                    @error('last_name')
                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Tên</label>
                                    <div class="input-group">
                                        <input id="first_name" name="first_name" class="form-control" type="text"
                                            placeholder="Thompson" required="required" onfocus="focused(this)"
                                            onfocusout="defocused(this)" value="{{ Auth::user()->User->first_name }}">
                                    </div>
                                    @error('first_name')
                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label mt-4">Giới tính</label>
                                    <select class="form-control" name="gender" id="choices-gender1" >
                                        <option value="">Chọn giới tính ...</option>
                                        <option @if (Auth::user()->User->gender === 1)@selected(true)@endif value="1">Nam</option>
                                        <option @if (Auth::user()->User->gender === 0)@selected(true)@endif value="0">Nữ</option>
                                    </select>
                                    @error('gender')
                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label mt-4">Ngày sinh</label>
                                    <div class="input-group">
                                        <input id="confirmation" name="dob" class="form-control" type="date"
                                            placeholder="example@email.com" onfocus="focused(this)"
                                            onfocusout="defocused(this)" value="{{ Auth::user()->User->dob }}">
                                    </div>
                                    @error('dob')
                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label mt-4">Email</label>
                                    <div class="input-group">
                                        <input id="email" name="email" class="form-control" type="email"
                                            placeholder="example@email.com" onfocus="focused(this)"
                                            onfocusout="defocused(this)"  value="{{ Auth::user()->email }}">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label mt-4">Số điện thoại</label>
                                    <div class="input-group">
                                        <input id="confirmation" name="phone_number" class="form-control" type="number"
                                            placeholder="0987654321" onfocus="focused(this)"
                                            onfocusout="defocused(this)"  value="{{ Auth::user()->phone_number }}">
                                    </div>
                                    @error('phone_number')
                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-12 text-right d-flex flex-column justify-content-end mt-4">
                                    <button type="submit"
                                        class="btn bg-gradient-dark btn-sm  mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">Lưu</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="container-fluid ">
            <div class="row mt-4">
                <div class="col-sm-4">
                    <div class="card position-sticky top-1">
                        <ul class="nav flex-column bg-white border-radius-lg p-3">
                            <li class="nav-item">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#profile">
                                    <i class="ni ni-spaceship me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Hồ sơ</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#basic-info">
                                    <i class=" ni ni-books me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Thông tin cơ bản</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#password">
                                    <i class=" ni ni-atom me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Thay đổi mật khẩu</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#accounts">
                                    <i class=" ni ni-badge me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Tài khoản</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#delete">
                                    <i class="ni ni-settings-gear-65 me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Xóa tài khoản</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 mt-sm-0 mt-4">
                    <div class="card">
                        <div class="card" id="password">
                            <div class="card-header">
                                <h5>Thay đổi mật khẩu</h5>
                            </div>
                            <div class="card-body pt-0">
                                <form action="{{ route('user.update_password',Auth::user()->User->uuid) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <label class="form-label">Mật khẩu hiện tại</label>
                                    <div class="form-group">
                                        <input class="form-control" type="password" placeholder="Current password"
                                            onfocus="focused(this)" onfocusout="defocused(this)" name="old_password" value="{{ old('old_password')}}">
                                    </div>
                                    @error('old_password')
                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label class="form-label">Mật khẩu mới</label>
                                    <div class="form-group">
                                        <input class="form-control" type="password" placeholder="New password"
                                            onfocus="focused(this)" onfocusout="defocused(this)" name="password"  value="{{ old('password')}}">
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label class="form-label">Nhập lại mật khẩu mới</label>
                                    <div class="form-group">
                                        <input class="form-control" type="password" placeholder="Confirm password"
                                            onfocus="focused(this)" onfocusout="defocused(this)" name="confirm_password"  value="{{ old('confirm_password')}}">
                                    </div>
                                    @error('confirm_password')
                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <h5 class="mt-5">Password requirements</h5>
                                    <p class="text-muted mb-2">
                                        Vui lòng làm theo hướng dẫn này để có mật khẩu mạnh:
                                    </p>
                                    <ul class="text-muted ps-4 mb-0 float-start">
                                        <li>
                                            <span class="text-sm">Một ký tự đặc biệt</span>
                                        </li>
                                        <li>
                                            <span class="text-sm">Tối thiểu 6 ký tự</span>
                                        </li>
                                        <li>
                                            <span class="text-sm">Một số (khuyên dùng 2)</span>
                                        </li>
                                        <li>
                                            <span class="text-sm">Thay đổi nó thường xuyên</span>
                                        </li>
                                    </ul>
                                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Cập nhập mật khẩu</button>
                                </form>
                            </div>
                        </div>





                    </div>
                </div>
            </div>
        </div>

@endsection
@push('js')

@endpush
