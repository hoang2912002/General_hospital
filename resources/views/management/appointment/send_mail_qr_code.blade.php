<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css" media="all">
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 16px;
            margin: 0;
            padding: 0;
            background-color: #f6f6f6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: grid;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
        }
        .header img {
            height: 35px; /* Adjust height as needed */
            margin-right: 10px;
        }
        .content h1 {
            font-size: 24px;
            margin: 0;
        }
        .content {
            padding-bottom: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
        }
        .info .sequence_number {
            font-size: 26px;
            line-height: 1.5;

        }
        .content .info {
            margin: 20px 0;
        }
        .content .info p {
            margin: 0;
        }
        .content .qr {
            text-align: center;
            margin: 20px 0;
        }
        .content .qr img {
            width: 200px;
            height: 200px;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #eeeeee;
            margin-top: 20px;
            font-size: 12px;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $message->embed(public_path('img/general_hospital/management/logo/general_g37_logo1.png')) }}" alt="Logo">

        </div>
        <div class="content">
            <div class="info">
                <h1>Khoa: {{ $number->room->department->name }}</h1>
                <p>Ngày khám: {{ $number->date_time() }}</p>
                <p>Phòng khám: {{ $number->room->name }}</p>
            </div>
            <div class="qr">
                {{-- <img src="data:image/png;base64,{!!$message->embedData(base64_encode($qr_code), 'QrCode.png','image/png')!!}"> --}}
                <img src="data:image/png;base64,{!! $qr_code !!}">

            </div>
            <div class="info">
                <p class="sequence_number">Số thứ tự: {{ $number->number }}</p>
            </div>
        </div>
        <div class="footer">
            <p>&copy; 2024 Đa khoa G37. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
