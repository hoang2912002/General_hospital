{{-- @extends('management.patient.app') --}}
@extends('management.layout.main')
@push('css')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        .result {
            background-color: green;
            color: #fff;
            padding: 20px;
        }

        .row {
            display: flex;
        }
        @media screen and (max-width: 2571px) {
            #reader {
                min-width: 1002px;
                min-height: 502px;
            }
        }

        @media screen and (max-width: 1936px) {
            #reader {
                min-width: 502px;
                min-height: 246px;
            }
        }
        #reader {
            background: rgb(255, 255, 255);
            border-radius: 5px;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
            display: flex !important;
            flex-wrap: wrap;
            align-content: center;
        }

        button {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 6px;
        }

        a#reader__dashboard_section_swaplink {
            background-color: blue;
            /* Green */
            border: none;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 6px;
        }

        span a {
            display: none
        }

        #reader__camera_selection {
            background: blueviolet;
            color: aliceblue;
        }

        #reader__dashboard_section_csr span {
            color: red
        }

    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-8 col-sm-10 mx-auto">
            {{-- <form class="" action="index.html" method="post"> --}}
                <div class="card my-sm-5 my-lg-0">
                    <div class="card-header text-center">
                        <div class="row justify-content-between">
                            <div class="col-md-4 text-start">
                                <h6>
                                    Bệnh nhân: {{ $numberModel->name() }}
                                </h6>

                            </div>
                        </div>
                        <br>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <div class="container">
                                        <!-- this function of java Script play Camera -->
                                        <!-- Header -->
                                        <div class="container-fluid header_se d-flex justify-content-center">
                                            <div class="col-md-8 d-flex justify-content-center">
                                                <div class="row">
                                                    <div class="col d-flex">
                                                        <div id="reader"></div>
                                                    </div>
                                                    {{-- <div class="col" style="padding:30px;">
                                                        <h4>SCAN RESULT</h4>
                                                        <div id="result">Result Here</div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            {{-- </form> --}}
        </div>
    </div>

@endsection
@push('js')
<script src="{{ asset('asset/admin') }}/js/qrcode/html5-qrcode.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script type="text/javascript">
        // after success to play camera Webcam Ajax paly to send data to Controller
        function onScanSuccess(data) {
            $.ajax({
                type: "POST",
                cache: false,
                url: "{{ route('patient.patient_scan',['numberModel' =>$numberModel->id,'shift' => $shift]) }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    data: data
                },
                success: function(response) {
                    // after success to get Answer from controller if User Registered login user by scanner
                    // and page change to Home blade
                    if (response.success == true) {
                        console.log(1);
                        window.location.href = response.route;
                        // window.location.href = response.pdfRoute;
                        // // Load lại trang hiện tại sau 1 giây (1000ms)

                    } else {
                        setTimeout(function(){
                            window.location.reload();
                        }, alert("Thất bại"));
                    }
                }
            })
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endpush
