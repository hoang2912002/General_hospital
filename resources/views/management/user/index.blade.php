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
                                    {{-- <div class="card-header d-flex justify-content-between pb-0">
                                        <h5 class="mb-0">{{ $name_page['total'] }}</h5>
                                        <a href="{{ route('user.create') }}" class="btn btn-primary ">
                                            <span>Thêm </span>
                                        </a>

                                    </div> --}}
                                    <div class="card-header  d-flex justify-content-between pb-0">
                                        <div>
                                            <h5 class="mb-0">All Products</h5>
                                            <p class="text-sm mb-0">
                                                A lightweight, extendable, dependency-free javascript HTML table plugin.
                                            </p>
                                        </div>
                                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                                            <div class="ms-auto my-auto d-flex">
                                                <a href="{{ route('user.create') }}" class="btn bg-gradient-primary btn-sm mb-0 "   target="">+&nbsp; Thêm</a>&nbsp;
                                                <button type="button" class="btn btn-outline-primary btn-sm mb-0"data-bs-toggle="modal" data-bs-target="#import">Import</button>&nbsp;
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
                                                                    <button type="button"class="btn bg-gradient-secondary btn-sm"data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"class="btn bg-gradient-primary btn-sm" name="import_excel">Upload</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                    <form action="{{route('user.export')}}" method="POST"  class="ms-auto my-auto" >
                                                        @csrf
                                                        @method('POST')
                                                        <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1"data-type="csv" type="submit" name="export_excel">Export</button>
                                                    </form>


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
                                                        First name</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Last name</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Gender</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Date of birth</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Email</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Phone number</th>
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
