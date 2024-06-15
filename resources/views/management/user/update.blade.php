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

                        <form class="multisteps-form__form mb-8 " action="{{ route('user.update',$userModel) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">Cập nhật người dùng</h5>
                                <p class="mb-0 text-sm">Thông tin cá nhân</p>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <label>Người dùng uuid</label>
                                            <input class="multisteps-form__input form-control" type="text" placeholder="eg. Michael" name="uuid" value="{{ $userModel->uuid ?? old('uuid')  }}" readonly>

                                        </div>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Họ</label>
                                            <input class="multisteps-form__input form-control" id="last_name" type="text" placeholder="Nguyễn Văn" name="last_name" value="{{$userModel->last_name ?? old('last_name')  }}">
                                            @error('last_name')
                                                <div class="alert alert-danger alert-dismissible text-white p-1 mt-3" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label>Tên</label>
                                            <input class="multisteps-form__input form-control" id="first_name" type="text" placeholder="A" name="first_name" value="{{ $userModel->first_name ?? old('first_name')  }}">
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
                                            <input  class="multisteps-form__input form-control" id="birthdate" type="date" name="birthdate" value="{{ $userModel->dob ?? old('birthdate') }}">
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
                                                <option value="1" @if ($userModel->gender === 1)
                                                    @selected(true)
                                                @endif >Nam</option>
                                                <option value="0" @if ($userModel->gender === 0)
                                                    @selected(true)
                                                @endif>Nữ</option>
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
                                            <input id="phone_number" class="form-control" type="number" placeholder="+40 735 631 620" name="phone_number" value="{{ $userModel->login->phone_number ?? old('phone_number')  }}">
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
                                                    <option value="{{ $item->id }}" @if ($userModel->group_user->all()[0]->id === $item->id)
                                                        @selected(true)
                                                    @endif>{{ $item->name }}</option>
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
                                            <input class="multisteps-form__input form-control" id="email" type="email" placeholder="eg. argon@dashboard.com" name="email" value="{{ $userModel->login->email ?? old('email')  }}">
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
                                                <small id="profileVisibility" style="font-weight: bold">Thông tin nhân viên</small>
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
                                                    @if (!empty($userModel->staff->description))
                                                        {!! html_entity_decode($userModel->staff->description) !!}
                                                    @else
                                                        <p>Thông tin chi tiết <strong>Nhân viên</strong></p>
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
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" id="user-update"
                                            type="button" title="create">Cập nhật</button>
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
                    uploadedDocumentMap[file.name] = response.name;
                    arr_image_user = jQuery.grep(arr_image_user, function(value) {
                        console.log('success',value == 'img/general_hospital/management/avatar/' + response.name);
                        return value != 'img/general_hospital/management/avatar/' + response.name;
                    });
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
                        url: '{{ route('user.delete_image', $userModel->uuid) }}',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        data: {
                            filename: arr_image_user,
                        },
                        success: function(data) {
                            //console.log('removed success: ' + data);

                        }
                    });
                    // // remove file name from uploadedDocumentMap object
                    // Reflect.deleteProperty(uploadedDocumentMap, file.name);

                    // file.previewElement.remove();
                    // arr_image_user.splice(0, 1)
                    // removeElement(arr_image_user, file.name);
                    // $('form').find('input[name="file[]"][value="' + filename + '"]').remove();
                    file.previewElement.remove();

                    // Remove the file from uploadedDocumentMap
                    Reflect.deleteProperty(uploadedDocumentMap, file.name);

                    // Remove the hidden input field from the form
                    $('form').find('input[name="file[]"][value="' + filename + '"]').remove();

                    // Remove the file name from arr_image_service
                    arr_image_user = arr_image_user.filter(function(value) {
                        return value !== 'img/general_hospital/management/avatar/' + filename;
                    });
                },

                init: function() {
                    //console.log('init calls');
                    myDropzone = this;
                    // Read Files from tables and storage folder starts
                    $.ajax({
                        url: "{{ route('user.readFiles', $userModel->uuid) }}",
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
                                    arr_image_user.push('img/general_hospital/management/avatar/'+value.name);
                                }
                                else{
                                    uploadedDocumentMap[value.name] =  value.name;
                                }
                            });
                        }
                    });
                },
                error:function(file, response) {
                    // error handling
                },
                success:function(file, response) {
                    if (response.status == "success") {
                       arr_image_user.push(response.medicine_image)
                    }
                }
            });
            //form submit
            var btn_sevice =  $('#user-update').on('click', function(e) {
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
                e.preventDefault();
                $.ajax({
                    headers: {
                        token
                    },
                    type: 'PATCH',
                    url: "{{ route('user.update', $userModel->uuid) }}",
                    data: {
                        'arr': arr,
                    },
                    success: function(result) {
                        var url = "{{ route('user.index') }}"
                        window.location.href = url;
                        myDropzone.processQueue();
                    }
                });
            });
        })
    </script>
@endpush
