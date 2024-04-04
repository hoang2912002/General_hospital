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
                                                <a href="{{ route('equipment_category.create') }}" class="btn bg-gradient-primary btn-sm mb-0 "   target="">+&nbsp; Thêm </a>&nbsp;
                                                <button  class="btn bg-gradient-primary btn-sm mb-0 " id="update_medicalequipment"  type="button" target="">+&nbsp; Cập nhật</button>&nbsp;

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dataTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                                        <div class="form-check">
                                                            <input class="form-check-input " type="checkbox" value="all"
                                                                id="all" name="all">
                                                        </div>
                                                    </th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ảnh</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày sản xuất</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hạn sử dụng</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số lượng</th>
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
        let token = $('meta[name="csrf-token"]').attr('content');
        let arr_checkbox = [];
        //Automatic check children
        $('input[name^="all"]').on('change',function (e) {
            e.preventDefault();
            var all = $('input[type="checkbox"]');
            var input_name_all = $('input[name^="all"]');
            if(input_name_all.is(':checked')) {
                all.prop('checked', true);
            }
            else{
                all.prop('checked', false);
            }
        });
        $('#update_medicalequipment').on('click', function (e) {
            let checkbox = $('input[type="checkbox"]:checked');
            arr_checkbox = [];
            if(checkbox.val() != null){
               checkbox.each(function (indexInArray, valueOfElement) {
                console.log(valueOfElement);
                if(valueOfElement.value != $('input[name^="all"]').val()){
                    arr_checkbox[indexInArray] = valueOfElement.value;
                }
            });
            console.log('dsds',arr_checkbox.filter(Boolean));
            $.ajax({
                headers: {
                    token
                },
                type: "POST",
                url: "{{ route('equipment_category.medicalEquipments_api', $equipmentCategoryModel) }}",
                data: {
                    'arr' : arr_checkbox.filter(Boolean),
                },
                success: function (response) {
                    window.location.href = "{{route('equipment_category.medicalEquipments_edit',$equipmentCategoryModel)}}";
                }
            });
            }
        });
    </script>
    <script>

        var columns = [
            {
                data: 'checkbox',
                name: 'checkbox'
            }
            ,
            {
                data: 'image',
                name: 'image'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'production_date',
                name: 'production_date'
            },
            {
                data: 'exp_date',
                name: 'exp_date'
            },
            {
                data: 'quantity',
                name: 'quantity'
            },
            {
                data: 'action',
                name: 'action'
            },

        ];
        renderTable("{!! route('equipment_category.medicalEquipments',$equipmentCategoryModel) !!}", columns,false);
    </script>

@endpush
