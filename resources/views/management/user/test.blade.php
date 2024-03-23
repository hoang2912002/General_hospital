@extends('management.layout.main')
@include('management.layout.form')

@section('content')

        <div class="row">
            <div class="col-lg-6">
                <h4 class="text-white">Make the changes below</h4>
                <p class="text-white opacity-8">We’re constantly trying to express ourselves and actualize our dreams. If you
                    have the opportunity to play.</p>
            </div>
            <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
                <button type="button"
                    class="btn btn-outline-white mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">Save</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Ảnh đại diện</h5>
                        <div class="row">
                            <div class="col-12">
                                <img class="w-100 border-radius-lg shadow-lg mt-3"
                                    src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/product-page.jpg"
                                    alt="product_image">
                            </div>
                            <div class="col-12 mt-5">
                                <div class="d-flex">
                                    <button class="btn btn-primary btn-sm mb-0 me-2" type="button"
                                        name="button">Sửa</button>
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
                        <form action="{{ route('user.store') }}" method="POST">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">First Name</label>
                                    <div class="input-group">
                                        <input id="firstName" name="firstName" class="form-control" type="text"
                                            placeholder="Alec" required="required" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Last Name</label>
                                    <div class="input-group">
                                        <input id="lastName" name="lastName" class="form-control" type="text"
                                            placeholder="Thompson" required="required" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-6">
                                    <label class="form-label mt-4">I'm</label>
                                    <label>Gender</label>
                                    <select class="form-control" name="gender" id="choices-gender1" >
                                        <option value="">Choose gender ...</option>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                    @error('gender')
                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-8">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label mt-4">Email</label>
                                    <div class="input-group">
                                        <input id="email" name="email" class="form-control" type="email"
                                            placeholder="example@email.com" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label mt-4">Confirmation Email</label>
                                    <div class="input-group">
                                        <input id="confirmation" name="confirmation" class="form-control" type="email"
                                            placeholder="example@email.com" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label mt-4">Your location</label>
                                    <div class="input-group">
                                        <input id="location" name="location" class="form-control" type="text"
                                            placeholder="Sydney, A" onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label mt-4">Phone Number</label>
                                    <div class="input-group">
                                        <input id="phone" name="phone" class="form-control" type="number"
                                            placeholder="+40 735 631 620" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-12 text-right d-flex flex-column justify-content-end mt-4">
                                    <button type="button"
                                        class="btn bg-gradient-dark btn-sm  mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">Save</button>
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
                                    <span class="text-sm">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#basic-info">
                                    <i class=" ni ni-books me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Basic Info</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#password">
                                    <i class=" ni ni-atom me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Change Password</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#accounts">
                                    <i class=" ni ni-badge me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Accounts</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#notifications">
                                    <i class=" ni ni-bell-55 me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Notifications</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#sessions">
                                    <i class=" ni ni-watch-time me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Sessions</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#delete">
                                    <i class="ni ni-settings-gear-65 me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Delete Account</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 mt-sm-0 mt-4">
                    <div class="card">
                        <div class="card" id="password">
                            <div class="card-header">
                                <h5>Change Password</h5>
                            </div>
                            <div class="card-body pt-0">
                                <label class="form-label">Current password</label>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Current password"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                </div>
                                <label class="form-label">New password</label>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="New password"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                </div>
                                <label class="form-label">Confirm new password</label>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Confirm password"
                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                </div>
                                <h5 class="mt-5">Password requirements</h5>
                                <p class="text-muted mb-2">
                                    Please follow this guide for a strong password:
                                </p>
                                <ul class="text-muted ps-4 mb-0 float-start">
                                    <li>
                                        <span class="text-sm">One special characters</span>
                                    </li>
                                    <li>
                                        <span class="text-sm">Min 6 characters</span>
                                    </li>
                                    <li>
                                        <span class="text-sm">One number (2 are recommended)</span>
                                    </li>
                                    <li>
                                        <span class="text-sm">Change it often</span>
                                    </li>
                                </ul>
                                <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Update password</button>
                            </div>
                        </div>



                        <div class="card mt-4" id="accounts">
                            <div class="card-header">
                                <h5>Accounts</h5>
                                <p class="text-sm">Here you can setup and manage your integration settings.</p>
                            </div>
                            <div class="card-body pt-0">

                                <div class="ps-5 pt-3 ms-3">
                                    <p class="mb-0 text-sm">You haven't added your Slack yet or you aren't authorized. Please add
                                        our Slack Bot to your account by clicking on <a href="javascript">here</a>. When you've
                                        added the bot, send your verification code that you have received.</p>
                                    <div class="d-sm-flex bg-gray-100 border-radius-lg p-2 my-4">
                                        <p class="text-sm font-weight-bold my-auto ps-sm-2">Verification Code</p>
                                        <input class="form-control form-control-sm ms-sm-auto mt-sm-0 mt-2 w-sm-15 w-40"
                                            type="text" value="1172913" data-bs-toggle="tooltip" data-bs-placement="top"
                                            aria-label="Copy!" onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                    <div class="d-sm-flex bg-gray-100 border-radius-lg p-2 my-4">
                                        <p class="text-sm font-weight-bold my-auto ps-sm-2">Connected account</p>
                                        <h6 class="text-sm ms-auto me-3 my-auto">hello@creative-tim.com</h6>
                                        <button class="btn btn-sm bg-gradient-danger my-sm-auto mt-2 mb-0" type="button"
                                            name="button">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4" id="notifications">
                            <div class="card-header">
                                <h5>Notifications</h5>
                                <p class="text-sm">Choose how you receive notifications. These notification settings apply to the
                                    things you’re watching.</p>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th class="ps-1" colspan="4">
                                                    <p class="mb-0">Activity</p>
                                                </th>
                                                <th class="text-center">
                                                    <p class="mb-0">Email</p>
                                                </th>
                                                <th class="text-center">
                                                    <p class="mb-0">Push</p>
                                                </th>
                                                <th class="text-center">
                                                    <p class="mb-0">SMS</p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="ps-1" colspan="4">
                                                    <div class="my-auto">
                                                        <span class="text-dark d-block text-sm">Mentions</span>
                                                        <span class="text-xs font-weight-normal">Notify when another user mentions
                                                            you in a comment</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                        <input class="form-check-input" checked="" type="checkbox"
                                                            id="flexSwitchCheckDefault11">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckDefault12">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckDefault13">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-1" colspan="4">
                                                    <div class="my-auto">
                                                        <span class="text-dark d-block text-sm">Comments</span>
                                                        <span class="text-xs font-weight-normal">Notify when another user comments
                                                            your item.</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                        <input class="form-check-input" checked="" type="checkbox"
                                                            id="flexSwitchCheckDefault14">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                        <input class="form-check-input" checked="" type="checkbox"
                                                            id="flexSwitchCheckDefault15">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckDefault16">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-1" colspan="4">
                                                    <div class="my-auto">
                                                        <span class="text-dark d-block text-sm">Follows</span>
                                                        <span class="text-xs font-weight-normal">Notify when another user follows
                                                            you.</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckDefault17">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                        <input class="form-check-input" checked="" type="checkbox"
                                                            id="flexSwitchCheckDefault18">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckDefault19">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-1" colspan="4">
                                                    <div class="my-auto">
                                                        <p class="text-sm mb-0">Log in from a new device</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                        <input class="form-check-input" checked="" type="checkbox"
                                                            id="flexSwitchCheckDefault20">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                        <input class="form-check-input" checked="" type="checkbox"
                                                            id="flexSwitchCheckDefault21">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                        <input class="form-check-input" checked="" type="checkbox"
                                                            id="flexSwitchCheckDefault22">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4" id="sessions">
                            <div class="card-header pb-3">
                                <h5>Sessions</h5>
                                <p class="text-sm">This is a list of devices that have logged into your account. Remove those that
                                    you do not recognize.</p>
                            </div>
                            <div class="card-body pt-0">
                                <div class="d-flex align-items-center">
                                    <div class="text-center w-5">
                                        <i class="fas fa-desktop text-lg opacity-6" aria-hidden="true"></i>
                                    </div>
                                    <div class="my-auto ms-3">
                                        <div class="h-100">
                                            <p class="text-sm mb-1">
                                                Bucharest 68.133.163.201
                                            </p>
                                            <p class="mb-0 text-xs">
                                                Your current session
                                            </p>
                                        </div>
                                    </div>
                                    <span class="badge badge-success badge-sm my-auto ms-auto me-3">Active</span>
                                    <p class="text-secondary text-sm my-auto me-3">EU</p>
                                    <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                                        <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <hr class="horizontal dark">
                                <div class="d-flex align-items-center">
                                    <div class="text-center w-5">
                                        <i class="fas fa-desktop text-lg opacity-6" aria-hidden="true"></i>
                                    </div>
                                    <p class="my-auto ms-3">Chrome on macOS</p>
                                    <p class="text-secondary text-sm ms-auto my-auto me-3">US</p>
                                    <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                                        <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <hr class="horizontal dark">
                                <div class="d-flex align-items-center">
                                    <div class="text-center w-5">
                                        <i class="fas fa-mobile text-lg opacity-6" aria-hidden="true"></i>
                                    </div>
                                    <p class="my-auto ms-3">Safari on iPhone</p>
                                    <p class="text-secondary text-sm ms-auto my-auto me-3">US</p>
                                    <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                                        <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4" id="delete">
                            <div class="card-header">
                                <h5>Delete Account</h5>
                                <p class="text-sm mb-0">Once you delete your account, there is no going back. Please be certain.
                                </p>
                            </div>
                            <div class="card-body d-sm-flex pt-0">
                                <div class="d-flex align-items-center mb-sm-0 mb-4">
                                    <div>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault0">
                                        </div>
                                    </div>
                                    <div class="ms-2">
                                        <span class="text-dark font-weight-bold d-block text-sm">Confirm</span>
                                        <span class="text-xs d-block">I want to delete my account.</span>
                                    </div>
                                </div>
                                <button class="btn btn-outline-secondary mb-0 ms-auto" type="button"
                                    name="button">Deactivate</button>
                                <button class="btn bg-gradient-danger mb-0 ms-2" type="button" name="button">Delete
                                    Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@push('js')

@endpush
