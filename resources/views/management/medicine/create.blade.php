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
                                                value="{{ old('name') ?? '' }}">
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
                                                value="{{ old('price') ?? '' }}">
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
                                                value="{{ old('quantity') ?? '' }}">
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
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                            <input class="multisteps-form__input form-control" type="date" name="imp_date" id="imp_date">
                                            @error('imp_date')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <label>Hạn sử dụng</label>
                                            <input class="multisteps-form__input form-control" type="date" name="exp_date" id="exp_date">
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
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <div class="multisteps-form__content">
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <label>Ảnh</label>
                                                        <div class="form-control dropzone dz-clickable"
                                                            id="medicine-image">

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
                                            id="medicine-button" title="create">Create</button>
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
                maxFiles: 10,
                acceptedFiles: '.jpg, .jpeg,.png,.gif',
                autoProcessQueue: true, // myDropzone.processQueue() to upload dropped files
                addRemoveLinks: true,
                dictRemoveFile: "Remove image",
                params: {
                    _token: token
                },
                removedfile: function(file) {
                    var filename = ''
                    if (file.hasOwnProperty('upload')) {
                        filename = file.upload.filename;
                    } else {
                        filename = file.name;
                    }
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('medicine.delete_imageCreate') }}',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {
                            filename: arr_image_medicine,
                        },
                        success: function(data) {

                        }
                    });
                    // remove file name from uploadedDocumentMap object
                    Reflect.deleteProperty(uploadedDocumentMap, file.name);

                    file.previewElement.remove();
                    arr_image_medicine.splice(0, 1)
                    console.log('array_',arr_image_medicine);
                    //removeElement(arr_image_medicine, file.name);
                    $('form').find('input[name="file[]"][value="' + filename + '"]').remove();
                },
                init: function(e) {
                    // .on event handlers see dropzone docs for info
                },
                error:function(file, response) {
                    // error handling
                },
                success:function(file, response) {
                    console.log(response.medicine_image);
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
                    type: 'POST',
                    url: '{!! route('medicine.store') !!}',
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
