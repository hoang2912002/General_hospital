
<link rel="stylesheet" href="{{ asset('asset/admin') }}/css/prescription.css">
<style>
    .card-header{
        display: flex;
        justify-content: space-between;
    }
    .sub-div{
        display: flex;
        justify-content: flex-end;
    }
    .mb-0{
        margin-bottom: 0;
    }
    .mt-0{
        margin-top: 0;
    }
    .mt-2{
        margin-top: 2px;
    }
    .mb-2{
        margin-bottom: 2px;
    }
    .mb-10{
        margin-bottom: 10px;
    }
    .mt-10{
        margin-top: 10px;
    }
    p{
        
        font-weight: 400;
        font-size: 1.1rem;
    }
    .pb-0{
        padding-bottom: 0
    }
    .mr-10{
        margin-right: 10px
    }
    .justify-center{
        min-width: 250px;
        display: grid;
        justify-content: center;
    }
    .div{
        width: auto;
    }
</style>
<style>
    *{ font-family: DejaVu Sans !important;}
</style>
<div class="row mb-5">

    <div class="col-lg-10 mt-lg-0 mt-4">
        <div class="card">
            <div class="card-header pb-0">
                <div>
                    <div class="logo">
                    <img class="logo_img" src="{{ asset('img/general_hospital/management') }}/logo/general_g37_logo1.png" alt="">
                    </div>
                    <p class="mb-0 mt-2">Bệnh nhân: {{ ($userModel->first_name . ' ' . $userModel->last_name) ?? '' }}</p></h5>
                    <p class="mb-0 mt-2">Giới tính: {{ (($userModel->gender == 1) ? 'Nam' : 'Nữ') ?? ''  }}</p>
                    <p class="mb-0 mt-2">Năm sinh: {{ ($userModel->dob()) ?? '' }} </p>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto d-grid" style="justify-items: end;">
                        <h3 class="mb-10 mt-10">Bác sĩ: {{ Auth::user()->user->first_name . ' ' . Auth::user()->user->last_name }}</h3>
                        <p class="mb-0 mt-2">Khoa:fsdfsdf</p>
                        <p class="mb-0 mt-2">Số điện thoại: {{ Auth::user()->phone_number  }}</p>
                        <p class="mb-0 mt-2">Thứ 2 đến Thứ 7</p>

                    </div>
                </div>

            </div>
            <hr class="hr mt-1">
            <div class="card-header pb-0 mt-0">
                <p class=" mb-0 mt-0">Ngày khám: {{ $medical_recordModel->shift() ?? '' }}  {{ '- '. $medical_recordModel->date($medical_recordModel->exam_date) ?? '' }}</p>
                <p class=" mb-0 mt-0">Tái khám: {{ $medical_recordModel->date($medical_recordModel->re_exam_date) ?? '' }}</p>
            </div>
            <hr class="hr mb-2">

            <div class="card-body pt-0">
                <div class="card-header">

                    <div class="col-lg-4 ">
                        <div class="pb-0"></div>
                        @if (!empty($medical_recordModel->reason))
                            <h3 class="mb-0">Triệu chứng:</h3>
                            <p class=" mb-2 mt-2">{{ $medical_recordModel->reason }}

                            </p>

                        @endif
                        @if (!empty($medical_recordModel->disease))
                            <h3 class="mb-0">Bệnh lý:</h3>
                            <p class=" mb-2 mt-2">{{ $medical_recordModel->disease }}
                            </p>

                        @endif
                        <br>
                        @if (!empty($medical_recordModel->re_exam_date))
                            <h3 class="mb-0">Dặn dò:</h3>
                            <p class=" mb-2 mt-2">{{ $medical_recordModel->note }}
                            </p>

                        @endif
                    </div>
                    <div class="col-lg-1" style="width: 3px !important; ">
                        <hr class="vertical-line">
                    </div>
                    <div class="">
                        <div class="pb-3"></div>
                        <div class="div">
                            @if (!empty($prescription))
                                <h3 class="mb-0">Thuốc</h3>
                                @foreach ($prescription->prescription_detail as $index => $prescription_detail)
                                    <p class=" mb-2 mt-2">{{ $index+1  }}. {{  $prescription_detail->medicine->name }}
                                    </p>
                                    <p class=" mb-2 mt-2">Số lượng: {{ $prescription_detail->quantity ?? '' }}</p>
                                    <p class=" mb-2 mt-2">{!! html_entity_decode( $prescription_detail->note) !!}</p>
                                @endforeach

                            @endif
                        </div>

                    </div>
                </div>
                @if (!empty($prescription))
                    <div class="sub-div mr-10">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-1" style="width: 3px !important; ">
                        </div>
                        <div class="">
                            <div class="justify-center">
                                <div class="div"><h2>Tổng tiền: {{ $prescription->price() }}</h2></div>
                                <div class="div"><p class="">Đa khoa G37,ngày{{ $medical_recordModel->current_date() }}</p></div>
                                <div class="div" style="display: flex;justify-content: center"><h2 class="mt-0">Bác sĩ ký tên</h2></div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="div" style="display: flex;justify-content: center"><p>{{ $medical_recordModel->doctor->name() }}</p></div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>



