@extends('management.layout.main')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/admin/css/prescription.css') }}">
    <style>
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
    </style>
@endpush
@section('content')
    @if (Auth::user()->User->group_user[0]->slug === 'quan-ly')
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card  mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Bệnh nhân</p>
                                            <h5 class="font-weight-bolder">
                                                <span class="small"></span>
                                                <span id="state1" countto="{{ $patient }}">{{ $patient }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card  mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Đội ngũ bác sĩ</p>
                                            <h5 class="font-weight-bolder">
                                                <span class="small"></span>
                                                <span id="state2" countto="{{ $doctor }}">{{ $doctor }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card  mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Thu nhập</p>
                                            <h5 class="font-weight-bolder">
                                                <span id="state3" countto="{{ $bill }}">{{ (!empty($bill)) ? number_format($bill,'0',".",".") : ''}}</span>
                                                <span class="small">VNĐ</span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                            <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3 col-md-6 col-12">
                        <div class="card  mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Sales</p>
                                            <h5 class="font-weight-bolder">
                                                $103,430
                                            </h5>
                                            <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">+5%</span> than last
                                                month
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    @endif

    <div class="row mt-4">
        <div class="col-12 col-md-10 mb-4 mb-md-0">
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Function</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Technology</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Employed</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg"
                                                class="avatar avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">John Michael</h6>
                                            <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">Manager</p>
                                    <p class="text-xs text-secondary mb-0">Organization</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm badge-success">Online</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                </td>
                                <td class="align-middle">
                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-3.jpg"
                                                class="avatar avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">Alexa Liras</h6>
                                            <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">Programator</p>
                                    <p class="text-xs text-secondary mb-0">Developer</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm badge-secondary">Offline</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                                </td>
                                <td class="align-middle">
                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-4.jpg"
                                                class="avatar avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">Laurent Perrier</h6>
                                            <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">Executive</p>
                                    <p class="text-xs text-secondary mb-0">Projects</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm badge-success">Online</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">19/09/17</span>
                                </td>
                                <td class="align-middle">
                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-3.jpg"
                                                class="avatar avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">Michael Levi</h6>
                                            <p class="text-xs text-secondary mb-0">michael@creative-tim.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">Programator</p>
                                    <p class="text-xs text-secondary mb-0">Developer</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm badge-success">Online</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">24/12/08</span>
                                </td>
                                <td class="align-middle">
                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg"
                                                class="avatar avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">Richard Gran</h6>
                                            <p class="text-xs text-secondary mb-0">richard@creative-tim.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">Manager</p>
                                    <p class="text-xs text-secondary mb-0">Executive</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm badge-secondary">Offline</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">04/10/21</span>
                                </td>
                                <td class="align-middle">
                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Ca làm việc</h6>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        @foreach ($shift as $item)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">{{ $item->name }}</h6>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <h6 class="mb-1 text-dark text-sm">{{ $item->hour() }}</h6>
                                </div>
                            </li>
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <h4 class="mb-1">Lịch phân công</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-12 col-md-12 col-xl-12 mt-md-0 mt-4">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('management.assignment.modal_detail')
@endsection
@push('js')
    <script src="{{ asset('asset/admin') }}/js/plugins/countup.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        if (document.getElementById('state1')) {
            const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
            if (!countUp.error) {
                countUp.start();
            } else {
                console.error(countUp.error);
            }
        }
        if (document.getElementById('state2')) {
            const countUp = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
            if (!countUp.error) {
                countUp.start();
            } else {
                console.error(countUp.error);
            }
        }
        if (document.getElementById('state3')) {
            const countUp = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
            if (!countUp.error) {
                countUp.start();
            } else {
                console.error(countUp.error);
            }
        }
        if (document.getElementById('state4')) {
            const countUp = new CountUp('state4', document.getElementById("state4").getAttribute("countTo"));
            if (!countUp.error) {
                countUp.start();
            } else {
                console.error(countUp.error);
            }
        }
    </script>

    <script type="text/javascript">
        function getEvent() {
            $.ajax({
                url: '{{ route('assignment.render_calender') }}',
                type: 'POST',
                data: {
                    staff_uuid: '{{ Auth::user()->user->uuid ?? null }}'
                },
                success: function(data) {
                    var result = data.arr;
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        customButtons: {
                            scheduleDetails: {
                                text: 'Lịch phân công',
                                click: function() {
                                    //var jsonData = JSON.stringify(data);//chuyển data thành json
                                    $.ajax({
                                        url: '{{ route('assignment.detail') }}',
                                        type: 'GET',
                                        data: {
                                            staff_uuid: '{{ Auth::user()->user->uuid ?? null }}'
                                        },
                                        success: function(response) {
                                            myModal = new bootstrap.Modal(document
                                                .getElementById(
                                                    'modal-detail-assignment'));

                                            myModal.show();
                                            console.log(response);
                                            var title = 'Lịch phân công của: ' +
                                                response.date['user_name'] + ' ' +
                                                response.date['date_start'] + '-' +
                                                response.date['date_end'];
                                            var arrExists = response.hasOwnProperty(
                                                    'arr') && Object.keys(response.arr)
                                                .length > 0;
                                            var arrShiftExists = response
                                                .hasOwnProperty('arr_shift') && Object
                                                .keys(response.arr_shift).length > 0;
                                            //console.log(arrExists);
                                            if (arrExists && arrShiftExists) {
                                                $('#title_assignment_detail').text(
                                                    title);

                                                renderData(
                                                response); // Gọi hàm để render dữ liệu
                                            } else {
                                                $('#title_assignment_detail').text(
                                                    title);
                                                $('#assignment-detail-table tbody')
                                                    .empty(); // Xóa dữ liệu cũ trong bảng
                                                $('#assignment-detail-table tbody')
                                                    .append(
                                                        '<tr><td colspan="5" class="text-center">Không tìm thấy dữ liệu</td></tr>'
                                                        ); // Thêm thông báo không tìm thấy dữ liệu vào bảng
                                            }
                                        },
                                    });
                                }
                            },
                        },
                        contentHeight: 'auto',
                        locale: 'vi',
                        initialView: 'dayGridMonth',
                        initialDate: '<?= date('Y-m-d') ?>',
                        headerToolbar: {
                            left: 'prev,next today,scheduleDetails',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay',
                        },
                        navLinks: true,
                        selectable: true,
                        weekNumbers: true,
                        dayMaxEvents: true,
                    });
                    $.each(result, function(index_date_start, sub_arr) {
                        $.each(sub_arr, function(index_date_end, sub_arr_2) {
                            $.each(sub_arr_2, function(indexInArray, sub_arr_3) {
                                $.each(sub_arr_3, function(index_sub_arr_3, eventData) {
                                    console.log(eventData.room_name);
                                    var room_id = eventData.room_id;
                                    var room_name = eventData.room_name;
                                    var startDate = index_date_start;
                                    var endDate = index_date_end;
                                    var startDateTime = eventData.start_time;
                                    var endDateTime = eventData.end_time;
                                    var day = indexInArray;
                                    // Khởi tạo biến thời gian
                                    var currentDate = moment(startDate).startOf('day');
                                    var endTime = moment(endDate).endOf('day');

                                    // Hàm tạo sự kiện
                                    function createEvent(startHour, startMinute, endHour, endMinute) {
                                        var startDateTime = moment(currentDate).set({
                                            'hour': startHour,
                                            'minute': startMinute
                                        });
                                        var endDateTime = moment(currentDate).set({
                                            'hour': endHour,
                                            'minute': endMinute,
                                        });

                                        // Kiểm tra nếu endDateTime là 05:30
                                        if (endDateTime.hours() === 5 && endDateTime.minutes() === 30) {
                                            // Cập nhật ngày thành ngày tiếp theo
                                            endDateTime.add(1, 'day');

                                        }
                                        // Thêm sự kiện vào lịch
                                        calendar.addEvent({
                                            title: eventData.shift_name + ' phòng: ' + eventData
                                                .room_name,
                                            start: startDateTime.format(),
                                            end: endDateTime.format(),
                                            extendedProps: eventData
                                        });
                                    }

                                    // Lặp qua mỗi ngày trong khoảng thời gian
                                    while (currentDate <= endTime) {
                                        // Kiểm tra xem ngày hiện tại có trong danh sách ngày cần hiển thị sự kiện không
                                        if (day.includes((currentDate.day()).toString())) {
                                            var startTimeParts = startDateTime.split(':');
                                            var startHour = parseInt(startTimeParts[0]);
                                            var startMinute = parseInt(startTimeParts[1]);

                                            var endTimeParts = endDateTime.split(':');
                                            var endHour = parseInt(endTimeParts[0]);
                                            var endMinute = parseInt(endTimeParts[1]);

                                            // Tạo sự kiện
                                            createEvent(startHour, startMinute, endHour, endMinute);
                                        }
                                        currentDate.add(1, 'days'); // Chuyển sang ngày tiếp theo
                                    }
                                })

                            });
                                // Lấy thông tin từ dữ liệu trả về


                        });
                    });

                    calendar.render();
                }
            });
        }
        setTimeout(function() {
            getEvent();
        }, 250);

        function renderData(data) {
            console.log(data);
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
@endpush
