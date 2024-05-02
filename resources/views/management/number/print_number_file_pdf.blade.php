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
        height: 100%;
        display: flex;
        align-content: center
    }
    .title{
        width: 100%;
        height: auto;
        font-size: 1.5em;
        font-weight: bold
    }
    .info{
       height: 156px;
       width: 100%;
       font-size: 1.5em;
       display: flex;

    }
    .header-left{
        width: 100%;
        height: 100%;
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
            <h4 class="mt-0" style="margin: 0,5px,0,0">Khoa: {{ $print_number->room->department->name }}</h4>
        </div>

        <div class="info">
            <div class="header-left">
                <span style="margin: 0;font-size: 1.15em">{{ $print_number->date_time() }}</span>
                <br>
                <span style="margin: 0;font-size: 1.15em">Phòng khám: {{ $print_number->room->name }}</span>
                <h1 class="mt-0" style="margin: 0"  >Số thứ tự: {{ $print_number->number }}</h1>
            </div>
        </div>

    </div>
</body>
</html>
