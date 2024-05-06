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

                        <form class="multisteps-form__form mb-8 " action="{{ route('patient.update',$userModel) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">Phiếu sửa thông tin bệnh nhân</h5>
                                <p class="mb-0 text-sm">Thông tin cá nhân</p>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Họ</label>
                                            <input class="multisteps-form__input form-control" type="text" placeholder="eg. Michael" name="first_name" value="{{ $userModel->first_name ?? old('first_name') }}">
                                            @error('first_name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Tên</label>
                                            <input class="multisteps-form__input form-control" type="text" placeholder="eg. Michael" name="last_name" value="{{$userModel->last_name ?? old('last_name')  }}">
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
                                            <input class="multisteps-form__input form-control" type="date" name="birthdate" value="{{ $userModel->dob ?? old('birthdate') }}">
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
                                                <option value="1" @if ($userModel->gender === 1)
                                                    @selected(true)
                                                @endif>Nam</option>
                                                <option value="0" @if ($userModel->gender === 0)
                                                    @selected(true)
                                                @endif>Nữ</option>
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
                                            <input class="multisteps-form__input form-control" type="email" placeholder="eg. argon@dashboard.com" name="email" value="{{ $userModel->login->email ?? old('email') }}">
                                            @error('email')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                            <label>Số điện thoại</label>
                                            <input id="phone" class="form-control" type="number" placeholder="+40 735 631 620" name="phone_number" value="{{ $userModel->login->phone_number ?? old('phone_number')  }}">
                                            @error('phone_number')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- vai trò của bệnh nhân --}}
                                        <input type="hidden" value="{{ $role->id }}" name="group">
                                        <input type="hidden" value="{{ $userModel->uuid }}" name="uuid">
                                        <input class="multisteps-form__input form-control" type="hidden" placeholder="******" name="password" value="">
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
                                                <input class="multisteps-form__input form-control" type="text" placeholder="160cm" name="height" value="{{ $userModel->medical_record[0]->height ?? old('height')  }}">
                                                @error('height')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                                <label>Cân nặng</label>
                                                <input id="weight" class="form-control" type="text" placeholder="50kg" name="weight" value="{{ $userModel->medical_record[0]->weight ?? old('weight') }}">
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
                                                <input class="multisteps-form__input form-control" type="text" placeholder="100mmHg" name="vessel" value="{{ $userModel->medical_record[0]->vessel ?? old('vessel') }}">
                                                @error('vessel')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                                <label>Huyết áp</label>
                                                <input class="form-control" type="text" placeholder="100mmHg" name="blood_pressure" value="{{$userModel->medical_record[0]->blood_pressure ?? old('blood_pressure')}}">
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
                                                <input class="multisteps-form__input form-control" type="text" placeholder="37*C" name="temperature" value="{{$userModel->medical_record[0]->temperature ?? old('temperature')}}">
                                                @error('temperature')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                                <label>Nguyên nhân</label>
                                                <input  class="form-control" type="text" placeholder="" name="reason" value="{{$userModel->medical_record[0]->reason ?? old('reason')}}">
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
                                                <input class="multisteps-form__input form-control" type="text" placeholder="" name="disease" value="{{$userModel->medical_record[0]->disease ?? old('disease')}}">
                                                @error('disease')
                                                    <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                                <label>Ngày khám</label>
                                                <input class="form-control" type="date" placeholder="" name="date" value="{{$userModel->medical_record[0]->date ?? old('date')}}">
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
                                                        <option value="{{ $item->id }}" @if ($item->id === $userModel->medical_record[0]->shift_id)
                                                            @selected(true)
                                                        @endif>{{ $item->name }}</option>
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
                                                <input  class="form-control" type="date" placeholder="" name="re_exam_date" value="{{$userModel->medical_record[0]->re_exam_date ?? old('re_exam_date')}}">
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
                                                <textarea class="form-control" id="note" rows="10" name="note">{{$userModel->medical_record[0]->note ?? old('note') }}</textarea>
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
@push('js')
    {{-- <script src="{{ asset('asset/admin') }}/js/plugins/dropzone.min.js"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var drop = document.getElementById('avatar')
        var myDropzone = new Dropzone(drop, {
        url: "/file/post",
        addRemoveLinks: true

        });
    </script> --}}
    <script>
        $('#btn-medical-record').on('click', function() {
            var option = $('#btn-medical-record');
            $('.div-medical-record').slideToggle();
        })

    </script>
@endpush
