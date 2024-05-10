@extends('management.layout.main')
@include('management.layout.form')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/admin') }}/css/prescription.css">
@endpush
@section('content')
<div class="row mb-5">
    <div class="col-lg-2">
        <div class="card position-sticky top-1">
            <ul class="nav flex-column bg-white border-radius-lg p-3  d-flex align-content-center">
                <li class="nav-item">
                    <a href="{{ route('prescription.print_prescription', ['userModel' => $userModel->uuid, 'medical_recordModel' => $medical_recordModel->id]) }}" class="btn btn-outline-secondary mb-3 button_index"><i class="fa ni fa-solid fa-print "></i>In</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('prescription.update_number_medical_record', ['numberModel' => $numberModel->id, 'userModel' => $userModel->uuid, 'medical_recordModel' => $medical_recordModel->id]) }}" class="btn btn-outline-gradient-info mb-3 button_index">Đã khám</a>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-danger mb-3 button_index" data-bs-toggle="modal" data-bs-target="#modal-medical-record">Hồ sơ bệnh án</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-warning mb-3 button_index " data-bs-toggle="modal" data-bs-target="#modal-re-exam-date">Tái khám</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-success mb-3 button_index " data-bs-toggle="modal" data-medical-record-id="{{ $medical_recordModel->id }}" data-bs-target="#modal-service-result">Kết quả xét nghiệm</button></button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-primary  mb-3 button_index " data-bs-toggle="modal" data-bs-target="#modal-index"><i class="fa ni fa-solid fa-capsules text-sm"></i> Thuốc</button>
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
                    <p class="mb-0">Bệnh nhân: {{ ($userModel->first_name . ' ' . $userModel->last_name) ?? '' }}</p></h5>
                    <p class="mb-0">Giới tính: {{ (($userModel->gender == 1) ? 'Nam' : 'Nữ') ?? ''  }}</p>
                    <p class="mb-0">Năm sinh: {{ ($userModel->dob()) ?? '' }} </p>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto d-grid" style="justify-items: end;">
                        <h5>Bác sĩ: {{ Auth::user()->user->first_name . ' ' . Auth::user()->user->last_name }}</h5>
                        <p class="mb-0">Khoa: </p>
                        <p class="mb-0">Số điện thoại: {{ Auth::user()->phone_number  }}</p>
                        <p class="mb-0">Thứ 2 đến Thứ 7</p>

                    </div>
                </div>

            </div>
            <hr class="hr mt-1">
            <div class=" pb-0 mt-0 d-flex justify-content-between" style="padding: 0 1.5rem">
                <p class=" mb-0 ml-1">Ngày khám: {{ $medical_recordModel->shift() ?? '' }}  {{ '- '. $medical_recordModel->date($medical_recordModel->exam_date) ?? '' }}</p>
                <p class=" mb-0 ml-1">Tái khám: {{ $medical_recordModel->date($medical_recordModel->re_exam_date) ?? '' }}</p>
            </div>
            <hr class="hr mb-2">

            <div class="card-body pt-0">
                <div class="row">

                    <div class="col-lg-4 ">
                        <div class="pb-3"></div>
                        @if (!empty($medical_recordModel->reason))
                            <h6>Triệu chứng:</h6>
                            <p>{{ $medical_recordModel->reason }}&nbsp;
                                <a class=" trigger-modal" href="#" data-bs-toggle="modal" data-bs-target="#update_reason">
                                    <i class="fas fa-solid fa-pen"></i>
                                </a>
                                <input type="hidden" value="{{ $medical_recordModel->id }}" id="medical_record_id">
                                <a href="{{route('medical_record.delete_reason',$medical_recordModel->id)}}" class="" ><i class="fas fa-trash"></i></a>
                            </p>

                        @endif
                        @if (!empty($medical_recordModel->disease))
                            <h6>Bệnh lý:</h6>
                            <p>{{ $medical_recordModel->disease }}&nbsp;
                                <a class=" trigger-modal" href="#" data-bs-toggle="modal" data-bs-target="#update_disease">
                                    <i class="fas fa-solid fa-pen"></i>
                                </a>
                                <a href="{{route('medical_record.delete_disease',$medical_recordModel->id)}}" class="" ><i class="fas fa-trash"></i></a>
                            </p>

                        @endif
                        <br>
                        @if (!empty($medical_recordModel->re_exam_date))
                            <h6>Dặn dò:</h6>
                            <p>{{ $medical_recordModel->note }}&nbsp;
                                <a class=" trigger-modal" href="#" data-bs-toggle="modal" data-bs-target="#update_note">
                                    <i class="fas fa-solid fa-pen"></i>
                                </a>
                                <a href="{{route('medical_record.delete_disease',$medical_recordModel->id)}}" class="" ><i class="fas fa-trash"></i></a>
                            </p>

                        @endif
                    </div>
                    <div class="col-lg-1" style="width: 3px !important; ">
                        <hr class="vertical-line">
                    </div>
                    <div class="col-lg-7">
                        <div class="pb-3"></div>
                        @if (!empty($prescription))
                            <h6>Thuốc</h6>
                            <input type="hidden" value="{{ $prescription->id ?? '' }}" id="prescription_id">
                            @foreach ($prescription->prescription_detail as $index => $prescription_detail)
                                <p class="font-weight-bold mb-0">{{ $index+1  }}. {{  $prescription_detail->medicine->name }}&nbsp;
                                    <a class=" trigger-modal" href="#" data-bs-toggle="modal" data-bs-target="#update_prescription_detail{{$prescription_detail->id}}">
                                        <i class="fas fa-solid fa-pen"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="" onclick="deleteItem(' {{route('prescription_detail.destroy',$prescription_detail->id)}} ')"><i class="fas fa-trash"></i></a>

                                </p>
                                <p class="mx-3 mb-0">Số lượng: {{ $prescription_detail->quantity ?? '' }}</p>
                                <p class="mb-1 mt-0">{!! html_entity_decode( $prescription_detail->note) !!}</p>
                            @endforeach

                        @endif
                    </div>
                </div>
                @if (!empty($prescription))
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-1" style="width: 3px !important; ">
                        </div>
                        <div class="col-lg-7">
                            <div class="pb-3">
                                <h5>Tổng tiền: {{ $prescription->price() }}</h5>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- Modal medicine --}}
@include('management.prescription.modal_medicine_form')
@include('management.prescription.modal_medicine_index')
@include('management.prescription.modal_medicine_note')
{{-- Service result --}}
@include('management.prescription.service_result')
<!-- Modal update reason -->
@include('management.prescription.update_reason')
<!-- Modal update note -->
@include('management.prescription.update_note')
<!-- Modal medical record -->
@include('management.prescription.modal_medical_record')
<!-- Modal re_exam_date -->
@include('management.prescription.re_exam_date')
<!-- Modal update prescription_detail -->
@if(!empty($prescription->prescription_detail))
    @foreach ($prescription->prescription_detail as $index => $prescription_detail)
        @include('management.prescription.update_prescription_detail')
        @push('js')
            <script src="{{ asset('asset/admin/js') }}/plugins/quill.min.js"></script>
            <script>
                $(document).ready(function() {
                    // Select modal specific to this prescription detail
                    var btn = "#update_prescription{{$prescription_detail->id}}";
                    $(btn).on('click',function() {
                        // Lấy giá trị mới của $prescription->note
                            var div_parent = $('#div_prescription_update_infor{{$prescription_detail->id}}');
                            console.log($('#div_prescription_update_infor{{$prescription_detail->id}}').find('#prescription_detail_id').val());

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                type: "PATCH",
                                url: "{{ route('medical_record.update_prescription_detail', ['prescriptionDetailModel' => 'REPLACE_WITH_ID']) }}".replace('REPLACE_WITH_ID',  div_parent.find('#prescription_detail_id').val()),
                                data: {arr_prescription_detail:{
                                    'quantity': div_parent.find('input[name="quantity"]').val(),
                                    'description': $('  #edit-deschiption{{$prescription_detail->id}} .ql-editor').get(0).outerHTML,
                                }},
                                success: function (response) {
                                    if(response.status == 'success'){
                                        window.location.reload();
                                    }
                                }
                            });
                        });
                });
            </script>
        @endpush
    @endforeach
@endif
<!-- Modal update disease -->
@include('management.prescription.update_disease')

@if(session('reload'))
    <script>
        // Reload lại trang khi biến 'reload' được đặt
        window.location.reload();
    </script>
@endif
@if(session('reload-error'))
    <script>
        alert('Không thể thực hiện yêu cầu');
    </script>
@endif
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="{{ asset('asset/admin/js') }}/plugins/quill.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>

    </script>
    <script>
        $("#medicine-button").on('click', function () {
            var formData = $("#form-medicine").serialize();
        });
        $('.update_prescription_detail div[id^="edit-deschiption"]').each(function() {
            // Khởi tạo Quill cho mỗi phần tử textarea
            var quill = new Quill($(this)[0], {
                theme: 'snow' // Specify theme in configuration
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            var originalData = [];
            $('#modal-index').on('show.bs.modal', function (event) {
                // Gửi yêu cầu Ajax để lấy toàn bộ dữ liệu
                $.ajax({
                    url: '{!! route('prescription.render_medicine') !!}', // Thay thế bằng route tương ứng trong Laravel của bạn
                    type: 'GET',
                    dataType: 'json',
                    data:{ prescription: $('#prescription_id').val()  },
                    success: function(response) {
                        originalData = response;
                        renderData(originalData,1, 10); // Gọi hàm để render dữ liệu
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#medicine-presciption').on('keyup', function() {
                const searchTerm = $(this).val();
                    // Gửi yêu cầu Ajax tìm kiếm
                    $.ajax({
                        url: '{!! route('prescription.render_medicine') !!}',
                        type: 'GET',
                        dataType: 'json',
                        data: { searchTerm: searchTerm,prescription: $('#prescription_id').val() },
                        success: function(response) {
                            if (response.length > 0) {
                                originalData = response;
                                renderData(originalData,1, 10); // Gọi hàm để render dữ liệu
                            } else {
                                $('#medicine-table tbody').empty(); // Xóa dữ liệu cũ trong bảng
                                $('#medicine-table tbody').append('<tr><td colspan="5" class="text-center">Không tìm thấy dữ liệu</td></tr>'); // Thêm thông báo không tìm thấy dữ liệu vào bảng
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });

            })

            $('#choices-category-presciption').on('change',function(){
                var category_selected = $(this).find('option:selected').val();
                $.ajax({
                        url: '{!! route('prescription.category_select_medicine') !!}',
                        type: 'GET',
                        dataType: 'json',
                        data: { category_selected: category_selected,prescription: $('#prescription_id').val() },
                        success: function(response) {
                            if (response.length > 0) {
                                originalData = response;
                                renderData(originalData,1, 10); // Gọi hàm để render dữ liệu
                            } else {
                                $('#medicine-table tbody').empty(); // Xóa dữ liệu cũ trong bảng
                                $('#medicine-table tbody').append('<tr><td colspan="5" class="text-center">Không tìm thấy dữ liệu</td></tr>'); // Thêm thông báo không tìm thấy dữ liệu vào bảng
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
            })
            $('#choices-manufacturer-presciption').on('change',function(){
                var manufacturer_selected = $(this).find('option:selected').val();
                $.ajax({
                        url: '{!! route('prescription.manufacturer_select_medicine') !!}',
                        type: 'GET',
                        dataType: 'json',
                        data: { manufacturer_selected: manufacturer_selected,prescription: $('#prescription_id').val() },
                        success: function(response) {
                            if (response.length > 0) {
                                originalData = response;
                                renderData(originalData,1, 10); // Gọi hàm để render dữ liệu
                            } else {
                                $('#medicine-table tbody').empty(); // Xóa dữ liệu cũ trong bảng
                                $('#medicine-table tbody').append('<tr><td colspan="5" class="text-center">Không tìm thấy dữ liệu</td></tr>'); // Thêm thông báo không tìm thấy dữ liệu vào bảng
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
            })

            function formatCurrency(price) {
                return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
            }
            function renderData(data,currentPage,itemsPerPage) {
                // Xóa dữ liệu cũ trong bảng
                $('#medicine-table tbody').empty();
                var startIndex = (currentPage - 1) * itemsPerPage;
                var endIndex = Math.min(startIndex + itemsPerPage, data.length);
                // Thêm dữ liệu mới vào bảng
                for (var i = startIndex; i < endIndex; i++) {
                    var item = data[i];
                    var div = $('<div>').addClass('form-check my-auto');
                    var formattedPrice = formatCurrency(item.price);
                    var imagePath = "{{ asset('') }}"  + item.image;
                    var url = '{{ route("medicine.detail", ':medicineModel') }}';
                    url = url.replace(':medicineModel', item.slug);
                    var checkbox = (item.checkbox == 1) ? true : false;
                    var row = $('<tr>').append(
                        $('<td>').append(div.append($('<input>').attr('type', 'checkbox').addClass('form-check-input ' + item.slug).attr('id', item.slug).prop('checked', checkbox))),

                        $('<td>').append($('<img>').attr('src', imagePath).attr('alt', item.name).attr('class', 'img').css({'width': '50px', 'height': '50px'})),
                        $('<td>').append('<a href="'+url+'" class="h6">' + item.name + ' </a>'),
                        $('<td>').text(item.categories.name),
                        $('<td>').text(item.manufacturer.name),
                        $('<td>').text(formattedPrice),
                    );
                    $('#medicine-table tbody').append(row);
                };
                renderPagination(data.length, currentPage, itemsPerPage);

            }

            function renderPagination(totalItems, currentPage, itemsPerPage) {
                var totalPages = Math.ceil(totalItems / itemsPerPage);

                // Xóa phân trang cũ trước khi tạo mới
                $('.pagination').empty();

                // Tạo nút "Trang trước"
                var prevButton = $('<li>').addClass('page-item').append(
                    $('<a>').addClass('page-link').attr('href', '#').text('<')
                );
                if (currentPage === 1) {
                    prevButton.addClass('disabled');
                } else {
                    prevButton.click(function() {
                        renderData(originalData, currentPage - 1, itemsPerPage);
                    });
                }

                // Tạo nút cho mỗi trang
                var pageButtons = [];
                for (var i = 1; i <= totalPages; i++) {
                    var pageButton = $('<li>').addClass('page-item').append(
                        $('<a>').addClass('page-link').attr('href', '#').text(i)
                    );
                    if (i === currentPage) {
                        pageButton.addClass('active');
                    } else {
                        pageButton.click((function(page) {
                            return function() {
                                renderData(originalData, page, itemsPerPage);
                            };
                        })(i));
                    }
                    pageButtons.push(pageButton);
                }

                // Tạo nút "Trang tiếp theo"
                var nextButton = $('<li>').addClass('page-item').append(
                    $('<a>').addClass('page-link').attr('href', '#').text('>')
                );
                if (currentPage === totalPages) {
                    nextButton.addClass('disabled');
                } else {
                    nextButton.click(function() {
                        renderData(originalData, currentPage + 1, itemsPerPage);
                    });
                }

                // Thêm các nút vào phân trang
                $('.pagination').append(prevButton);
                pageButtons.forEach(function(button) {
                    $('.pagination').append(button);
                });
                $('.pagination').append(nextButton);
            }
            //Mở modal kết quả xét nghiệm
            $('#modal-service-result').on('show.bs.modal', function (event) {
                // Gửi yêu cầu Ajax để lấy toàn bộ dữ liệu
                $.ajax({
                    url: '{!! route('prescription.service_result',$medical_recordModel->id) !!}', // Thay thế bằng route tương ứng trong Laravel của bạn
                    type: 'GET',

                    success: function(response) {

                        if (response.length > 0) {
                            originalData = response;
                            render_Service_result_Data(originalData); // Gọi hàm để render dữ liệu
                        } else {
                            $('#service_result-table tbody').empty(); // Xóa dữ liệu cũ trong bảng
                            $('#service_result-table tbody').append('<tr><td colspan="5" class="text-center">Không tìm thấy dữ liệu</td></tr>'); // Thêm thông báo không tìm thấy dữ liệu vào bảng
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
             //Render data modal kết quả xét nghiệm
             function render_Service_result_Data(data) {
                // Xóa dữ liệu cũ trong bảng
                $('#service_result-table tbody').empty();

                // Thêm dữ liệu mới vào bảng
                $.each(data, function(index, item) {
                    var formattedPrice = formatCurrency(item.price);
                    var imagePath = "{{ asset('') }}" + item.result_file_path;

                    var row = $('<tr>').append(
                        $('<td>').append(
                            $('<div>').addClass('d-flex px-2 py-1').append(
                                $('<div>').append(
                                    $('<a>').attr('href', imagePath).attr('target', '_blank').append(
                                        $('<img>').attr('src', imagePath).addClass('avatar avatar-md me-3').attr('alt', 'table image')
                                    )
                                ),
                                $('<div>').addClass('d-flex flex-column justify-content-center').append(
                                    $('<h6>').addClass('mb-0 text-sm').text(item.service_name)
                                )
                            )
                        ),
                        $('<td>').append(
                            $('<h6>').addClass('text-sm text-secondary mb-0 text-danger').text(formattedPrice)
                        ),

                        // $('<td>').addClass('align-middle text-sm').append(
                        //     $('<div>').addClass('progress mx-auto').append(
                        //         $('<div>').addClass('progress-bar bg-gradient-success').attr('role', 'progressbar').css('width', '80%').attr('aria-valuenow', '80').attr('aria-valuemin', '0').attr('aria-valuemax', '100')
                        //     )
                        // ),
                        $('<td>').addClass('align-middle text-sm').append(
                            $('<span>').addClass('text-secondary text-sm').html(item.note)
                        )
                    );
                    $('#service_result-table tbody').append(row);
                });
            }

            $('#create_note').on('click',function(){
                var array_checkbox = {};
                var checkbox = $('input[type="checkbox"]:checked');
                array_checkbox = checkbox.map(function(index, element) {
                    if ($(element).attr('id') !== 'flexSwitchCheckDefault23') {
                        var slug = $(element).attr('id');
                        return { 'slug': slug };
                    }
                }).toArray();
                //reset key của mảng
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: "GET",
                    url: "{{ route('prescription.render_note_medicine') }}",
                    data: {array_checkbox: array_checkbox,prescription: $('#prescription_id').val()},

                    success: function (response) {
                        $('#note_modal_body').html(response);
                        $('#note_modal_body div[id^="edit-deschiption"]').each(function() {
                            // Khởi tạo Quill cho mỗi phần tử textarea
                            var quill = new Quill($(this)[0], {
                                theme: 'snow' // Specify theme in configuration
                            });
                        });

                        $('#modal-medicine-note').modal('show');

                    }
                });
            });


            $('#save_prescription').on('click',function(){
                var values = [];
                console.log($('#div_content_each_prescription'));
                // var description = $('#edit-deschiption').find('.ql-editor').get(0).outerHTML;
                $('.div_content_each_prescription').each(function() {
                    // Lấy giá trị của từng trường và thêm vào mảng values
                    var div_parent = $(this);
                    values.push({
                        'id': div_parent.find('input[name="id_medicine[]"]').val(),
                        'price': div_parent.find('input[name="price[]"]').val(),
                        'quantity': div_parent.find('input[name="quantity[]"]').val(),
                        'description': div_parent.find('#edit-deschiption .ql-editor').get(0).outerHTML,
                        'medical_record_id': $('#medical_record_id').val(),
                    });
                });
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: "POST",
                    url: "{{ route('prescription.store') }}",
                    data: {arr_prescription: values},
                    success: function (response) {
                        if(response.status == 'success'){
                            window.location.reload();
                        }
                    }
                });
            });
        });
    </script>
    <script>
        function deleteItem(url){
            console.log(url);
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    console.log(value);
                    $.ajax({
                        type: "delete",
                        url: url,
                        success: function (response) {
                            if(response == 1){
                                toastr.success('Xóa thành công!');
                                window.location.reload();
                            }
                            else{
                                toastr.error('Không thể xóa');
                            }
                        }
                    });
                }
            });
        }
    </script>
@endpush

