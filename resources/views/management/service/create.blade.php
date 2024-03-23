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
                                        <span>Service Info</span>
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
                                <h5 class="font-weight-bolder mb-0">Service Create</h5>
                                <p class="mb-0 text-sm">Private informations</p>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <label>Name</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                placeholder="eg. Michael" name="first_name" id="name"
                                                value="{{ old('first_name') ?? '' }}">
                                            @error('first_name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <label>Price</label>
                                            <input class="multisteps-form__input form-control" type="text" id="price"
                                                placeholder="10.000VNĐ" name="price"
                                                value="{{ old('first_name') ?? '' }}">
                                            @error('first_name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                    role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <label class="">Description</label>
                                            <p class="form-text text-muted text-xs ms-1 d-inline">
                                            (optional)
                                            </p>
                                            <div id="edit-deschiption" class="h-50">
                                                <p>Some initial <strong>bold</strong> text</p>
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
                                                        <input type="hidden" name="input-thumbnail-service" id="input-thumbnail-service">
                                                        <label>Service thumbnail</label>
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
                                                        <label>Service images</label>
                                                        <div class="form-control dropzone dz-clickable"
                                                            id="service-image">

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
                                                <small id="profileVisibility">Activated</small>
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
                                            id="service-button" title="create">Create</button>
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
        let token = $('meta[name="csrf-token"]').attr('content');
        $(function() {
            //service thumbnail
            var myDropzone = new Dropzone('#service-thumbnail', {
                paramName: "file",
                url: '{!! route('service.dropzone') !!}',
                uploadMultiple: true,
                maxFiles: 1,
                acceptedFiles: '.jpg, .jpeg,.png,.gif',
                autoProcessQueue: true, // myDropzone.processQueue() to upload dropped files
                addRemoveLinks: true,
                dictRemoveFile: "Remove image",
                params: {
                    _token: token
                },
                init: function(e) {
                    // .on event handlers see dropzone docs for info
                },
                error:function(file, response) {
                    // error handling
                },
                success:function(file, response) {
                    console.log(response.service_image);
                    if (response.status == "success") {
                        $('#input-thumbnail-service').val(response.service_image);
                        image_service =  response.service_image;
                    }
                }
            });
            //service_image
            var myDropzone = new Dropzone('#service-image', {
                paramName: "file",
                url: '{!! route('service.dropzone') !!}',
                uploadMultiple: true,
                maxFiles: 10,
                acceptedFiles: '.jpg, .jpeg,.png,.gif',
                autoProcessQueue: true, // myDropzone.processQueue() to upload dropped files
                addRemoveLinks: true,
                dictRemoveFile: "Remove image",
                params: {
                    _token: token
                },
                init: function(e) {
                    // .on event handlers see dropzone docs for info
                },
                error:function(file, response) {
                    // error handling
                },
                success:function(file, response) {
                    console.log(response.service_image);
                    if (response.status == "success") {
                       arr_image_service.push(response.service_image)
                       console.log(arr_image_service);
                    }
                }
            });
            //form submit
            var btn_sevice =  $('#service-button').on('click', function(e) {
                //myDropzone.processQueue();
                console.log( $('#input-thumbnail-service').val());
                var name =$('#name').val();
                var price =$('#price').val();
                var description = $('#edit-deschiption').find('p');
                console.log(name,price,description);
                console.log($('#edit-deschiption').find('.ql-editor').get(0).outerHTML);
                var arr =
                    {'name': $('#name').val(),
                    'price': $('#price').val(),
                    'description':   $('#edit-deschiption').find('.ql-editor').get(0).outerHTML ,
                    'thumbnail': $('#input-thumbnail-service').val(),
                    'service_image': arr_image_service
                }
                ;
                    e.preventDefault();
                    $.ajax({
                        headers: {
                            token
                        },
                        type: 'POST',
                        url: '{!! route('service.store') !!}',
                        data: {
                            'arr': JSON.stringify(arr),
                        },
                        success: function(result) {
                            var url = "{{ route('service.index') }}"
                                window.location.href = url;
                                myDropzone.processQueue();

                        }
                    });
                //});
            });
        })

    </script>
@endpush
