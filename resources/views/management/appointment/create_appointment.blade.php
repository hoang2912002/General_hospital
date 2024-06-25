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
                                    <button class="multisteps-form__progress-btn js-active" type="button"
                                        title="User Info">
                                        <span>Thông tin lịch hẹn</span>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">

                        <form class="multisteps-form__form mb-8 " action="{{ route('appointment.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">Thêm lịch hẹn</h5>
                                <p class="mb-0 text-sm">Thông tin lịch hẹn</p>
                                <div class="multisteps-form__content">
                                    {{-- Status --}}
                                    <input class="multisteps-form__input form-control" type="hidden"  name="status" value="2">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <label>UUID</label>
                                            <input class="multisteps-form__input form-control" type="text" placeholder="Nguyễn Văn" id="user_uuid" name="user_uuid" value="{{ $userModel->uuid ?? old('user_uuid') }}" readonly>
                                            @error('last_name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Họ</label>
                                            <input class="multisteps-form__input form-control" type="text" placeholder="Nguyễn Văn" id="last_name" name="last_name" value="{{  $userModel->last_name ?? old('last_name')  }}">
                                            @error('last_name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Tên</label>
                                            <input class="multisteps-form__input form-control" type="text" placeholder="A" id="first_name" name="first_name" value="{{ $userModel->first_name ?? old('first_name')  }}">
                                            @error('first_name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Ngày sinh</label>
                                            <input class="multisteps-form__input form-control" type="date" name="dob" id="dob" value="{{ $userModel->dob ?? old('dob')  }}">
                                            @error('dob')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>Giới tính</label>
                                            <select class="form-control" name="gender" id="choices-gender" >
                                                <option value="">Chọn giới tính ...</option>
                                                <option value="1" @if ($userModel->gender === 1)@selected(true)@endif>Nam</option>
                                                <option value="0" @if ($userModel->gender === 0)@selected(true)@endif>Nữ</option>
                                            </select>
                                            @error('gender')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                            <label>Số điện thoại</label>
                                            <input class="form-control" type="number" id="phone_number" placeholder="+40 735 631 620" name="phone_number" value="{{ $userModel->login->phone_number ?? old('phone_number')  }}">
                                            @error('phone_number')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Địa chỉ email</label>
                                            <input class="multisteps-form__input form-control" type="email" placeholder="eg. argon@dashboard.com" id="email" name="email" value="{{ $userModel->login->email ?? old('email')  }}">
                                            @error('email')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>CCCD/CMND</label>
                                            @if (!empty($userModel->patients_identification->all()))
                                                <select class="form-control" name="patient_identification_code" id="choices-file" >
                                                    <option value="">Chọn CCCD/CMND ...</option>
                                                    @foreach ($userModel->patients_identification as $item)
                                                        <option value="{{  $item->patient_identification_code  }}">{{ $item->patient_identification_code ?? old('patient_identification_code')  }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <input class="multisteps-form__input form-control" type="text" placeholder="" id="patient_identification_code"
                                                name="patient_identification_code" value="{{ old('patient_identification_code') ?? '' }}">
                                            @endif


                                            @error('patient_identification_code')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>Bác sĩ</label>
                                            <select class="form-control" name="doctor_uuid" id="choices-doctor" >
                                                <option value="">Chọn bác sĩ ...</option>
                                                @foreach ($doctors as $item)
                                                    <option value="{{ $item->uuid }}">{{ $item->name() }}</option>
                                                @endforeach
                                            </select>
                                            @error('doctor_uuid')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Ca</label>
                                            <select class="form-control" name="shift_id" id="shift1" >
                                                <option value="">Chọn ca khám</option>
                                                @foreach ($shifts as $item)
                                                    <option value="{{ $item->id }}">{{ $item->hour_flw_slug($item->slug) }}</option>
                                                @endforeach
                                            </select>
                                            @error('shift_id')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>Ngày khám</label>
                                            <input class="multisteps-form__input form-control" type="date" placeholder="eg. argon@dashboard.com" id="date" name="date" value="{{ old('date') ?? ''  }}">
                                            @error('date')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <label>
                                                Ghi chú
                                            </label>
                                            <textarea class="multisteps-form__input form-control" name="note" id="note" cols="30" rows="10"></textarea>
                                            @error('note')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-auto  d-flex">
                                            <label class="form-check-label mb-0">
                                                <small id="profileVisibility">Kích hoạt</small>
                                            </label>
                                            <div class="form-check form-switch ms-2">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked="" onchange="visible()" name="activated" value="1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" id="user-create"
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
    <script>
        $(document).ready(function () {
            $("#choices-doctor").on('change',function(){
                var doctor_uuid = this.value;
                $.ajax({
                    type: "POST",
                    url: '{{ route('appointment.api_choose_doctor') }}',
                    data: {
                        doctor_uuid: doctor_uuid,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $('#shift1').empty();
                        if (Object.keys(response.arr_shifts).length > 0) {
                            $('#shift1').append('<option value="">Chọn ca khám</option>');
                            $.each(response.arr_shifts, function(key, value) {
                                console.log(key, value);
                                $('#shift1').append('<option value="' + key + '">' + value + '</option>');
                            });
                        } else {
                            console.log(1);
                            $('#shift1').append('<option value="">Không có ca làm việc</option>');
                        }
                    },
                });
            })
        });
    </script>
@endpush
