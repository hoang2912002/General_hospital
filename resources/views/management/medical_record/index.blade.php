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
                                                <a href="{{ route('medicalrecord.create') }}" class="btn bg-gradient-primary btn-sm mb-0 "   target="">+&nbsp; Thêm bệnh nhân mới</a>&nbsp;
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
        renderTable("{!! route('medicalrecord.index',$userModel->uuid) !!}", columns);
    </script>
    <script>
        //  if (document.getElementById('dataTable')) {
        //     const dataTableSearch = new simpleDatatables.DataTable("#dataTable", {
        //         searchable: true,
        //         fixedHeight: false,

        //     });

        //     document.querySelectorAll(".export").forEach(function(el) {
        //         el.addEventListener("click", function(e) {
        //         var type = el.dataset.type;

        //         var data = {
        //             type: type,
        //             filename: "soft-ui-" + type,
        //         };

        //         if (type === "csv") {
        //             data.columnDelimiter = "|";
        //         }

        //         dataTableSearch.export(data);
        //         });
        //     });
        //     };
    </script>
@endpush
