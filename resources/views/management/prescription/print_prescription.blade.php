
<link rel="stylesheet" href="{{ asset('asset/admin') }}/css/prescription.css">
<style>
    /* .card-header{
        display: flex;
        justify-content: space-between;
    } */
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
    .mt-5{
        margin-top: 5px;
    }
    .mb-5{
        margin-bottom: 5px;
    }
    .mb-10{
        margin-bottom: 10px;
    }
    .mt-10{
        margin-top: 10px;
    }
    p{

        font-weight: 400;
        font-size:16px;
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
    .page-break {
        page-break-before: always;
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
                    <hr class="hr mb-5 mt-5">
                    <h4 class="mb-0 mt-2">Bệnh nhân: {{ ($userModel->first_name . ' ' . $userModel->last_name) ?? '' }}</h4>
                    <p class="mb-0 mt-2">Giới tính: {{ (($userModel->gender == 1) ? 'Nam' : 'Nữ') ?? ''  }}</p>
                    <p class="mb-0 mt-2">Năm sinh: {{ ($userModel->dob()) ?? '' }} </p>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto d-grid" style="justify-items: end;">
                        <h4 class="mb-10 mt-10">Bác sĩ: {{ Auth::user()->user->first_name . ' ' . Auth::user()->user->last_name }}</h4>
                        <p class="mb-0 mt-2">Khoa:fsdfsdf</p>
                        <p class="mb-0 mt-2">Số điện thoại: {{ Auth::user()->phone_number  }}</p>
                        <p class="mb-0 mt-2">Thứ 2 đến Thứ 7</p>

                    </div>
                </div>

            </div>
            <hr class="hr mb-5 mt-5">
            <div class="pb-0 mt-0">
                <span class=" mb-0 mt-0">Ngày khám: {{ $medical_recordModel->shift() ?? '' }}  {{ '- '. $medical_recordModel->date($medical_recordModel->exam_date) ?? '' }}</span>

                <span class=" mb-0 mt-0" > - Tái khám:{{ $medical_recordModel->date($medical_recordModel->re_exam_date) ?? '' }}</span>
            </div>
            <hr class="hr mb-0">
            <h3  class="mt-10 mb-5">B: Chuẩn đoán</h3>
            <div class="pt-0">
                <div class="">
                    <div class="">
                        <div class="pb-0"></div>
                        @if (!empty($medical_recordModel->reason))
                            <p class="mb-5 mt-0">Triệu chứng: {{ $medical_recordModel->reason }}</p>


                        @endif
                        @if (!empty($medical_recordModel->disease))
                            <p class="mb-5 mt-2">Bệnh lý: {{ $medical_recordModel->disease }}</p>


                        @endif
                        @if (!empty($medical_recordModel->re_exam_date))
                            <p class="mb-5 mt-2">Dặn dò: {{ $medical_recordModel->note }}</p>

                        @endif
                    </div>
                    <hr class="hr mb-2">
                    <h3 class="mt-10 mb-5">C: Toa thuốc</h3>
                    <div class="">
                        <div class="pb-3"></div>
                        <div class="div">
                            @if (!empty($prescription))

                                @foreach ($prescription->prescription_detail as $index => $prescription_detail)
                                    <p class=" mb-2 mt-2">{{ $index+1  }}. {{  $prescription_detail->medicine->name }}
                                    </p>
                                    <span class=" mb-2 mt-2" style="margin-left: 15px">Số lượng: {{ $prescription_detail->quantity ?? '' }}</span>
                                    <div class="" style="padding-left: 15px">
                                        <span class=" mb-2 mt-2" >{!! html_entity_decode( $prescription_detail->note) !!}</span>
                                    </div>
                                @endforeach

                            @endif
                        </div>

                    </div>
                </div>
                @if (!empty($prescription))
                    <div class="page-break"></div>
                    <div class="" style="margin-left: 65%">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-1" style="width: 3px !important; ">
                        </div>
                        <div class="">
                            <div class="">
                                <div class="div" style="padding:0%;"><p class="">Đa khoa G37,ngày{{ $medical_recordModel->current_date() }}</p></div>
                                <div class="div" style="padding-left: 25%;"><h4 class="mt-0">Bác sĩ ký tên</h4></div>
                                    <br>
                                    <br>
                                <div class="div" style="padding-left: 18%;"><p>{{ $medical_recordModel->doctor->name() }}</p></div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>



