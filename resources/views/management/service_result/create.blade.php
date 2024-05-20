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
                                        <h5 class="font-weight-bolder ">{{ $medical_recordModel->user->name() . ' - Thứ: ' .  $day_id . ' - ' .  $shiftModel->name }}</h5>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <form class="multisteps-form__form mb-8" action="" method="POST"
                            name="form-service-result" id="form-service-result" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card multisteps-form__panel p-3 border-radius-xl  js-active"
                                data-animation="FadeIn">
                                <div class="col-12 mx-auto">
                                    <div class="accordion" id="accordionRental">
                                        @if (!empty($service_arr))
                                            @foreach ($service_arr as $item => $value)
                                                <div class="accordion-item mb-3">
                                                    <h5 class="font-weight-bolder mb-0 accordion-header" id="heading{{ $item }}">
                                                        <button
                                                            class="accordion-button border-bottom font-weight-bold collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapse{{ $item }}" aria-expanded="false"
                                                            aria-controls="collapse{{ $item }}">
                                                            {{ $value->name  }}
                                                            <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                                                aria-hidden="true"></i>
                                                            <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3"
                                                                aria-hidden="true"></i>
                                                        </button>
                                                    </h5>
                                                    <div id="collapse{{ $item }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $item }}"
                                                        data-bs-parent="#accordionRental" style="">
                                                        <div class="accordion-body text-sm opacity-8">
                                                                <div class="multisteps-form__content">
                                                                    <div class="row mt-3">
                                                                        <div class="col-12 col-sm-12">
                                                                            <input type="hidden" id="medical_record_id" name="medical_record_id" value="{{ $medical_recordModel->id }}">
                                                                            <input type="hidden" id="shift_id" name="shift_id" value="{{ $shiftModel->id }}">
                                                                            <input type="hidden" id="day_id" name="day_id" value="{{ $day_id }}">
                                                                            <input type="hidden" id="service_id" name="service_id[]" value="{{ $value->id }}">
                                                                            <label>Giá dịch vụ</label>
                                                                            <input class="multisteps-form__input form-control"
                                                                                type="text" placeholder="eg. Michael"
                                                                                name="price" id="price"
                                                                                value="{{ $value->price_format() ?? old('price')  }}">
                                                                            @error('price')
                                                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                                                    role="alert">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                        <div class="col-12">
                                                                            <label>Ảnh</label>
                                                                            <input type="hidden" id="id_medical_equipment" value="{{ $value->id }}">
                                                                            <div class="form-control dropzone dz-clickable"
                                                                                id="image{{ $value->id }}">

                                                                                <div class="fallback">
                                                                                    <input name="image" type="file" multiple />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                        <div class="col-12 col-sm-12">
                                                                            <label class="">Ghi chú</label>
                                                                            <p class="form-text text-muted text-xs ms-1 d-inline">
                                                                                (optional)
                                                                            </p>
                                                                            <div id="edit-deschiption" class="h-50 text-dark" >

                                                                            </div>
                                                                            @error('edit-deschiption')
                                                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                                                    role="alert">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
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
                                                    type="button" id="service-result-button"
                                                    title="create">Thêm</button>
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
        var arr_image_service = [];
        var uploadedDocumentMap = {};
        let token = $('meta[name="csrf-token"]').attr('content');
        $(".dropzone").each(function() {
            //service-result_image
            var dropzoneId = $(this).attr('id');
            var myDropzone = new Dropzone('#' + dropzoneId, {
                paramName: "file",
                url: '{!! route('service_result.save_image') !!}',
                uploadMultiple: true,
                maxFiles: 1,
                acceptedFiles: '.jpg, .jpeg,.png,.gif',
                autoProcessQueue: true, // myDropzone.processQueue() to upload dropped files
                addRemoveLinks: true,
                dictRemoveFile: "Remove image",
                params: {
                    _token: token
                },
                success: function(file, response) {
                    console.log('sussess', response);
                },
                removedfile: function(file) {
                    console.log('remove',arr_image_service);
                    var filename = ''
                    if (file.hasOwnProperty('upload')) {
                        filename = file.upload.filename;
                    } else {
                        filename = file.name;
                    }
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('service_result.delete_imageCreate') }}',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {
                            filename: arr_image_service,
                        },
                        success: function(data) {

                        }
                    });
                    // remove file name from uploadedDocumentMap object
                    Reflect.deleteProperty(uploadedDocumentMap, file.name);

                    file.previewElement.remove();
                    arr_image_service.splice(0, 1)
                    //console.log('array_',arr_image_service);
                    //removeElement(arr_image_service, file.name);
                    $('form').find('input[name="file[]"][value="' + filename + '"]').remove();
                },

                init: function(e) {
                    //console.log(inputElement = $('#' + dropzoneId).closest('.col-12').find('#id_medical_equipment').val());

                },
                error: function(file, response) {
                    // error handling
                },
                success: function(file, response) {
                    //console.log('dsds',response.status == 'success',response.service-result_image);
                    if (response.status == "success") {
                        //arr_image_service.push(response.service-result_image)
                        arr_image_service.push(response.service_result_image)
                    }
                }
            });

        });
         //form submit
        var btn_sevice = $('#service-result-button').on('click', function(e) {
            e.preventDefault();
            //myDropzone.processQueue();
            var medical_record_id = $('#medical_record_id').val();
            var shift_id = $('#shift_id').val();
            var day_id = $('#day_id').val();
            var service_id_arr = [];
            var descriptions = [];
            var price = [];
            // Duyệt qua từng phần tử input có name là 'service_id[]'
            $('input[name="service_id[]"]').each(function() {
                // Lấy giá trị của từng phần tử và thêm vào mảng service_ids
                var value = $(this).val();
                service_id_arr.push(value);
            });
            $('input[name="price"]').each(function() {
                // Lấy giá trị của từng phần tử và thêm vào mảng service_ids
                var value = $(this).val();
                price.push(value);
            });
            //var description = $('#edit-deschiption').find('.ql-editor').eq(0).html();
            var imagelength = Object.keys(uploadedDocumentMap).length;
            $('.row #edit-deschiption').each(function() {
                var description = $(this).find('.ql-editor').eq(0).html(); // Lấy giá trị từ phần tử con có class là "ql-editor"
                descriptions.push(description); // Thêm giá trị vào mảng
            });
            //console.log('fsdfsd', descriptions,arr_image_service)

            var arr = {
                'medical_record_id': medical_record_id,
                'shift_id': shift_id,
                'day_id': day_id,
                'service_id_arr': service_id_arr,
                'price': price,
                'description': descriptions,
                'image': arr_image_service
            };
            var currentUrl = window.location.href;
            //console.log('url',currentUrl); // In ra địa chỉ URL hiện tại trong console
            //console.log(arr, arr_image_service);

            $.ajax({
                headers: {
                    token
                },
                type: 'POST',
                url: "{{ route('service_result.store') }}",
                data: {
                    'arr': arr,
                },
                success: function(result) {
                    if(result.status === 'success'){
                        var url = "{{ route('service_result.index') }}"
                        window.location.href = url;
                        myDropzone.processQueue();
                    }
                    else{
                        window.location.href = currentUrl;
                    }

                }
            });
        });
    </script>
@endpush
