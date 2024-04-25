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
        height: 280px;

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
            <img class="logo_img" src="{{ public_path('img/general_hospital/management') }}/logo/general_g37_logo1.png" alt="">
        </div>
        <hr>
        <div class="title">
            <span class="h3" style="">A: Thông tin cá nhân</span>
        </div>

        <div class="info">
            <div class="header-left">
                <h3 class="span">Họ và tên: {{ $patient_name }} </h3>
                <span class="span">Ngày sinh: {{ $patient_information->medical_record->user->birthdate() }} </span>
                <br>
                <span class="span">Giới tính : {{ $patient_information->medical_record->user->patient_gender()  }} </span>
                <br>
                <span class="span">Số điện thoại : {{ $patient_information->medical_record->user->login->phone_number }} </span>


                <h3 class="span">Bác sĩ: {{ Auth::user()->User->first_name . ' '  .  Auth::user()->User->last_name }}</h3>
            </div>
        </div>

    </div>
    <div class="space"></div>
    <hr>
    <h2>B: Dịch vụ</h2>
    <table>
        <thead>
            <tr>
                <th class="span">
                    Số thứ tự
                </th>
                <th class="span">
                    Tên dịch vụ
                </th>
                <th class="span">
                    Phòng
                </th>
            </tr>

        </thead>
        <tbody>
            @foreach ($print_test_requisition as  $item)
                <tr>
                    <td  class="counterCell span"></td>
                    <td class="span">{{ $item->service->name }}</td>
                    <td class="span">{{ $item->service->room->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="body"></div>
</body>
</html>
