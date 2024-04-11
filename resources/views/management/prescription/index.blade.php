@extends('management.layout.main')
@include('management.layout.form')
@push('css')
    <style>
        .modal-dialog-centered {
            align-items: center !important;
            flex-direction: column !important
        }

        /* .modal {
                --bs-modal-width: a !important;
            } */

        #modal-form .modal-dialog {
            width: 100%;
            max-width: 100%;
            margin: auto;
            margin-right: 10%;
            /* Dịch sang phải một ít */
        }

        @media (min-width: 576px) {
            #modal-form .modal-dialog {
                max-width: 66.66667%;
                /* 66.66667% of the viewport width for col-8 */
            }
        }
        .hr{
            border: 1px solid black !important;
            margin: 1px
        }
        .logo{
            width: 100%;
            height: 30px;
            display: flex;
            align-items: center;
        }
        .logo_img{
            width: ;
            height: 100%;
            display: flex;
            align-content: center
        }
        .button_index{
            max-width:  250.39px;
            min-width:  250.39px;
            max-height: 41px;
            min-height: 41px;
            font-size: 15px !important;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .button_index>i{
            margin-right:10px !important
        }
        .vertical-line {
        height: 500px; /* Chiều cao của đường kẻ */
        border-left: 2px solid black; /* Đường kẻ đứng */
        margin: 1px; /* Khoảng cách từ lề trái và phải */
        margin-bottom: 20px
    }
    </style>
@endpush
@section('content')
    <div class="row mb-5">
        <div class="col-lg-2">
            <div class="card position-sticky top-1">
                <ul class="nav flex-column bg-white border-radius-lg p-3  d-flex align-content-center">
                    <li class="nav-item">
                        <button type="button" class="btn btn-outline-secondary mb-3 button_index"><i class="fa ni fa-solid fa-print "></i>In</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-outline-gradient-info mb-3 button_index" >Ẩn tiêu đề</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-outline-danger mb-3 button_index">Triệu chứng</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-outline-warning mb-3 button_index " >Thông tin cá nhân</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-outline-success mb-3 button_index " >Kết quả xét nghiệm</button></button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-outline-primary  mb-3 button_index " data-bs-toggle="modal" data-bs-target="#modal-form"><i class="fa ni fa-solid fa-capsules text-sm"></i> Thuốc</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-10 mt-lg-0 mt-4">
            <div class="card">
                <div class="card-header  d-flex justify-content-between pb-0">
                    <div>
                        <div class="logo">
                        <img class="logo_img" src="{{ asset('img/general_hospital/management') }}/logo/general_g37_logo1.png" alt="">
                        </div>
                        <p class="mb-0">Bệnh nhân: {{ $userModel->first_name . ' ' . $userModel->last_name }}</p></h5>
                        <p class="mb-0">Giới tính: {{ ($userModel->gender == 1) ? 'Nam' : 'Nữ'  }}</p>
                        <p class="mb-0">Năm sinh: {{ $userModel->dob() }} </p>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto d-grid" style="justify-items: end;">
                            <h5>Bác sĩ: {{ Auth::user()->user->first_name . ' ' . Auth::user()->user->last_name }}</h5>
                            <p class="mb-0">Khoa:fsdfsdf</p>
                            <p class="mb-0">Số điện thoại: {{ Auth::user()->phone_number  }}</p>
                            <p class="mb-0">Thứ 2 đến Thứ 7</p>

                        </div>
                    </div>

                </div>
                <hr class="hr mt-1">
                <div class=" pb-0 mt-0 d-flex justify-content-between" style="padding: 0 1.5rem">
                    <p class=" mb-0 ml-1">Giờ khám:</p>
                    <p class=" mb-0 ml-1">Khoa:fsdfsdf</p>
                </div>
                <hr class="hr mb-2">

                <div class="card-body pt-0">
                    <div class="row">

                        <div class="col-lg-4 ">
                            <div class="pb-3"></div>
                            <h6>Triệu chứng</h6>
                        </div>
                        <div class="col-lg-1" style="width: 3px !important; ">
                            <hr class="vertical-line">
                        </div>
                        <div class="col-lg-7">
                            <div class="pb-3"></div>
                            <h6>Thuốc</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal medicine --}}
    @include('management.prescription.modal_medicine_form')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mt-8" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-gradient-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
