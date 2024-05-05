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
                                            <h5 class="mb-0">{{ $name_page['name'] }}</h5>
                                            <p class="text-sm mb-0">

                                            </p>
                                        </div>
                                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                                            <div class="ms-auto my-auto d-flex">
                                                <a href="{{ route('patient.create') }}" class="btn bg-gradient-primary btn-sm mb-0 "   target="">+&nbsp; Thêm bệnh nhân mới</a>&nbsp;
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
                                                        UUID</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Họ</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Tên</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Giới tính</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Ngày sinh</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Email</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Số điện thoại</th>
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
                data: 'uuid',
                name: 'uuid'
            },
            {
                data: 'last_name',
                name: 'last_name'
            },
            {
                data: 'first_name',
                name: 'first_name'
            },
            {
                data: 'gender',
                name: 'gender'
            },
            {
                data: 'dob',
                name: 'dob'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'phone_number',
                name: 'phone_number'
            },
            {
                data: 'action',
                name: 'action'
            },

        ];
        setTimeout(function(){
            renderTable("{!! route('patient.patient_list',$numberModel) !!}", columns);
        }, 500);
    </script>

@endpush
