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
                                            <h5 class="mb-0">{{ $name_page['name'] }}</h5>

                                        </div>
                                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                                            <div class="ms-auto my-auto d-flex">
                                                <a href="{{ route('equipment_category.create') }}" class="btn bg-gradient-primary btn-sm mb-0 "   target="">+&nbsp; Thêm</a>&nbsp;
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
                                                            <form action="{{route('user.import')}}" method="POST" enctype="multipart/form-data" >
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

                                                    <form action="{{route('user.export')}}" method="POST"  class="ms-auto my-auto" >
                                                        @csrf
                                                        @method('POST')
                                                        <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1"data-type="csv" type="submit" name="export_excel">Xuất file excel</button>
                                                    </form>


                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dataTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Slug</th>
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
                data: 'slug',
                name: 'slug'
            },
            {
                data: 'action',
                name: 'action'
            },

        ];
        renderTable("{!! route('equipment_category.index') !!}", columns);
    </script>
@endpush
