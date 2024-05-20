<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 12px;
    }
    .header{
        width: 100%;
        height: 300px;

    }
    .logo{
        width: 100%;
        height: 30px;
        display: flex;
        align-items: center;
    }
    .logo_img{
        width: ;
        height: 25px;
        display: flex;
        align-content: center
    }
    .title{
        width: 100%;
        height: 40px;
        font-size: 1.5em;
        margin-block-start: 0.83em;

        font-weight: bold
    }
    .info{
       height: 156px;
       width: 100%;
       display: flex;

    }
    .header-left,.header-right{
        width: 40%;
        height: 100%;
        display: grid;

    }
    .span{
        font-size: 16px
    }
    .header-right{
        text-align: right
    }
    .space{
        width: 100%;
        height: 20px;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        height: 50px;
        text-align: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 12px;
    }
    table{
        width: 100%;

    }

    table {
        counter-reset: tableCount;
    }
    .counterCell:before {
        content: counter(tableCount);
        counter-increment: tableCount;
    }
    hr{
        border: 0.1px solid black;
    }
</style>
<style>
    *{ font-family: DejaVu Sans !important;}
</style>
<body>

    <div class="header">
        <div class="logo">
            <img class="logo_img" src="{{ asset('img/general_hospital/management') }}/logo/general_g37_logo1.png" alt="">
        </div>
        <hr>
        <h1>Hóa đơn</h1>
        <div class="title">
            <span class="h3" style="">A: Thông tin cá nhân</span>
        </div>

        <div class="info">
            <div class="header-left">
                <h3 class="span">Họ và tên:  {{ $billModel->user->name() }}</h3>
                <span class="span">Ngày sinh:  {{ $billModel->user->dob() }}</span>
                <br>
                <span class="span">Số điện thoại :  {{ $billModel->user->login->phone_number }}</span>


                <h3 class="span">Bác sĩ: {{ $billModel->medical_record->doctor->name() }}</h3>
            </div>
        </div>

    </div>
    @if (!empty($billModel->bill_prescription) && $billModel->bill_prescription !== [])
        <hr>
        <h2>B: Toa thuốc</h2>
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th
                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 span">
                        Số thứ tự</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 span">
                        Tên thuốc</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 span">
                        Giá tiền</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 span">
                        Số lượng</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($billModel->bill_prescription->prescription->prescription_detail as $prescription_detail)
                @endforeach
                <tr>
                    <td class="">

                        <p class="text-xs font-weight-bold mb-0 span" >{{ $prescription_detail->id }}</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0 span" >
                            {{ $prescription_detail->medicine->name }}</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0 span">
                            {{ $prescription_detail->medicine->price() }}</p>
                    </td>
                    <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0 span">
                            {{ $prescription_detail->quantity }}</p>
                    </td>

                </tr>


            </tbody>
            <tfoot>
                <tr>
                    <td class="font-weight-bold text-center span" colspan="3">Tổng tiền</td>

                    <td class="font-weight-bold align-middle text-center span">
                        {{ $billModel->bill_prescription->prescription->price() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    @endif
    @if (!empty($billModel->bill_service_result) && $billModel->bill_service_result !== [])
        <div class="space"></div>
        <hr>
        <h2>C: Dịch vụ</h2>
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th
                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 span">
                        Số thứ tự</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 span">
                        Tên thuốc</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 span">
                        Giá tiền</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $totalPrice = 0;
                @endphp
                @foreach ($billModel->bill_service_result as $bill_service_result)
                    <tr>
                        <td class="align-middle  text-sm span">
                            {{ $bill_service_result->service_result_detail->service->id }}
                        </td>
                        <td class="text-center align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0 span">
                                {{ $bill_service_result->service_result_detail->service->name }}
                            </p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0 span">
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
                    <td class="font-weight-bold span" colspan="2">Tổng tiền</td>

                    <td class="font-weight-bold align-middle text-center span">
                        {{ number_format($totalPrice, '0', '.', '.') . ' VNĐ' }}</td>
                </tr>
            </tfoot>
        </table>
    @endif
    <div class="space"></div>
    <div class="total-bill" style="padding-left: 50% ">
        <span style="font-weight: bold; font-size: 20px;">Tổng hóa đơn: &nbsp;</span>
        <span class="span" style="font-weight: bold; font-size: 20px">{{ $billModel->total_price() }} </span>
    </div>
</body>
</html>
