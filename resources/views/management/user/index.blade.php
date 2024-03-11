@extends('management.layout.main')
@include('management.layout.table')
@push('css')

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
                                    <div class="card-header d-flex justify-content-between pb-0">
                                        <h5 class="mb-0">{{ $name_page['total'] }}</h5>
                                        <a href="{{ route('user.create') }}" class="btn btn-primary ">
                                            <span>Thêm </span>
                                        </a>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dataTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">UUID</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First name</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last name</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date of birth</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone number</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
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
                data: 'first_name',
                name: 'first_name'
            },
            {
                data: 'last_name',
                name: 'last_name'
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
        renderTable("{!! route('user.index') !!}", columns);
    </script>
@endpush
