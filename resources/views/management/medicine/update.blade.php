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
    </style>
@endpush

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
                                        <span>Thông tin thuốc</span>
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
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">Thêm thông tin thuốc</h5>
                                <p class="mb-0 text-sm">Thêm thông tin</p>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <label>Tên thuốc</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                placeholder="eg. Michael" name="name" id="name"
                                                value="{{  $medicineModel->name  ?? old('name')  }}">
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
                                            <label>Giá</label>
                                            <input class="multisteps-form__input form-control" type="text" id="price"
                                                placeholder="10.000VNĐ" name="price"
                                                value="{{  $medicineModel->price  ?? old('price')  }}">
                                            @error('price')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <label>Số lượng</label>
                                            <input class="multisteps-form__input form-control" type="text" id="quantity"
                                                placeholder="" name="quantity"
                                                value="{{  $medicineModel->quantity  ?? old('quantity')  }}">
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
                                            <label>Loại thuốc</label>
                                            <select class="form-control" name="category" id="choices-category" >
                                                <option value="">Chọn loại thuốc ...</option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}" @if ($medicineModel->category_id === $item->id)
                                                        @selected(true)
                                                    @endif>{{ $item->name }}</option>
                                                @endforeach

                                            </select>
                                            @error('category')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <label>Nhà sản xuất</label>
                                            <select class="form-control" name="manufacturer" id="choices-manufacturer" >
                                                <option value="">Chọn nhà sản xuất ...</option>
                                                @foreach ($manufacturers as $item)
                                                    <option value="{{ $item->id }}" @if ($medicineModel->manufacturer_id === $item->id)
                                                        @selected(true)
                                                    @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('manufacturer')
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
                                            <input class="multisteps-form__input form-control" type="date" name="imp_date" id="imp_date" value="{{  $medicineModel->imp_date  ?? old('imp_date') }}">
                                            @error('imp_date')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <label>Hạn sử dụng</label>
                                            <input class="multisteps-form__input form-control" type="date" name="exp_date" id="exp_date" value="{{  $medicineModel->exp_date  ?? old('exp_date') }}">
                                            @error('exp_date')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <label class="">Thông tin chi tiết</label>
                                            <p class="form-text text-muted text-xs ms-1 d-inline">
                                            (optional)
                                            </p>
                                            <div id="edit-deschiption" class="h-50">
                                                @if (!empty($medicineModel->description))
                                                    {!! html_entity_decode($medicineModel->description) !!}
                                                @else
                                                    <p>Some initial <strong>bold</strong> text</p>
                                                @endif
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
                                                        <div class="form-control dropzone dz-clickable"
                                                            id="medicine-image">

                                                            <div class="fallback">
                                                                <input name="file[]" type="file" />
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
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault23" checked="" onchange="visible()"
                                                    name="activated" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                            id="medicine-button" title="create">Cập nhật</button>
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
        var arr_image_medicine = [];
        var uploadedDocumentMap = {};
        let token = $('meta[name="csrf-token"]').attr('content');
        $(function() {
            //medicine_image
            var myDropzone = new Dropzone('#medicine-image', {
                paramName: "file",
                url: '{!! route('medicine.save_image') !!}',
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
                    // console.log('success file');
                    // console.log(file);
                    // console.log('dsafsaf',response.name);
                    $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">');
                    //console.log($("input[name=file[]]").prop('type','hidden'));
                    uploadedDocumentMap[file.name] = response.name;
                    arr_image_medicine = jQuery.grep(arr_image_medicine, function(value) {
                        console.log('success',value == 'img/general_hospital/management/medicine_image/' + response.name);
                        return value != 'img/general_hospital/management/medicine_image/' + response.name;
                    });
                },
                removedfile: function(file) {
                    // console.log('remove calls');
                    // console.log('remove file');
                    // console.log(file);
                    // remove uploaded file from table and storage folder starts
                    var filename = ''
                    if (file.hasOwnProperty('upload')) {
                        filename = file.upload.filename;
                    } else {
                        filename = file.name;
                    }
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('medicine.delete_image', $medicineModel->slug) }}',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {
                            filename: arr_image_medicine,
                        },
                        success: function(data) {
                            //console.log('removed success: ' + data);

                        }
                    });
                    // remove file name from uploadedDocumentMap object
                    Reflect.deleteProperty(uploadedDocumentMap, file.name);

                    file.previewElement.remove();
                    //console.log('fsdfds',file.name,arr_image_medicine);
                    // arr_image_medicine = jQuery.grep(arr_image_medicine, function(value) {
                    //     console.log('trong remove',value, '---------------' , 'img/general_hospital/management/medicine_image/' + file.name);
                    //     return value != 'img/general_hospital/management/medicine_image/' + file.name;
                    // });
                    arr_image_medicine.splice(0, 1)
                    console.log('array_',arr_image_medicine);
                    removeElement(arr_image_medicine, file.name);
                    $('form').find('input[name="file[]"][value="' + filename + '"]').remove();
                },

                init: function() {
                    //console.log('init calls');
                    myDropzone = this;
                    // Read Files from tables and storage folder starts
                    $.ajax({
                        url: "{{ route('medicine.readFiles', $medicineModel->slug) }}",
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
                                    arr_image_medicine.push('img/general_hospital/management/medicine_image/'+value.name);
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
                    console.log('dsds',response);
                    if (response.status == "success") {
                       arr_image_medicine.push(response.medicine_image)
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
                    url: "{{ route('medicine.update', $medicineModel->slug) }}",
                    data: {
                        'arr': arr,
                    },
                    success: function(result) {
                        var url = "{{ route('medicine.index') }}"
                            window.location.href = url;
                            myDropzone.processQueue();

                    }
                });
                //});
            });
        })

    </script>
@endpush
