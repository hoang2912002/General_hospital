@extends('management.layout.main')
@include('management.layout.table')
@push('css')
<link rel="stylesheet" href="{{ asset('asset/admin') }}/css/prescription.css">
    <style>
        .footer {
            position: fixed;
            bottom: 0;

            width: 100%;
            padding: 10px;
        }

    </style>
    <style>
        #cam2 {
            display: none;
        }
    </style>
@endpush
@section('content')
    <div class="row mb-lg-5">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex pb-0 p-3">
                    <h6 class="my-auto">Hóa đơn chi tiết</h6>

                    <div class="nav-wrapper position-relative ms-auto w-50">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#cam1" role="tab"
                                    aria-controls="cam1" aria-selected="true">
                                    Thanh toán tiền mặt
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#cam2" role="tab"
                                    aria-controls="cam2" aria-selected="false" tabindex="-1">
                                    Chuyển khoản
                                </a>
                            </li>


                        </ul>

                    </div>
                    <a href="{{ route('bill.index') }}" class="btn bg-gradient-secondary ms-3 mb-0">In hóa đơn</a>
                    <a href="{{ route('bill.index') }}" class="btn bg-gradient-primary ms-3 mb-0">Quay về</a>
                </div>
                <div class="card-body p-3 mt-2">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade position-relative  border-radius-lg active show" id="cam1"role="tabpanel" aria-labelledby="cam1" style="height: 500px !important">
                            <div class="position-absolute d-flex top-0 w-100">

                                <div class="card-body p-3 pt-0">
                                    <hr class="horizontal dark mt-0 mb-4">
                                    <div class="row">

                                        <div class="col-lg-4 col-md-6 col-12">

                                            <h6 class="mb-3 mt-0">
                                                <span style="vertical-align: inherit;">
                                                    <span style="vertical-align: inherit;">Thông tin cá nhân</span>
                                                </span>
                                            </h6>
                                            <ul class="list-group">
                                                <li
                                                    class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-3 text-sm">
                                                            <span style="vertical-align: inherit;">
                                                                <span style="vertical-align: inherit;">Mã bệnh nhân:
                                                                    {{ $billModel->user->uuid }}
                                                                </span>
                                                            </span>
                                                        </h6>
                                                        <h6 class="mb-3 text-sm">
                                                            <span style="vertical-align: inherit;">
                                                                <span style="vertical-align: inherit;">Họ và tên:
                                                                    {{ $billModel->user->name() }}
                                                                </span>
                                                            </span>
                                                        </h6>
                                                        <span class="mb-2 text-xs">
                                                            <span style="vertical-align: inherit;">
                                                                <span style="vertical-align: inherit;">Số điện thoại:
                                                                </span>
                                                            </span><span class="text-dark span-weight-bold ms-2">
                                                                <span style="vertical-align: inherit;">
                                                                    <span style="vertical-align: inherit;">
                                                                        {{ $billModel->user->login->phone_number }}</span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                        <span class="mb-2 text-xs">
                                                            <span style="vertical-align: inherit;">
                                                                <span style="vertical-align: inherit;">Ngày sinh:
                                                                </span>
                                                            </span><span class="text-dark ms-2 span-weight-bold">
                                                                <span style="vertical-align: inherit;">
                                                                    <span
                                                                        style="vertical-align: inherit;">{{ $billModel->user->dob() }}</span>
                                                                </span>
                                                            </span>
                                                        </span>

                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="div d-flex justify-content-between mt-3 align-items-center">
                                                <div class="col-12 col-sm-7 mt-sm-0">

                                                    <label class="">Trạng thái:</label>
                                                    {!! $billModel->status() !!}
                                                </div>
                                                <div class="col-12 col-sm-5 mt-sm-0 " style="display: flex;justify-content: end;">
                                                    <button class="btn bg-gradient-info" id="bill-update-status">Cập nhật trạng thái</button>
                                                </div>

                                            </div>
                                            <div class="div d-flex justify-content-between">

                                                <h6 class="mt-4">Tổng hóa đơn: </h6>
                                                <h4 class="mt-4 text-danger">{{ $billModel->total_price() }} </h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-12 ms-auto">
                                            <h6 class="mb-3 mt-0">
                                                <span style="vertical-align: inherit;">
                                                    <span style="vertical-align: inherit;">Thuốc:</span>
                                                </span>
                                            </h6>
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                #</th>
                                                            <th
                                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                Tên thuốc</th>
                                                            <th
                                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                Giá tiền</th>
                                                            <th
                                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                Số lượng</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($billModel->bill_prescription->prescription->prescription_detail as $prescription_detail)
                                                        @endforeach
                                                        <tr>
                                                            <td class="">
                                                                {{ $prescription_detail->id }}
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{ $prescription_detail->medicine->name }}</p>
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{ $prescription_detail->medicine->price() }}</p>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <p class="text-xs font-weight-bold mb-0">
                                                                    {{ $prescription_detail->quantity }}</p>
                                                            </td>

                                                        </tr>


                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="font-weight-bold" colspan="3">Tổng tiền</td>

                                                            <td class="font-weight-bold align-middle text-center">
                                                                {{ $billModel->bill_prescription->prescription->price() }}
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <h6 class="mb-3 mt-4">
                                                <span style="vertical-align: inherit;">
                                                    <span style="vertical-align: inherit;">Dịch vụ:</span>
                                                </span>
                                            </h6>
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                #</th>
                                                            <th
                                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                Tên thuốc</th>
                                                            <th
                                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                Giá tiền</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $totalPrice = 0;
                                                        @endphp
                                                        @foreach ($billModel->bill_service_result as $bill_service_result)
                                                            <tr>
                                                                <td class="align-middle  text-sm">
                                                                    {{ $bill_service_result->service_result_detail->service->id }}
                                                                </td>
                                                                <td class="text-center align-middle text-center text-sm">
                                                                    <p class="text-xs font-weight-bold mb-0">
                                                                        {{ $bill_service_result->service_result_detail->service->name }}
                                                                    </p>
                                                                </td>
                                                                <td class="align-middle text-center text-sm">
                                                                    <p class="text-xs font-weight-bold mb-0">
                                                                        {{ $bill_service_result->service_result_detail->service->price_format() }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $totalPrice +=
                                                                    $bill_service_result->service_result_detail->service
                                                                        ->price;
                                                            @endphp
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="font-weight-bold" colspan="2">Tổng tiền</td>

                                                            <td class="font-weight-bold align-middle text-center">
                                                                {{ number_format($totalPrice, '0', '.', '.') . ' VNĐ' }}</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade position-relative  border-radius-lg " id="cam2"
                        role="tabpanel" aria-labelledby="cam2" style="height: 500px">
                        <div class="position-absolute d-flex top-0 w-100">
                            <div class="card-body p-3 pt-0">
                                <hr class="horizontal dark mt-0 mb-4">

                                <div class="row">

                                    <div class="col-lg-4 col-md-6 col-12">

                                        <h6 class="mb-3 mt-0">
                                            <span style="vertical-align: inherit;">
                                                <span style="vertical-align: inherit;">Thông tin cá nhân</span>
                                            </span>
                                        </h6>
                                        <ul class="list-group">
                                            <li
                                                class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-3 text-sm">
                                                        <span style="vertical-align: inherit;">
                                                            <span style="vertical-align: inherit;">Mã bệnh nhân:
                                                                {{ $billModel->user->uuid }}
                                                            </span>
                                                        </span>
                                                    </h6>
                                                    <h6 class="mb-3 text-sm">
                                                        <span style="vertical-align: inherit;">
                                                            <span style="vertical-align: inherit;">Họ và tên:
                                                                {{ $billModel->user->name() }}
                                                            </span>
                                                        </span>
                                                    </h6>
                                                    <span class="mb-2 text-xs">
                                                        <span style="vertical-align: inherit;">
                                                            <span style="vertical-align: inherit;">Số điện thoại:
                                                            </span>
                                                        </span><span class="text-dark span-weight-bold ms-2">
                                                            <span style="vertical-align: inherit;">
                                                                <span style="vertical-align: inherit;">
                                                                    {{ $billModel->user->login->phone_number }}</span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <span class="mb-2 text-xs">
                                                        <span style="vertical-align: inherit;">
                                                            <span style="vertical-align: inherit;">Ngày sinh:
                                                            </span>
                                                        </span><span class="text-dark ms-2 span-weight-bold">
                                                            <span style="vertical-align: inherit;">
                                                                <span
                                                                    style="vertical-align: inherit;">{{ $billModel->user->dob() }}</span>
                                                            </span>
                                                        </span>
                                                    </span>

                                                </div>
                                            </li>
                                        </ul>
                                        <div class="div d-flex justify-content-between mt-3 align-items-center">
                                            <div class="col-12 col-sm-7 mt-sm-0">

                                                <label class="">Trạng thái:</label>
                                                {!! $billModel->status() !!}
                                            </div>
                                            <div class="col-12 col-sm-5 mt-sm-0 " style="display: flex;justify-content: end;">
                                                <button class="btn bg-gradient-info" id="bill-update-status-qr">Cập nhật trạng thái</button>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-lg-8 col-12 ms-auto" style="display:grid; justify-content: center ">
                                        <h6 class="mb-2 mt-0 text-center">
                                            <span style="vertical-align: inherit;">
                                                <span style="vertical-align: inherit;">Quét mã QR:</span>
                                            </span>
                                        </h6>
                                        <img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(200)->generate(Auth::user()->User->uuid))!!} ">
                                        <h6 class="mb-3 mt-3 text-center">
                                            <span style="vertical-align: inherit;">
                                                <span style="vertical-align: inherit;">Thanh toán hóa đơn</span>
                                            </span>
                                        </h6>
                                        <h4 class="mb-3 mt-0 text-center text-danger">
                                            <span style="vertical-align: inherit;">
                                                <span style="vertical-align: inherit;">{{ $billModel->total_price() }}</span>
                                            </span>
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('management.bill.modal_bill_update_status')


@endsection
@push('js')
<script src="{{ asset('asset/admin') }}/js/plugins/choices.min.js"></script>

<script>
    if (document.getElementById('bill-status')) {
          var bill_status = document.getElementById('bill-status');
          const example = new Choices(bill_status);

        }
    // Đợi cho DOM được load hoàn tất
    document.addEventListener("DOMContentLoaded", function() {
        // Lấy tab 2
        var tab2 = document.getElementById('cam2');

        // Lặng nghe sự kiện khi tab 1 được click
        document.querySelector('a[href="#cam1"]').addEventListener('click', function() {
            // Ẩn tab 2
            tab2.style.display = 'none';
        });

        // Lặng nghe sự kiện khi tab 2 được click
        document.querySelector('a[href="#cam2"]').addEventListener('click', function() {
            // Hiển thị tab 2
            tab2.style.display = 'block';
        });
    });

    $('#bill-update-status').on('click',function(){
        $('#bill_update_status').modal('show');
    })
    $('#bill-update-status-qr').on('click',function(){
        $('#bill_update_status').modal('show');
    })
</script>

@endpush
