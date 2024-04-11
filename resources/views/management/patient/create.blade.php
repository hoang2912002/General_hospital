@extends('management.layout.main')
@include('management.layout.form')
@push('css')
    <style>
        input[type="file"] {
            display: block;
        }

        .imageThumb {
            height: auto;
            max-height: 130px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .remove:hover {
            background: white;
            color: black;
        }
    </style>
@endpush

@section('content')
    <div class="row mb-12" >
        <div class="col-12">
            <div class="multisteps-form mb-8">

                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="multisteps-form__progress">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">

                        <form class="multisteps-form__form mb-8 " action="{{ route('patient.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">Phiếu thêm bệnh nhân</h5>
                                <p class="mb-0 text-sm">Thông tin cá nhân</p>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Họ</label>
                                            <input class="multisteps-form__input form-control" type="text" placeholder="eg. Michael" name="first_name" value="{{ old('first_name') ?? '' }}">
                                            @error('first_name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Tên</label>
                                            <input class="multisteps-form__input form-control" type="text" placeholder="eg. Michael" name="last_name" value="{{ old('last_name') ?? '' }}">
                                            @error('last_name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Ngày sinh</label>
                                            <input class="multisteps-form__input form-control" type="date" name="birthdate">
                                            @error('birthdate')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>Giới tính</label>
                                            <select class="form-control" name="gender" id="choices-gender" >
                                                <option value="">Chọn giới tính...</option>
                                                <option value="1">Nam</option>
                                                <option value="0">Nữ</option>
                                            </select>
                                            @error('gender')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Địa chỉ email</label>
                                            <input class="multisteps-form__input form-control" type="email" placeholder="eg. argon@dashboard.com" name="email" value="{{ old('email') ?? '' }}">
                                            @error('email')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                            <label>Số điện thoại</label>
                                            <input id="phone" class="form-control" type="number" placeholder="+40 735 631 620" name="phone_number" value="{{ old('phone_number') ?? '' }}">
                                            @error('phone_number')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- vai trò của bệnh nhân --}}
                                        <input type="hidden" value="{{ $role->id }}" name="group">
                                        <input class="multisteps-form__input form-control" type="hidden" placeholder="******" name="password" value="123456">
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-auto  d-flex">
                                            <label class="form-check-label mb-0">
                                                <small id="profileVisibility" style="font-weight: bold">Thêm hồ sơ bệnh án</small>
                                            </label>
                                            <div class="form-check form-switch ms-2">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                id="btn-medical-record" name="">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- div toggle patient --}}
                                    <div class="div-medical-record" style="display:none">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Chiều cao</label>
                                                <input class="multisteps-form__input form-control" type="text" placeholder="160cm" name="height" value="{{ old('height') ?? '' }}">
                                                @error('height')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                                <label>Cân nặng</label>
                                                <input id="weight" class="form-control" type="text" placeholder="50kg" name="weight" value="{{ old('weight') ?? '' }}">
                                                @error('weight')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Tĩnh mạch</label>
                                                <input class="multisteps-form__input form-control" type="text" placeholder="100mmHg" name="vessel" value="{{ old('vessel') ?? '' }}">
                                                @error('vessel')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                                <label>Huyết áp</label>
                                                <input class="form-control" type="text" placeholder="100mmHg" name="blood_pressure" value="{{ old('blood_pressure') ?? '' }}">
                                                @error('blood_pressure')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Nhiệt độ</label>
                                                <input class="multisteps-form__input form-control" type="text" placeholder="37*C" name="temperature" value="{{ old('temperature') ?? '' }}">
                                                @error('temperature')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                                <label>Nguyên nhân</label>
                                                <input  class="form-control" type="text" placeholder="" name="reason" value="{{ old('reason') ?? '' }}">
                                                @error('reason')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Bệnh lý</label>
                                                <input class="multisteps-form__input form-control" type="text" placeholder="" name="disease" value="{{ old('disease') ?? '' }}">
                                                @error('disease')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                                <label>Ngày khám</label>
                                                <input class="form-control" type="date" placeholder="" name="date" value="{{ old('date') ?? '' }}">
                                                @error('date')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Ca khám</label>
                                                <select class="form-control" name="shift_id" id="shift" >
                                                    <option value="">Chọn ca khám ...</option>
                                                    @foreach ($shift as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('shift_id')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                                <label>Ngày tái khám</label>
                                                <input  class="form-control" type="date" placeholder="" name="re_exam_date" value="{{ old('re_exam_date') ?? '' }}">
                                                @error('re_exam_date')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label for="note" class="form-label">Ghi chú</label>
                                                <textarea class="form-control" id="note" rows="10" name="note">{{ old('note') }}</textarea>
                                            </div>
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
                                            type="submit" title="create">Thêm</button>
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
@push('js')
    {{-- <script src="{{ asset('asset/admin') }}/js/plugins/dropzone.min.js"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var drop = document.getElementById('avatar')
        var myDropzone = new Dropzone(drop, {
        url: "/file/post",
        addRemoveLinks: true

        }); --}}
    </script>
    <script>
        $('#btn-medical-record').on('click', function() {
            var option = $('#btn-medical-record');
            $('.div-medical-record').slideToggle();
        })

    </script>
@endpush
