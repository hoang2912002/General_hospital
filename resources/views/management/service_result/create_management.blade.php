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

                        <form class="multisteps-form__form mb-8 " action="{{ route('medical_record_management.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">Kết quả dịch vụ</h5>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Bệnh nhân</label>
                                            <select class="form-control" name="user_uuid" id="choices-role" >
                                                <option value="">Chọn bệnh nhân ...</option>
                                                @foreach ($patients as $item)
                                                    <option value="{{ $item->uuid }}" >{{ $item->name() }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_uuid')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Bác sĩ</label>
                                            <select class="form-control" name="doctor_uuid" id="choices-manufacturer" >
                                                <option value="">Chọn bác sĩ ...</option>
                                                @foreach ($doctors as $item)
                                                    <option value="{{ $item->uuid }}" >{{ $item->name() }}</option>
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
                                                <input class="form-control" type="date" placeholder="" name="exam_date" value="{{ old('exam_date') ?? date('Y-m-d') }}">
                                                @error('exam_date')
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
                                                    @foreach ($shifts as $item)
                                                        <option value="{{ $item->id }}">{{ $item->hour() }}</option>
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

@endpush
