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
        .table td {vertical-align: 50% }
        @media screen and (max-width: 2576px) {
            #modal-detail-assignment .modal-dialog {
                max-width: 56.66667%;
                /* 66.66667% of the viewport width for col-8 */
            }
        }
        @media screen and (max-width: 1728px) {
            #modal-detail-assignment .modal-dialog {
                max-width: 70.66667%;
                margin-left: 350px;
                /* 66.66667% of the viewport width for col-8 */
            }
        }
        #assignment-detail-table {
            border-collapse: collapse;
            border: 2px solid rgb(200,200,200);
            letter-spacing: 1px;
            font-size: 0.8rem;
        }

        #assignment-detail-table td,
        #assignment-detail-table th {
            border: 1px solid rgb(190,190,190);
            padding: 10px 20px;
            text-align: center;
        }

        #assignment-detail-table caption {
            padding: 10px;
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
                                            <h5 class="mb-0">Tất cả lịch làm việc</h5>
                                        </div>
                                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                                            <div class="ms-auto my-auto d-flex">
                                                <a href="{{ route('user.create') }}" class="btn bg-gradient-primary btn-sm mb-0 "   target="">+&nbsp; Thêm</a>&nbsp;
                                                <button type="button" class="btn btn-outline-primary btn-sm mb-0"data-bs-toggle="modal" data-bs-target="#import">Thêm file excel</button>&nbsp;
                                                <div class="modal fade" id="import" tabindex="-1" style="display: none;"aria-hidden="true">
                                                    <div class="modal-dialog mt-lg-10">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalLabel">Thêm file Excel</h5>
                                                                <i class="fas fa-upload ms-3" aria-hidden="true"></i>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            {{-- import data user --}}
                                                            <form action="{{route('assignment.import')}}" method="POST" enctype="multipart/form-data" >
                                                                @csrf
                                                                @method('POST')
                                                                <div class="modal-body">
                                                                    <p>Thêm file excel từ máy của bạn vào đây.</p>
                                                                    <input type="file" placeholder="Browse file..."class="form-control mb-3"  accept=".xlsx" name="file">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"class="btn bg-gradient-secondary btn-sm"data-bs-dismiss="modal">Đóng</button>
                                                                    <button type="submit"class="btn bg-gradient-primary btn-sm" name="import_excel">Thêm</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                                   
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
                                                        Ngày bắt đầu</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Ngày kết thúc</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Actions</th>
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
    @include('management.assignment.modal_detail')
@endsection
@push('js')
<script>
    function handleClick(id) {
        // Sử dụng giá trị slug ở đây
        $.ajax({
            url: '{!! route('assignment.detail') !!}', // Đường dẫn tới API hoặc tập lệnh xử lý dữ liệu trên máy chủ
            type: 'GET',
            data: { assignment: id },
            success: function(response) {
                // Cập nhật nội dung của modal với dữ liệu từ phản hồi
                var title = 'Lịch phân công của: ' + response.date['user_name'] + ' ' + response.date['date_start'] + '-'  + response.date['date_end'];
                var arrExists = response.hasOwnProperty('arr') && Object.keys(response.arr).length > 0;
                var arrShiftExists = response.hasOwnProperty('arr_shift') && Object.keys(response.arr_shift).length > 0;
                //console.log(arrExists);
                if (arrExists && arrShiftExists) {
                    $('#title_assignment_detail').text(title);

                    renderData(response); // Gọi hàm để render dữ liệu
                } else {
                    $('#title_assignment_detail').text(title);
                    $('#assignment-detail-table tbody').empty(); // Xóa dữ liệu cũ trong bảng
                    $('#assignment-detail-table tbody').append('<tr><td colspan="5" class="text-center">Không tìm thấy dữ liệu</td></tr>'); // Thêm thông báo không tìm thấy dữ liệu vào bảng
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function renderData(data) {
        // Xóa dữ liệu cũ trong bảng
        $('#assignment-detail-table tbody').empty();
        $('#assignment-detail-table thead').empty();
        // Thêm dữ liệu mới vào bảng
        var headerRow = $('<tr>').append($('<th>').text('Ca/Thứ')); // Thêm cột cho shift
        $.each(data.arr_day, function(index, item) {

            headerRow.append($('<th>').text(item.name));
        });
        $('#assignment-detail-table thead').append(headerRow);
        $.each(data.arr_shift, function(index, shift) {
            var row = $('<tr>').append($('<td>').text(shift.name)); // Thêm cột cho tên ca làm việc

            // Kiểm tra nếu có dữ liệu phòng cho ca và ngày làm việc
            var hasRoomData = false;
            $.each(data.arr_day, function(index_day, day) {
                if (data.arr[index] && data.arr[index][day.name]) {
                    //hasRoomData = true;
                    row.append($('<td>').text(data.arr[index][day.name].room));
                } else {
                    row.append($('<td>').text('')); // Thêm ô trống
                }
            });

            // Nếu không có dữ liệu phòng cho bất kỳ ca nào, không thêm hàng vào bảng
            //if (hasRoomData) {
                $('#assignment-detail-table tbody').append(row);
            //}
        });
    }

</script>
    <script>
        var columns = [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'full_name',
                name: 'full_name'
            },
            {
                data: 'date_start',
                name: 'date_start'
            },
            {
                data: 'date_end',
                name: 'date_end'
            },
            {
                data: 'action',
                name: 'action'
            },

        ];
        setTimeout(function(){
            renderTable("{!! route('assignment.index') !!}", columns);
        }, 500);

    </script>

@endpush
