@extends('management.layout.main')
@include('management.layout.form')
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
{{-- @section('content')
<div class="accordion-1">
    <div class="container">
      <div class="row my-5">
        <div class="col-md-6 mx-auto text-center">
          <h2>Frequently Asked Questions</h2>
          <p>A lot of people don’t appreciate the moment until it’s passed. I'm not trying my hardest, and I'm not trying to do </p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-10 mx-auto">
          <div class="accordion" id="accordionRental">
            <div class="accordion-item mb-3">
              <h5 class="accordion-header" id="headingOne">
                <button class="accordion-button border-bottom font-weight-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  How do I order?
                  <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                  <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                </button>
              </h5>
              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionRental" style="">
                <div class="accordion-body text-sm opacity-8">
                  We’re not always in the position that we want to be at. We’re constantly growing. We’re constantly making mistakes. We’re constantly trying to express ourselves and actualize our dreams. If you have the opportunity to play this game
                  of life you need to appreciate every moment. A lot of people don’t appreciate the moment until it’s passed.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection --}}
@section('content')
    <div class="row mb-12">
        <div class="col-12">
            <div class="multisteps-form mb-8">

                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="multisteps-form__progress">
                                    <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                        <span>{{ $equipmentCategoryModel->name }}</span>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <form class="multisteps-form__form mb-8" action="{{ route('medicine.store') }}" method="POST"
                            name="form-medicine" id="form-medicine" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card multisteps-form__panel p-3 border-radius-xl  js-active"
                                data-animation="FadeIn">
                                <div class="col-12 mx-auto">
                                    <div class="accordion" id="accordionRental">
                                        @if (!empty($arr_update_medical_equipments))
                                            @foreach ($arr_update_medical_equipments as $item => $value)

                                                <div class="accordion-item mb-3">
                                                    <h5 class="font-weight-bolder mb-0 accordion-header" id="heading{{ $item }}">
                                                        <button
                                                            class="accordion-button border-bottom font-weight-bold collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapse{{ $item }}" aria-expanded="false"
                                                            aria-controls="collapse{{ $item }}">
                                                            {{ $value->name }}
                                                            <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                                                aria-hidden="true"></i>
                                                            <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3"
                                                                aria-hidden="true"></i>
                                                        </button>
                                                    </h5>
                                                    <div id="collapse{{ $item }}" class="accordion-collapse collapse"
                                                        aria-labelledby="heading{{ $item }}" data-bs-parent="#accordionRental"
                                                        style="">
                                                        <div class="accordion-body text-sm opacity-8">
                                                            <div class="multisteps-form__content">
                                                                <div class="row mt-3">
                                                                    <div class="col-12 col-sm-12">
                                                                        <label>Tên thiết bị y tế</label>
                                                                        <input class="multisteps-form__input form-control"
                                                                            type="text" placeholder="eg. Michael"
                                                                            name="name" id="name"
                                                                            value="{{ $value->name ?? old('name')  }}">
                                                                        @error('name')
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
                                                                            <option value="1">Còn</option>
                                                                            <option value="0">Hết</option>
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
                                                                            value="{{ $value->quantity ?? old('quantity') }}">
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
                                                                            type="date" name="production_date" id="production_date" value="{{ $value->production_date ?? old('production_date') }}">
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
                                                                            type="date" name="exp_date" id="exp_date" value="{{ $value->exp_date ?? old('exp_date') }}">
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
                                                                            {!! $value->note !!}
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
                                                                                    <input type="hidden" id="id_medical_equipment" value="{{ $value->id }}">
                                                                                    <div class="form-control dropzone dz-clickable"
                                                                                        id="image{{ $value->id }}">

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
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="row mt-3">
                                                <div class="col-sm-auto  d-flex">
                                                    <label class="form-check-label mb-0">
                                                        <small id="profileVisibility">Activated</small>
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
                                                    type="button" id="medicine-button"
                                                    title="create">Create</button>
                                            </div>
                                        @endif

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
        $('div[id^="edit-deschiption"]').each(function() {
        // Khởi tạo Quill cho mỗi phần tử textarea
        var quill = new Quill($(this)[0], {
            theme: 'snow' // Specify theme in configuration
        });
    });
    </script>
    <script>
        Dropzone.autoDiscover = false;
        var arr_image_medicine = [];
        var uploadedDocumentMap = {};
        let token = $('meta[name="csrf-token"]').attr('content');
        $(".dropzone").each(function(){
            //medicine_image
            var dropzoneId = $(this).attr('id');
            var myDropzone = new Dropzone('#' + dropzoneId , {
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
                    console.log('sussess',response);
                    // $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">');
                    // uploadedDocumentMap[file.name] = response.name;
                    // arr_image_medicine = jQuery.grep(arr_image_medicine, function(value) {
                    //     console.log('success',value == 'img/general_hospital/management/medical_equipment/' + response.name);
                    //     return value != 'img/general_hospital/management/medical_equipment/' + response.name;
                    // });
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
                        url: "{{ route('equipment_category.delete_image', $equipmentCategoryModel->slug) }}",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {
                            filename: arr_image_medicine,
                            id: $('#' + dropzoneId).closest('.col-12').find('#id_medical_equipment').val()
                        },
                        success: function(data) {
                            //console.log('removed success: ' + data);

                        }
                    });
                    // remove file name from uploadedDocumentMap object
                    Reflect.deleteProperty(uploadedDocumentMap, file.name);
                    file.previewElement.remove();
                    arr_image_medicine.splice(0, 1)
                    console.log('array_',arr_image_medicine);
                    removeElement(arr_image_medicine, file.name);
                    $('form').find('input[name="file[]"][value="' + filename + '"]').remove();
                },

                init: function() {
                    //console.log(inputElement = $('#' + dropzoneId).closest('.col-12').find('#id_medical_equipment').val());
                    myDropzone = this;
                    // Read Files from tables and storage folder starts
                    $.ajax({
                        url: "{{ route('equipment_category.readFiles', $equipmentCategoryModel->slug) }}",
                        type: 'get',
                        data:{
                            'id':$('#' + dropzoneId).closest('.col-12').find('#id_medical_equipment').val(),
                        },
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
                                    console.log('sdsd',value.name);
                                    //arr_image_medicine.push('img/general_hospital/management/medical_equipment/'+value.name);
                                    arr_image_medicine[value.id] = 'img/general_hospital/management/medical_equipment/'+value.name;
                                    console.log('test_Arr',arr_image_medicine);
                                    //arr_image_medicine.push(value.id);
                                }
                                else{
                                    uploadedDocumentMap[value.name] =  value.name;
                                    //arr_image_medicine.push(value.image);
                                }
                            });
                        }
                    });
                },
                error:function(file, response) {
                    // error handling
                },
                success:function(file, response) {
                    //console.log('dsds',response.status == 'success',response.medicine_image);
                    if (response.status == "success") {
                       //arr_image_medicine.push(response.medicine_image)
                       arr_image_medicine[$('#' + dropzoneId).closest('.col-12').find('#id_medical_equipment').val()] = response.medicine_image;
                       console.log('trong dropzone',arr_image_medicine);
                    }
                }
            });
            //form submit
            var btn_sevice =  $('#medicine-button').on('click', function(e) {
                //myDropzone.processQueue();
                var name =$('#name').val();
                var price =$('#price').val();
                var quantity =$('#quantity').val();
                var category =$('#choices-category').find(":selected").val();
                var manufacturer =$('#choices-manufacturer').find(":selected").val();
                var imp_date =$('#imp_date').val();
                var exp_date =$('#exp_date').val();
                var description = $('#edit-deschiption').find('.ql-editor').get(0).outerHTML;
                var imagelength = Object.keys(uploadedDocumentMap).length;
                console.log('fsdfsd',arr_image_medicine)

                var arr =
                {
                    'name': name,
                    'price': price,
                    'quantity': quantity,
                    'category_id': category,
                    'manufacturer_id': manufacturer,
                    'imp_date': imp_date,
                    'exp_date': exp_date,
                    'description':   description ,
                    'image': arr_image_medicine[0]
                };
                console.log(arr,arr_image_medicine);
                e.preventDefault();
                $.ajax({
                    headers: {
                        token
                    },
                    type: 'PATCH',
                    url: "{{ route('medicine.update', $equipmentCategoryModel->id) }}",
                    data: {
                        'arr': arr,
                    },
                    success: function(result) {
                        var url = "{{ route('medicine.index') }}"
                            window.location.href = url;
                            myDropzone.processQueue();

                    }
                });
            });
        })

    </script>
@endpush
