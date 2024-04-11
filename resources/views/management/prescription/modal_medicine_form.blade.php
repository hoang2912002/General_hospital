<div class="modal fade " id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md mt-8" role="document"
            style="align-items: center !important;flex-direction: column !important">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="multisteps-form ">
                        <div class="multisteps-form__progress">
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-12 m-auto">

                                <form class="multisteps-form__form " action="{{ route('medicine.store') }}"
                                    method="POST" name="form-medicine" id="form-medicine"
                                    enctype="multipart/form-data">
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
                                                    <input class="multisteps-form__input form-control" type="text"
                                                        id="price" placeholder="10.000VNĐ" name="price"
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
                                                    <input class="multisteps-form__input form-control" type="text"
                                                        id="quantity" placeholder="" name="quantity"
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
                                                    <label>Ngày nhập</label>
                                                    <input class="multisteps-form__input form-control" type="date"
                                                        name="imp_date" id="imp_date">
                                                    @error('imp_date')
                                                        <div class="alert alert-danger alert-dismissible text-white p-1 mt-3"
                                                            role="alert">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-sm-6">
                                                    <label>Hạn sử dụng</label>
                                                    <input class="multisteps-form__input form-control" type="date"
                                                        name="exp_date" id="exp_date">
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
                                                            id="flexSwitchCheckDefault23" checked=""
                                                            onchange="visible()" name="activated" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                    type="button" id="medicine-button" title="create">Create</button>
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
    </div>
