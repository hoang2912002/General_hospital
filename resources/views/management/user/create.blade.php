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
    <div class="row mb-12" >
        <div class="col-12">
            <div class="multisteps-form mb-8">

                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="multisteps-form__progress">
                                    <button class="multisteps-form__progress-btn js-active" type="button"
                                        title="User Info">
                                        <span>Thông tin người dùng</span>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">

                        <form class="multisteps-form__form mb-8 " action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">Thêm người dùng</h5>
                                <p class="mb-0 text-sm">Thông tin cá nhân</p>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Họ</label>
                                            <input class="multisteps-form__input form-control" type="text" placeholder="Nguyễn Văn" id="last_name" name="last_name" value="{{ old('last_name') ?? '' }}">
                                            @error('last_name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Tên</label>
                                            <input class="multisteps-form__input form-control" type="text" placeholder="A" id="first_name" name="first_name" value="{{ old('first_name') ?? '' }}">
                                            @error('first_name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Ngày sinh</label>
                                            <input class="multisteps-form__input form-control" type="date" name="birthdate" id="birthdate">
                                            @error('birthdate')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>Giới tính</label>
                                            <select class="form-control" name="gender" id="choices-gender" >
                                                <option value="">Chọn giới tính ...</option>
                                                <option value="1">Nam</option>
                                                <option value="0">Nữ</option>
                                            </select>
                                            @error('gender')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6  mt-3 mt-sm-0">
                                            <label>Số điện thoại</label>
                                            <input class="form-control" type="number" id="phone_number" placeholder="+40 735 631 620" name="phone_number" value="{{ old('phone_number') ?? '' }}">
                                            @error('phone_number')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>Vai trò</label>
                                            <select class="form-control" name="role" id="choices-role" >
                                                <option value="">Chọn vai trò ...</option>
                                                @foreach ($groups as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Địa chỉ email</label>
                                            <input class="multisteps-form__input form-control" type="email" placeholder="eg. argon@dashboard.com" id="email" name="email" value="{{ old('email') ?? '' }}">
                                            @error('email')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Mật khẩu</label>
                                            <input class="multisteps-form__input form-control" id="password" type="password" placeholder="******" name="password">
                                            @error('password')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-auto  d-flex">
                                            <label class="form-check-label mb-0">
                                                <small id="profileVisibility" style="font-weight: bold">Thêm thông tin nhân viên</small>
                                            </label>
                                            <div class="form-check form-switch ms-2">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                id="btn-infor-dentist" name="">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- div toggle dentist --}}
                                    <div class="div-infor-dentist" style="display:none">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label class="">Thông tin chi tiết</label>
                                                <p class="form-text text-muted text-xs ms-1 d-inline">
                                                (Không bắt buộc)
                                                </p>
                                                <div id="edit-deschiption" class="h-50">
                                                    <p>Thông tin chi tiết <strong>Nhân viên</strong></p>
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
                                                                id="staff-image">

                                                                <div class="fallback">
                                                                    <input name="file[]" type="file" multiple />
                                                                </div>
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
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked="" onchange="visible()" name="activated" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" id="user-create"
                                            type="button" title="create">Thêm</button>
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
        $('#btn-infor-dentist').on('click', function() {
            var option = $('#btn-infor-dentist');
            $('.div-infor-dentist').slideToggle();
        })
         if (document.getElementById('edit-deschiption')) {
            var quill = new Quill('#edit-deschiption', {
                theme: 'snow' // Specify theme in configuration
            });
        };
    </script>
    <script>
        Dropzone.autoDiscover = false;
        var arr_image_user = [];
        var uploadedDocumentMap = {};
        let token = $('meta[name="csrf-token"]').attr('content');
        $(function() {
            //medicine_image
            var myDropzone = new Dropzone('#staff-image', {
                paramName: "file",
                url: '{!! route('user.save_image') !!}',
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
                        url: '{{ route('user.delete_imageCreate') }}',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {
                            filename: arr_image_user,
                        },
                        success: function(data) {

                        }
                    });
                    // remove file name from uploadedDocumentMap object
                    Reflect.deleteProperty(uploadedDocumentMap, file.name);

                    file.previewElement.remove();
                    arr_image_user.splice(0, 1)
                    //console.log('array_',arr_image_user);
                    //removeElement(arr_image_user, file.name);
                    $('form').find('input[name="file[]"][value="' + filename + '"]').remove();
                },
                init: function(e) {
                    // .on event handlers see dropzone docs for info
                },
                error:function(file, response) {
                    // error handling
                },
                success:function(file, response) {
                    //console.log(response.medicine_image);
                    if (response.status == "success") {
                       arr_image_user.push(response.medicine_image)
                       //console.log('trong dropzone',arr_image_user);
                    }
                }
            });
            //form submit
            var btn_sevice =  $('#user-create').on('click', function(e) {
                //myDropzone.processQueue();
                var first_name =$('#first_name').val();
                var last_name =$('#last_name').val();
                var birthdate =$('#birthdate').val();
                var choices_gender =$('#choices-gender').find(":selected").val();
                var choices_role =$('#choices-role').find(":selected").val();
                var phone_number =$('#phone_number').val();
                console.log(phone_number);
                var email =$('#email').val();
                var password =$('#password').val();
                var description = $('#edit-deschiption').find('.ql-editor').get(0).outerHTML;
                var arr =
                {
                    'first_name': first_name,
                    'last_name': last_name,
                    'dob': birthdate,
                    'gender': choices_gender,
                    'role': choices_role,
                    'phone_number': phone_number,
                    'email': email,
                    'password': password,
                    'description':  description,
                    'image': arr_image_user[0]
                };
                //console.log(arr,arr_image_user);
                e.preventDefault();
                $.ajax({
                    headers: {
                        token
                    },
                    type: 'POST',
                    url: '{!! route('user.store') !!}',
                    data: {
                        'arr': arr,
                    },
                    success: function(result) {
                        var url = "{{ route('user.index') }}"
                            window.location.href = url;
                            myDropzone.processQueue();

                    }
                });
                //});
            });
        })

    </script>
@endpush
@push('js')
    {{-- <script src="{{ asset('asset/admin') }}/js/plugins/dropzone.min.js"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var drop = document.getElementById('avatar')
        var myDropzone = new Dropzone(drop, {
        url: "/file/post",
        addRemoveLinks: true

        }); --}}
    </script>
    {{-- <script>
        $('#btn-infor-dentist').on('click', function() {
            var option = $('#btn-infor-dentist');
            $('.div-infor-dentist').slideToggle();
        })
        $(document).ready(function() {
        if (window.File && window.FileList && window.FileReader) {
            $("#dentistAvatar").on("change", function(e) {
                var clickedButton = this;
                $(clickedButton).parents().find("#avatar").hide();
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]

                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $(clickedButton).parents().find("#avatar #loading_before").hide();
                        $("<div class=\" pip\" id=\"avatar\">" +
                            "<span class=\"pip\">" +
                            "<img style=\"width: 100px\" class=\"image\" src=\"" + e
                            .target.result + "\" title=\"" + file.name + "\" />" +
                            "<br/><span class=\"remove\">Remove image</span>" +
                            "</span>" +
                            "</div>"
                        ).insertAfter(clickedButton);
                        $(".remove").click(function() {
                            $(this).parent(".pip").remove();
                            if ($(clickedButton).parents().find("#avatar .image").prop('src') == null) {
                                $.ajax({
                                    url: '',
                                    data: {
                                        service_id: $('.service_id').val()
                                    },
                                    method: 'post',
                                    success: function(response) {
                                        $('#dentistAvatar').val('');
                                    }
                                });
                            }
                        });
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });
    </script> --}}
@endpush
