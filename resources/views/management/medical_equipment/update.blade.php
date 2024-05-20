@extends('management.layout.main')
@include('management.layout.form')
@push('css')
@push('css')
    <style>
        input[type="file"] {
            display: block;
        }

        .imageThumb {
            height: auto;
            max-height: 130px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .remove:hover {
            background: white;
            color: black;
        }

        .dz-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .footer {
            position: fixed;
            bottom: 0;

            width: 100%;
            padding: 10px;
        }
    </style>
@endpush
@endpush
@section('content')
    <div class="row mb-5">
        <div class="col-12">
            <div class="multisteps-form mb-5">

                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="multisteps-form__progress">
                                    <button class="multisteps-form__progress-btn js-active" type="button"
                                        title="User Info">
                                        <span>{{ $name_page['name']    }}</span>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <form class="multisteps-form__form mb-8" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">{{ $name_page['name'] }}</h5>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Số series</label>

                                            <input class="multisteps-form__input form-control"
                                                type="text" placeholder="eg. Michael"
                                                name="name" id="series"
                                                value="{{ $medicalEquipmentModel->series ?? rand(100000000,999999999)  }}" readonly>
                                            @error('series')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Tên thiết bị y tế</label>
                                            <input class="multisteps-form__input form-control"
                                                type="text" placeholder="eg. Michael"
                                                name="name" id="name"
                                                value="{{ $medicalEquipmentModel->name ??  old('name')  }}">
                                            @error('name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6 col-sm-12">
                                            <label>Loại thiết bị y tế</label>
                                            <select class="form-control" name="status"
                                                id="choices-equipment_category">
                                                <option value="">Chọn loại thết bị y tế ...
                                                </option>
                                                @foreach ($equipment_category as $item)

                                                    <option value="{{ $item->id }}" @if ($medicalEquipmentModel->equipment_category_id  === $item->id)@selected(true)@endif> {{ $item->name }} </option>
                                                @endforeach

                                            </select>
                                            @error('status')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6 col-sm-6">
                                            <label>Trạng thái</label>
                                            <select class="form-control" name="status"
                                                id="choices-medical_equipment_edit_status">
                                                <option value="">Chọn trạng thái ...
                                                </option>
                                                <option value="1" @if ($medicalEquipmentModel->status === 1)@selected(true)@endif>Còn</option>
                                                <option value="0" @if ($medicalEquipmentModel->status === 0)@selected(true)@endif>Hết</option>
                                            </select>
                                            @error('status')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <label>Số lượng</label>
                                            <input class="multisteps-form__input form-control"
                                                type="text" id="quantity" placeholder=""
                                                name="quantity"
                                                value="{{ $medicalEquipmentModel->quantity ??  old('quantity') }}">
                                            @error('quantity')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6 col-sm-6">
                                            <label>Ngày nhập</label>
                                            <input class="multisteps-form__input form-control"
                                                type="date" name="production_date" id="production_date" value="{{ $medicalEquipmentModel->production_date ?? old('production_date') }}">
                                            @error('production_date')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <label>Hạn sử dụng</label>
                                            <input class="multisteps-form__input form-control"
                                                type="date" name="exp_date" id="exp_date" value="{{ $medicalEquipmentModel->exp_date ?? old('exp_date') }}">
                                            @error('exp_date')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <label class="">Thông tin chi tiết</label>
                                            <p
                                                class="form-text text-muted text-xs ms-1 d-inline">
                                                (optional)
                                            </p>
                                            <div id="edit-deschiption" class="h-50 text-dark" >
                                                {!! $medicalEquipmentModel->note !!}
                                            </div>
                                            @error('edit-deschiption')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <div class="multisteps-form__content">
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <label>Ảnh</label>
                                                        <input type="hidden" id="id_medical_equipment" value="">
                                                        <div class="form-control dropzone dz-clickable"
                                                            id="image">

                                                            <div class="fallback">
                                                                <input name="image"
                                                                    type="file" multiple />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-auto  d-flex">
                                            <label class="form-check-label mb-0">
                                                <small id="profileVisibility">Kích hoạt</small>
                                            </label>
                                            <div class="form-check form-switch ms-2">
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    id="flexSwitchCheckDefault23"
                                                    checked="" onchange="visible()"
                                                    name="activated" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button
                                            class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                            type="button" id="medical-equipment-button"
                                            title="create">Cập nhật</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('asset/admin/js') }}/plugins/dropzone.min.js"></script>
    <script src="{{ asset('asset/admin/js') }}/plugins/quill.min.js"></script>
    <script>
         if (document.getElementById('edit-deschiption')) {
            var quill = new Quill('#edit-deschiption', {
                theme: 'snow' // Specify theme in configuration
            });
        };
    </script>
    <script>
        Dropzone.autoDiscover = false;
        var arr_image_medical_equipment = [];
        var uploadedDocumentMap = {};
        let token = $('meta[name="csrf-token"]').attr('content');
        $(function() {
            //medicine_image
            var myDropzone = new Dropzone('#image', {
                paramName: "file",
                url: '{!! route('equipment_category.save_image') !!}',
                uploadMultiple: true,
                maxFiles: 1,
                acceptedFiles: '.jpg, .jpeg,.png,.gif',
                autoProcessQueue: true, // myDropzone.processQueue() to upload dropped files
                addRemoveLinks: true,
                //dictRemoveFile: "Xóa ảnh",
                params: {
                    _token: token
                },
                success: function(file, response) {

                },
                removedfile: function(file) {
                    // remove uploaded file from table and storage folder starts
                    var filename = ''
                    if (file.hasOwnProperty('upload')) {
                        filename = file.upload.filename;
                    } else {
                        filename = file.name;
                    }
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('medical_equipment.delete_image', $medicalEquipmentModel->id) }}',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {
                            filename: arr_image_medical_equipment,
                        },
                        success: function(data) {
                            //console.log('removed success: ' + data);

                        }
                    });
                    // remove file name from uploadedDocumentMap object
                    Reflect.deleteProperty(uploadedDocumentMap, file.name);

                    file.previewElement.remove();

                    arr_image_medical_equipment.splice(0, 1)
                    console.log('array_',arr_image_medical_equipment);
                    removeElement(arr_image_medical_equipment, file.name);
                    $('form').find('input[name="file[]"][value="' + filename + '"]').remove();
                },

                init: function() {
                    //console.log('init calls');
                    myDropzone = this;
                    // Read Files from tables and storage folder starts
                    $.ajax({
                        url: "{{ route('medical_equipment.readFiles', $medicalEquipmentModel->id) }}",
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            $.each(response.arr, function(key, value) {
                                //console.log(response);
                                var mockFile = {
                                    name: value.name,
                                    size: value.size,
                                    accepted: true,
                                    kind: 'image'
                                };
                                if(value.size != '' && value.name != ''){
                                    myDropzone.emit("addedfile", mockFile);
                                    myDropzone.files.push(mockFile);
                                    myDropzone.emit("thumbnail", mockFile, value.image);

                                    myDropzone.emit("complete", mockFile);
                                    uploadedDocumentMap[value.name] = value.name;
                                    console.log(value.name);
                                    arr_image_medical_equipment= ['img/general_hospital/management/medical_equipment/'+value.name];
                                }
                                else{
                                    uploadedDocumentMap[value.name] =  value.name;
                                    //arr_image_medical_equipment.push(value.image);
                                }
                            });
                        }
                    });
                },
                error:function(file, response) {
                    // error handling
                },
                success:function(file, response) {
                    console.log('dsds',response);
                    if (response.status == "success") {
                       //arr_image_medical_equipment.push(response.medicine_image)
                       arr_image_medical_equipment[$('#image').closest('.col-12').find('#id_medical_equipment').val()] = response.image;
                       arr_image_medical_equipment = Object.values(arr_image_medical_equipment)
                       console.log('trong dropzone',arr_image_medical_equipment);
                    }
                }
            });
            //form submit
            var btn_sevice =  $('#medical-equipment-button').on('click', function(e) {
                //myDropzone.processQueue();
                var arr =
                {
                    'name': $('#name').val(),
                    'series': $('#series').val(),
                    'quantity': $('#quantity').val(),
                    'equipment_category_id': $('#choices-equipment_category').val(),
                    'status': $('#choices-medical_equipment_edit_status').find(":selected").val(),
                    'production_date':$('#production_date').val(),
                    'exp_date': $('#exp_date').val(),
                    'note':   $('#edit-deschiption').find('.ql-editor').get(0).outerHTML ,
                    'image': arr_image_medical_equipment[0]
                };
                console.log(arr,arr_image_medical_equipment);
                e.preventDefault();
                $.ajax({
                    headers: {
                        token
                    },
                    type: 'PATCH',
                    url: "{{ route('medical_equipment.update', $medicalEquipmentModel->id) }}",
                    data: {
                        'arr': arr,
                    },
                    success: function(result) {
                        if(result.success == true){
                            window.location.href = result.route;
                            myDropzone.processQueue();
                        }
                    }
                });
                //});
            });
        })

    </script>
@endpush
