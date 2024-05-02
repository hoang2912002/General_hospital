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


        @media (min-width: 200px) {
            #modal-waiting-patient .modal-dialog {
                max-width: 36.66667%;
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
                                            <h5 class="mb-0">{{ $name_page['total'] }}</h5>
                                        </div>
                                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                                            <div class="ms-auto my-auto d-flex">
                                                <a href="{{ route('room.create') }}" class="btn bg-gradient-primary btn-sm mb-0 "   target="">+&nbsp; Thêm</a>&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dataTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên phòng</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên khoa</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Chức năng</th>
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
    @include('management.number.modal_waiting_patient')
    @include('management.number.create_waiting_patient')
@endsection
@push('js')
    <script>
        function handleClick(id) {
            // Sử dụng giá trị slug ở đây
            console.log('Slug:', id);

            // Ví dụ: Mở modal với slug làm tham số
            $.ajax({
                url: '{!! route('number.render_waiting_patient') !!}', // Đường dẫn tới API hoặc tập lệnh xử lý dữ liệu trên máy chủ
                type: 'GET',
                data: { room_id: id },
                dataType: 'json',
                success: function(response) {
                    // Cập nhật nội dung của modal với dữ liệu từ phản hồi
                    console.log(response);
                    if (response.length > 0) {
                        $('#modal-waiting-patient-room-name').text('Khoa: ' + response[0].room.department.name + ' - Phòng: ' + response[0].room.name);
                        $('#room_id').val(response[0].room_id);
                        renderData(response); // Gọi hàm để render dữ liệu
                    } else {
                        $('#modal-waiting-patient-room-name').text('Khoa: ' + response.department + ' - Phòng: ' + response.room);
                        $('#room_id').val(response.room_id);
                        $('#waiting-patient-table tbody').empty(); // Xóa dữ liệu cũ trong bảng
                        $('#waiting-patient-table tbody').append('<tr><td colspan="5" class="text-center">Không tìm thấy dữ liệu</td></tr>'); // Thêm thông báo không tìm thấy dữ liệu vào bảng
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
        function renderData(data) {
            // Xóa dữ liệu cũ trong bảng
            $('#waiting-patient-table tbody').empty();

            // Thêm dữ liệu mới vào bảng
            $.each(data, function(index, item) {
                var statusText = (item.status == 1) ? 'Đang chờ' : 'Đã khám';
                var badgeClass = (item.status == 1) ? 'badge-success' : 'badge-danger';
                var badgeElement = $('<span>').addClass('badge badge-sm ' + badgeClass).text(statusText);

                var row = $('<tr>').append(
                    $('<td>').text(item.number),
                    $('<td>').append(badgeElement),
                );
                $('#waiting-patient-table tbody').append(row);
            });
        }
        $('#create_waiting_patient').on('click',function(){
            $.ajax({
                type: "GET",
                url: '{!! route('number.create_waiting_patient') !!}',
                data: {
                    room_id: $('#room_id').val(),
                },
                success: function (response) {
                    window.location.href = response.pdfRoute;
                    // Load lại trang hiện tại sau 1 giây (1000ms)
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            });
        })
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
                data: 'department',
                name: 'department'
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
            renderTable("{!! route('number.ticket') !!}", columns);
        }, 500);
    </script>

@endpush
