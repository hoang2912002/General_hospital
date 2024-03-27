@extends('management.layout.main')
@push('css')
<link id="pagestyle" href="{{ asset('asset/admin') }}/css/argon-dashboard.min.css?v=2.0.5" rel="stylesheet" />
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<style>
    .async-hide {
        opacity: 0 !important
    }
</style>
<style> #toast-container > .toast-success { background-color: #39bd2f; } </style>
<style> #toast-container > .toast-error { background-color: #BD362F; } </style>
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
    <div class="row mb-5">
        <div class="col-12">
            <div class="multisteps-form mb-5">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="multisteps-form__progress">
                                    <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                        <span>{{ $name_page['name'] }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <form class="multisteps-form__form mb-8" action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">{{ $name_page['name'] }}</h5>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12 mb-3">
                                            <h6>Group</h6>
                                            <select class="form-control" name="role" id="choices-role" >
                                                <option value="">Choose role ...</option>
                                                @foreach ($groups as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-12 total_permission">
                                            <h6>Permission</h6>
                                            <label for=""></label>
                                            @foreach ($array_permission as $key => $permissions)
                                                <div class="div_permission">
                                                    <div class="checklist-item checklist-item-primary ps-2 ms-3 mb-1 ">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check">
                                                                <input class="form-check-input " type="checkbox" value="1"
                                                                    id="{{ $key }}" name="group_permission[{{ $key }}]">
                                                            </div>
                                                            <label for="{{ $key }}" class="mb-0   text-sm">{{ $key }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="div_subpermission">

                                                        <div class="checklist-item checklist-item-primary ps-5 ms-6 mb-1 permission w-auto">
                                                            <div class="d-flex align-items-center subpermission" style="justify-content: space-between !important;">
                                                                @foreach ($permissions as $k => $permission)
                                                                    <div class="form-check ml-2">
                                                                        <input class="form-check-input " type="checkbox" value="1" id="{{ $permission['id'] }}" name="permission_id[{{ $permission['id'] }}]">
                                                                        <label for="{{ $permission['id'] }}" class="mb-0  text-sm " style="margin-right: 10px !important">{{ $permission['name'] }}</label>
                                                                    </div>

                                                                @endforeach
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>
                                                <hr class="horizontal dark mt-0">
                                                <div class="mb-5"></div>
                                            @endforeach
                                            <label for=""></label>
                                            <div class="checklist-item checklist-item-primary ps-2 ms-3 mb-1 ">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input " type="checkbox" value=""
                                                            id="all" name="all">
                                                    </div>
                                                    <label for="all" class="mb-0 text-sm">All</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-primary ms-auto mb-0 js-btn-next" type="submit"
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
    <script src="{{ asset('asset/admin') }}/js/plugins/multistep-form.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/choices.min.js"></script>
    <script>
        if (document.getElementById('choices-role')) {
          var role = document.getElementById('choices-role');
          const example = new Choices(role);
        }
    </script>
    <script>
        let token = $('meta[name="csrf-token"]').attr('content');
        var count = 0;
        //Automatic check children
        $('input[name^="all"]').change(function () {
            var all = $('input[type="checkbox"]');
            var input_name_all = $('input[name^="all"]');

            if(input_name_all.is(':checked')) {
                all.prop('checked', true);
            }
            else{
                all.prop('checked', false);
            }
        });

        //Checkbox Group permission
        $('input[name^="group_permission"]').change(function () {
            var group_permission = this;
            var max_length = $('input[name^="group_permission"]').length;
            $(group_permission).closest('.div_permission').find('.div_subpermission .permission .subpermission input[type="checkbox"]').prop('checked', this.checked).trigger('change');
            if(count < max_length){
                if($(group_permission).is(':checked')){
                    count +=1;
                    //console.log(count,'count++');
                }
                else{
                    count -=1;
                    //console.log(count,'count--');
                    $('input[name^="all"]').prop('checked', false);
                }
            }
            if(count == max_length){
                $('input[name^="all"]').prop('checked', true);
                if(!$(group_permission).is(':checked')){
                    count -=1;
                    //console.log(!$(group_permission).is(':checked'),count);
                    $('input[name^="all"]').prop('checked', false);
                }
            }
        });
        //Checkbox permission
        $('.permission .subpermission input[type="checkbox"]').change(function () {
            var $section = $(this).closest('.section');
            var $childs = $section.find('.subsection input[type="checkbox"]');
            $section.find('.section_label input[type="checkbox"]').prop('checked', $childs.not(':checked').length == 0).trigger('change')
        });
        //Permission api data
        $('#choices-role').change(function (e) {
            var group = this;
            $('input[name^="permission_id"]').prop('checked', false);
            $('input[name^="group_permission"]').prop('checked', false);
            $('input[name^="all"]').prop('checked', false);
            e.preventDefault();
            if($(group).val() !== ''){
                $.ajax({
                    headers: {
                        token
                    },
                    type: "POST",
                    url: '{!! route('role.api') !!}',
                    data: {
                        group_id: $(group).val()
                    },
                    success: function (response) {
                        var arr = [];
                        $.each(JSON.parse(response), function(i, item) {
                            arr[i] =item;
                        })

                        var searchIDs = $('input[name^="permission_id"]').map(function(){
                            var checked = 0;
                            var input_field = this;

                            if (arr[$(input_field).attr('id')]) {
                                var checked = arr[$(input_field).attr('id')]['checked'];
                            }
                            if(arr[$(input_field).attr('id')] !== 'undefined' && checked == 1){
                                var permission_checked = $('input[name^="permission_id[' + arr[$(input_field).attr('id')]['permission'] +']"]').prop('checked',true);
                                var permission_input_field =  $('input[name^="permission_id[' + arr[$(input_field).attr('id')]['permission'] +']"]');
                                var input_field_checkBox = permission_input_field.closest('.div_subpermission').find(':checkbox');
                                //console.log(input_field_checkBox);
                                if(input_field_checkBox !== 0 ){
                                    permission_input_field.closest('.div_permission').find('input[name^="group_permission"]').prop('checked', true)
                                }
                                var group_checkbox = permission_input_field.closest('.total_permission').find('input[name^="group_permission"]');
                                var group_checkbox_checked = permission_input_field.closest('.total_permission').find('input[name^="group_permission"]:checked');
                                //console.log(lenchk.length,lenchkChecked.length);
                                if(group_checkbox.length === group_checkbox_checked.length){
                                    $('input[name^="all"]').prop('checked',true);
                                }
                                return permission_checked;
                                //console.log(permission_checked);
                            }
                        }).get();
                    }
                });
            }
        });
    </script>
@endpush
