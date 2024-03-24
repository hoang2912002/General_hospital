@extends('management.layout.main')
@include('management.layout.form')
@push('css')
<style>
    .footer {
        position: fixed;
        bottom: 0;

        width: 100%;
        padding: 10px;
    }
</style>
@endpush
@section('content')
    <div class="row mb-5">
        <div class="col-12">
            <div class="multisteps-form mb-5">

                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="multisteps-form__progress">
                                    <button class="multisteps-form__progress-btn js-active" type="button"
                                        title="User Info">
                                        <span>{{ $name_page['total'] }} Information</span>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">

                        <form class="multisteps-form__form mb-8 " action="{{ route('manufacturer.update',$manufacturerModel) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">Cập nhập nhà sản xuất</h5>
                                <p class="mb-0 text-sm">Cập nhập thông tin</p>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Tên nhà sản xuất</label>
                                            <input class="multisteps-form__input form-control" type="text" placeholder="eg. Michael" name="name" value="{{ $manufacturerModel->name ?? old('name') }}">
                                            @error('name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Nước sản xuất</label>
                                            <input class="multisteps-form__input form-control" type="text" placeholder="eg. Michael" name="address" value="{{ $manufacturerModel->address ?? old('address')  }}">
                                            @error('address')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                            <label>Số điện thoại</label>
                                            <input id="phone" class="form-control" type="number" placeholder="+40 735 631 620" name="phone_number" value="{{ $manufacturerModel->phone_number ?? old('phone_number')  }}">
                                            @error('phone_number')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Địa chỉ Email</label>
                                            <input class="multisteps-form__input form-control" type="email" placeholder="eg. argon@dashboard.com" name="email" value="{{ $manufacturerModel->email ?? old('email')  }}">
                                            @error('email')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-auto  d-flex">
                                            <label class="form-check-label mb-0">
                                                <small id="profileVisibility">Activated</small>
                                            </label>
                                            <div class="form-check form-switch ms-2">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked="" onchange="visible()" name="activated" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                            type="submit" title="create">Cập nhật</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
