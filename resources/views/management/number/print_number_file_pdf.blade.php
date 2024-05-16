<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>


<style type="text/css" media="all">

    *{ font-family: DejaVu Sans !important;}
    body{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 12px;
    }

    .header{
        width: 320px;
        height: 100%;
    }
    .top{
        width: 100%;
        height: auto;
        display: flex;
        justify-content: space-between;
    }
    .left{
        width: 100%; float: left;
    }
    .right{
        width: auto; float: right;
    }
    .logo{
        width: 100%;
        height: 30px;
        display: flex;
        align-items: center;
    }
    .logo_img{
        width: auto ;
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
    .sub-title{
        width: 100%;
        height: auto;
        font-size: 13px;
    }
    .info>.header-left{
        height: auto;
        width: 300px;
        font-size: 1.5em;
        display: flex;
        padding: auto;
    }
    #number_patient{
        width:auto;
        font-size: 30px;
        margin-left: 15%;
    }
    .qr{
        width: 300px;
        height: auto;
        display: flex;
        padding: auto;
        margin-bottom: 5px
    }
    .qr>img{
        margin-left: 15%;
        margin-right: 40%;
    }
    .header-left{
        width: 100%;
        height: 100%;
    }
    .mt-0{
        margin-top: 0px;
    }
    .mb-0{
        margin-bottom: 0px;
    }

    hr {
        clear: both;

    }
    .hr{
        margin-bottom: 13px
    }

</style>
<body>

    <div class="header">
        <div class="top">
            <div class="left">
                <div class="logo">
                    <img class="logo_img" src="{{ public_path('img/general_hospital/management') }}/logo/general_g37_logo1.png" alt="">
                </div>
                <div class="title">
                    <h4 class="mt-0 mb-0" style="margin: 0,0,0">Khoa: {{ $print_number->room->department->name }}</h4>

                </div>
                <div class="sub-title">
                    <span style="margin: 0;font-size: 17px">{{ $print_number->date_time() }}</span>
                    <br>
                    <span style="margin: 0;font-size: 17px">Phòng khám: {{ $print_number->room->name }}</span>

                </div>
            </div>
            <div class="right">

            </div>

        </div>
        <div class="hr">
            <hr>
        </div>
        <div class="qr">
            <img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(200)->generate($print_number->patient_identification_code))!!} ">
        </div>
        <div class="info">
            <div class="header-left">
                <span class="mt-0" id="number_patient" >Số thứ tự: {{ $print_number->number }}</span>
            </div>
        </div>

    </div>
</body>
<script>

</script>
</html>
