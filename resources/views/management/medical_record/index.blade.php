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

    </style>
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/css/modal_test_requisition.css">
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
                                            <h5 class="mb-0">Hồ sơ bệnh án: {{ $userModel->name() }}</h5>
                                            <p class="text-sm mb-0">

                                            </p>
                                        </div>
                                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                                            <div class="ms-auto my-auto d-flex">
                                                <a href="{{ route('medical_record.create',['numberModel' => $numberModel,'userModel' => $userModel,'shift'=>$shift]) }}" class="btn bg-gradient-primary btn-sm mb-0 "   target="">+&nbsp; Thêm hồ sơ bệnh ánh mới</a>&nbsp;
                                                
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
                                                        #</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Bệnh lý</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Bác sĩ khám</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Lịch hẹn</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Ngày tái khám</th>
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
    {{-- modal service --}}
    @include('management.test_requisition.modal_patient_test_requisition')
@endsection
@push('js')
    <script>
        var columns = [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'disease',
                name: 'disease'
            },
            {
                data: 'doctor_uuid',
                name: 'doctor_uuid'
            },
            {
                data: 'appointment_id',
                name: 'appointment_id'
            },
            {
                data: 're_exam_date',
                name: 're_exam_date'
            },
            {
                data: 'action',
                name: 'action'
            },
        ];
        renderTable("{!! route('medical_record.index',['numberModel' => $numberModel->id,'userModel' => $userModel->uuid,'shift' => $shift]) !!}", columns);
    </script>

    <script>

        $(document).ready(function() {
            var originalData = [];
            var medical_record_id = '';
            $('#modal-test-requisition').on('show.bs.modal', function (event) {
                // Gửi yêu cầu Ajax để lấy toàn bộ dữ liệu
                medical_record_id = event.relatedTarget.getAttribute('data-medical-record');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: '{!! route('test_requisition.render_test_requisition',$userModel) !!}', // Thay thế bằng route tương ứng trong Laravel của bạn
                    type: 'GET',
                    data:{ medical_record_id: event.relatedTarget.getAttribute('data-medical-record')},
                    success: function(response) {
                        originalData = response;
                        renderData(originalData); // Gọi hàm để render dữ liệu
                    },
                    error: function(xhr, status, error) {
                        //console.error(xhr.responseText);
                    }
                });
            });

            $('#service-search').on('keyup', function(event) {
                const searchTerm = $(this).val();
                    // Gửi yêu cầu Ajax tìm kiếm
                    //const medical_record_id = $('#modal-test-requisition').data('data-medical-record');

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        url: '{!! route('test_requisition.render_test_requisition',$userModel) !!}',
                        type: 'GET',
                        data: { searchTerm: searchTerm,medical_record_id: medical_record_id },
                        success: function(response) {
                            if (response.length > 0) {
                                originalData = response;
                                renderData(originalData); // Gọi hàm để render dữ liệu
                            } else {
                                $('#service-table tbody').empty(); // Xóa dữ liệu cũ trong bảng
                                $('#service-table tbody').append('<tr><td colspan="5" class="text-center">Không tìm thấy dữ liệu</td></tr>'); // Thêm thông báo không tìm thấy dữ liệu vào bảng
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });

            })

            function renderData(data) {
                // Xóa dữ liệu cũ trong bảng
                $('#service-table tbody').empty();
                // Thêm dữ liệu mới vào bảng
                $.each(data, function(index, item) {
                    var div = $('<div>').addClass('form-check my-auto');
                    var formattedPrice = formatCurrency(item.price);
                    var imagePath = "{{ asset('') }}"  + item.thumbnail;
                    // var url = '{{ route("medicine.detail", ':medicineModel') }}';
                    // url = url.replace(':medicineModel', item.slug);
                    var checkbox = (item.checkbox == 1) ? true : false;
                    var row = $('<tr>').append(
                        $('<td>').append(div.append($('<input>').attr('type', 'checkbox').addClass('form-check-input ' + item.slug).attr('id', item.slug).prop('checked', checkbox))),
                        $('<td>').append($('<img>').attr('src', imagePath).attr('alt', item.name).attr('class', 'img').css({'width': '50px', 'height': '50px'})),
                        $('<td>').append('<a href="" class="h6">' + item.name + ' </a>'),
                        $('<td>').append('<h6>' + formattedPrice + ' </h6>'),
                    );
                    $('#service-table tbody').append(row);
                });
            }
            function formatCurrency(price) {
                return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
            }

            $('#create_test_requisition').on('click',function(){
                var array_checkbox = {};
                var checkbox = $('input[type="checkbox"]:checked');

                array_checkbox = checkbox.map(function(index, element) {
                    if ($(element).attr('id') !== 'flexSwitchCheckDefault23') {
                        var slug = $(element).attr('id');
                        return { 'slug': slug };
                    }
                }).toArray();
                console.log(array_checkbox);
                //reset key của mảng
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: "GET",
                    url: '{!! route('test_requisition.store_test_requisition',$userModel) !!}',
                    data: {array_checkbox: array_checkbox,medical_record_id: medical_record_id},
                    success: function (response) {
                        if(response.status == 'success'){
                            window.location.reload();
                        }
                        else{
                            alert("Thêm phiếu chỉ định thất bại!");
                        }
                    }
                });
            });

            $('#btn-print-test-requisition').on('click',function(){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: "GET",
                    url: '{!! route('test_requisition.redirect_print_test_requisition',$userModel) !!}',
                    data: {medical_record_id: medical_record_id},
                    success: function (response) {
                        if(response.success == true){
                            console.log(1);
                            window.location.href = response.pdfRoute;
                            //window.location.reload();
                        }
                        else{
                            //alert("Thêm phiếu chỉ định thất bại!");
                        }
                    }
                });
            })
        })
    </script>
@endpush
