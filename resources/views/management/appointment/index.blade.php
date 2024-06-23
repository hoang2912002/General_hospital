@extends('management.layout.main')
@include('management.layout.table')
@push('css')
    <style>
        .footer {
            position: fixed;
            bottom: 0;

            width: 100%;
            padding: 10px;
        }
        @media screen and (max-width: 2576px) {
            #modal-detail-appointment .modal-dialog {
                max-width: 36.66667%;
                /* 66.66667% of the viewport width for col-8 */
            }
        }
        @media screen and (max-width: 1728px) {
            #modal-detail-appointment .modal-dialog {
                max-width: 70.66667%;
                margin-left: 350px;
                /* 66.66667% of the viewport width for col-8 */
            }
        }

    </style>
@endpush
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header  d-flex justify-content-between pb-0">
                                        <div>
                                            <h5 class="mb-0">Lịch hẹn</h5>
                                        </div>
                                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                                            <div class="ms-auto my-auto d-flex">
                                                <a href="{{ route('appointment.create') }}" class="btn bg-gradient-primary btn-sm mb-0 "   target="">+&nbsp; Thêm</a>&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dataTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        ID</th>

                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Họ và tên</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        CCCD/CMND</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Bác sĩ khám</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Ca</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Ngày</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Trạng thái</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Kích hoạt</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
        </div>
    </div>
    @include('management.appointment.modal_detail')



@endsection
@push('js')
    <script>

        function handleClick(id) {
            // Sử dụng giá trị slug ở đây
            $.ajax({
                url: '{!! route('appointment.detail') !!}', // Đường dẫn tới API hoặc tập lệnh xử lý dữ liệu trên máy chủ
                type: 'GET',
                data: { appointment: id },
                success: function(response) {
                    // Cập nhật nội dung của modal với dữ liệu từ phản hồi
                    console.log(response.arr);
                    $('#name').text(response.arr.name);
                    $('#gender').text(response.arr.gender);
                    $('#dob').text(response.arr.dob);
                    $('#email').text(response.arr.email);
                    $('#phone_number').text(response.arr.phone_number);
                    $('#patient_identification_code').text(response.arr.patient_identification_code);
                    $('#doctor_uuid').text(response.arr.doctor_uuid);
                    $('#status').html(response.arr.status);
                    $('#date').text(response.arr.date);
                    $('#shift_id').text(response.arr.shift_id);
                    $('#note').text(response.arr.note);
                    $('#appointment_id').val(response.arr.id);
                    $('#number_id').val(response.arr.number_id);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    <script>
        var columns = [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'patient_identification_code',
                name: 'patient_identification_code'
            },
            {
                data: 'doctor',
                name: 'doctor'
            },
            {
                data: 'shift_id',
                name: 'shift_id'
            },
            {
                data: 'date',
                name: 'date'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action'
            },

        ];
        setTimeout(function(){
            renderTable("{!! route('appointment.index') !!}", columns);
        }, 500);
    </script>
    <script>
         $(document).ready(function () {
            $('#sequence-number').on('click', function () {
                $.ajax({
                    type: "POST",
                    url: '{{ route('number.appointment_sequence_number') }}',
                    data: {
                        appointment_id: $('#appointment_id').val(),
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.success == true) {
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                                "onHidden": function() {
                                    location.reload();
                                }
                            };
                            toastr.success(response.notification);
                        }
                        else{
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            };
                            toastr.error(response.notification);
                        }
                    }
                });
            });
            $('#send_mail').on('click', function () {
                $.ajax({
                    type: "POST",
                    url: '{{ route('send.mail') }}',
                    data: {
                        appointment_id: $('#appointment_id').val(),
                        number_id: $('#number_id').val(),
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        if(response.success == true){
                            console.log(1);
                            window.location.href = response.Route;
                            // // Load lại trang hiện tại sau 1 giây (1000ms)
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                        }
                        else{
                            alert("Gửi mail thất bại!");
                        }
                    },
                    error: function (error) {
                        alert("Gửi mail thất bại!");
                    }
                });
            });
        });

    </script>
@endpush
