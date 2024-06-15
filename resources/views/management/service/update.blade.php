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
                                        <span>Thông tin {{ $name_page['total'] }}</span>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">

                        <form class="multisteps-form__form mb-8" action="{{ route('service.store') }}" method="POST"
                            name="form-service" id="form-service" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">{{ $name_page['name'] }}</h5>
                                <p class="mb-0 text-sm">Thông tin {{ $name_page['total'] }}</p>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <label>Tên</label>
                                            <input type="hidden" value="{{ $serviceModel->id }}">
                                            <input class="multisteps-form__input form-control" type="text"
                                                placeholder="eg. Michael" name="name" id="name"
                                                value="{{ $serviceModel->name ??  old('name') }}">
                                            @error('name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <label>Giá</label>
                                            <input class="multisteps-form__input form-control" type="text" id="price"
                                                placeholder="10.000VNĐ" name="price"
                                                value="{{ $serviceModel->price ??  old('price') }}">
                                            @error('price')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <label>Phòng</label>
                                            <select class="form-control" name="status"
                                                id="room">
                                                <option value="">Chọn phòng dịch vụ...
                                                </option>
                                                @foreach ($room as $item)
                                                    <option value="{{ $item->id }}" @if ($serviceModel->room_id  === $item->id)@selected(true)@endif> {{ $item->name }} </option>
                                                @endforeach
                                            </select>
                                            @error('price')
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
                                            <p class="form-text text-muted text-xs ms-1 d-inline">
                                                (không bắt buộc)
                                            </p>
                                            <div id="edit-deschiption" class="h-50">
                                                {!! $serviceModel->description !!}
                                            </div>
                                            @error('edit-deschiption')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- div toggle dentist --}}

                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <div class="multisteps-form__content">
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <input type="hidden" name="input-thumbnail-service"
                                                            id="input-thumbnail-service">
                                                        <label>Icon</label>
                                                        <div class="form-control dropzone dz-clickable"
                                                            id="service-thumbnail">
                                                            <div class="fallback">
                                                                <input name="thumbnail" type="file" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <div class="multisteps-form__content">
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <label>Ảnh dịch vụ</label>
                                                        <div class="form-control dropzone dz-clickable" id="service-image">

                                                            <div class="fallback">
                                                                <input name="file[]" type="file" multiple />
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
                                            id="service-button" title="create">Thêm</button>
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
        var arr_image_service = [];
        var arr_thumbnail_service = [];
        var uploadedDocumentMap = {};
        let token = $('meta[name="csrf-token"]').attr('content');
        $(function() {
            //service thumbnail
            var myDropzoneThumbnail = new Dropzone('#service-thumbnail', {
                paramName: "file",
                url: '{!! route('service.dropzone') !!}',
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
                    $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">');
                    //console.log($("input[name=file[]]").prop('type','hidden'));
                    uploadedDocumentMap[file.name] = response.name;
                    arr_thumbnail_service = jQuery.grep(arr_thumbnail_service, function(value) {
                        console.log('success',value == 'img/general_hospital/management/service_image/' + response.name);
                        return value != 'img/general_hospital/management/service_image/' + response.name;
                    });
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
                        url: '{{ route('service.delete_thumbnail', $serviceModel->slug) }}',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {
                            filename: arr_thumbnail_service,
                        },
                        success: function(data) {}
                    });
                    // remove file name from uploadedDocumentMap object
                    Reflect.deleteProperty(uploadedDocumentMap, file.name);
                    console.log(file.name);
                    file.previewElement.remove();
                    arr_thumbnail_service.splice(0, 1)
                    console.log('array_',arr_thumbnail_service);
                    $('form').find('input[name="file[]"][value="' + filename + '"]').remove();
                },

                init: function() {
                    //console.log('init calls');
                    myDropzoneThumbnail = this;
                    // Read Files from tables and storage folder starts
                    $.ajax({
                        url: "{{ route('service.readFiles', $serviceModel->slug) }}",
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            console.log(response.arr);
                            var mockFile = {
                                name: response.arr.name,
                                size: response.arr.size,
                                accepted: true,
                                kind: 'image'
                            };
                            if(response.arr.size != '' && response.arr.name != ''){
                                myDropzoneThumbnail.emit("addedfile", mockFile);
                                myDropzoneThumbnail.files.push(mockFile);
                                myDropzoneThumbnail.emit("thumbnail", mockFile, response.arr.image);

                                myDropzoneThumbnail.emit("complete", mockFile);
                                uploadedDocumentMap[response.arr.name] = response.arr.name;
                                console.log(response.arr.name);
                                arr_thumbnail_service.push('img/general_hospital/management/service_image/'+response.arr.name);
                            }
                            else{
                                uploadedDocumentMap[response.arr.name] =  response.arr.name;
                                //arr_image_service.push(value.image);
                            }

                        }
                    });
                },
                error:function(file, response) {
                    // error handling
                },
                success:function(file, response) {
                    console.log('dsds',response);
                    if (response.status == "success") {
                        arr_thumbnail_service.push(response.service_image);
                       console.log('trong dropzone',arr_thumbnail_service);
                    }
                }
            });

            //service_image
            var myDropzoneImage = new Dropzone('#service-image', {
                paramName: "file",
                url: '{!! route('service.dropzone') !!}',
                uploadMultiple: true,
                maxFiles: 10,
                acceptedFiles: '.jpg, .jpeg,.png,.gif',
                autoProcessQueue: true, // myDropzone.processQueue() to upload dropped files
                addRemoveLinks: true,
                //dictRemoveFile: "Xóa ảnh",
                params: {
                    _token: token
                },
                success: function(file, response) {
                    $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">');
                    //console.log($("input[name=file[]]").prop('type','hidden'));
                    uploadedDocumentMap[file.name] = response.name;
                    arr_image_service = jQuery.grep(arr_image_service, function(value) {
                        console.log('success',value == 'img/general_hospital/management/service_image/' + response.name);
                        return value != 'img/general_hospital/management/service_image/' + response.name;
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
                        url: '{{ route('service.delete_thumbnail', $serviceModel->slug) }}',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {
                            filename: arr_image_service,
                        },
                        success: function(data) {
                            //console.log('removed success: ' + data);

                        }
                    });
                    // remove file name from uploadedDocumentMap object
                    Reflect.deleteProperty(uploadedDocumentMap, file.name);

                    file.previewElement.remove();
                    arr_image_service.splice(0, 1)
                    console.log('array_',arr_image_service);
                    //removeElement(arr_image_service, file.name);
                    $('form').find('input[name="file[]"][value="' + filename + '"]').remove();
                },

                init: function() {
                    //console.log('init calls');
                    myDropzoneImage = this;
                    // Read Files from tables and storage folder starts
                    $.ajax({
                        url: "{{ route('service.readFiles', $serviceModel->slug) }}",
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            $.each(response.arr_image, function(key, value) {
                                console.log(response);
                                var mockFile = {
                                    name: value.name,
                                    size: value.size,
                                    accepted: true,
                                    kind: 'image'
                                };
                                if(value.size != '' && value.name != ''){
                                    myDropzoneImage.emit("addedfile", mockFile);
                                    myDropzoneImage.files.push(mockFile);
                                    myDropzoneImage.emit("thumbnail", mockFile, value.image);

                                    myDropzoneImage.emit("complete", mockFile);
                                    uploadedDocumentMap[value.name] = value.name;
                                    console.log(value.name);
                                    arr_image_service.push('img/general_hospital/management/service_image/'+value.name);
                                }
                                else{
                                    uploadedDocumentMap[value.name] =  value.name;
                                    //arr_image_service.push(value.image);
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
                       arr_image_service.push(response.service_image);
                       console.log('trong dropzone',arr_image_service);
                    }
                }
            });
            //form submit
            var btn_sevice = $('#service-button').on('click', function(e) {
                //myDropzone.processQueue();
                console.log($('#input-thumbnail-service').val());
                var name = $('#name').val();
                var price = $('#price').val();
                var description = $('#edit-deschiption').find('p');
                console.log(name, price, description);
                console.log($('#edit-deschiption').find('.ql-editor').get(0).outerHTML);
                var arr = {
                    'name': $('#name').val(),
                    'price': $('#price').val(),
                    'room_id': $('#room').val(),
                    'description': $('#edit-deschiption').find('.ql-editor').get(0).outerHTML,
                    'thumbnail': arr_thumbnail_service,
                    'service_image': arr_image_service
                };
                console.log(arr);
                e.preventDefault();
                $.ajax({
                    headers: {
                        token
                    },
                    type: 'PATCH',
                    url: '{!! route('service.update',$serviceModel->slug) !!}',
                    data: {
                        'arr': arr,
                    },
                    success: function(result) {
                        var url = "{{ route('service.index') }}"
                        window.location.href = url;
                        myDropzoneImage.processQueue();
                        myDropzoneThumbnail.processQueue();
                    }
                });
            });
        })
    </script>
@endpush
