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
                                                <a href="{{ route('manufacturer.create') }}" class="btn bg-gradient-primary btn-sm mb-0 "   target="">+&nbsp; Thêm</a>&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dataTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên nhà sản xuất</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nước sản xuất</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Địa chỉ Email</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số điện thoại</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tác vụ</th>
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
                data: 'name',
                name: 'name'
            },
            {
                data: 'address',
                name: 'address'
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
        renderTable("{!! route('manufacturer.index') !!}", columns);
    </script>
@endpush
