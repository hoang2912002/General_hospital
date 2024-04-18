<div class="modal fade " id="modal-index"  role="dialog" aria-labelledby="modal-index" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md mt-8" role="document"
        style="align-items: center !important;flex-direction: column !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Danh sách thuốc</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                {{-- <select class="form-control"  id="choices-medicine-presciption">
                                    <option selected>Tìm kiếm theo thuốc</option>
                                    @foreach ($medicine as $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select> --}}
                                <input class="form-control" type="search" name="medicine" id="medicine-presciption" placeholder="Tìm kiếm thuốc">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-12">
                                <select class="form-control "  id="choices-category-presciption">
                                    <option value="">Tìm kiếm theo loại thuốc</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-12">
                                <select class="form-control "  id="choices-manufacturer-presciption">
                                    <option value="">Tìm kiếm theo hãng</option>
                                    @foreach ($manufacturers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="row mx-3">
                            <table class="table" id="medicine-table">
                                <thead>
                                    <tr>
                                        <th>Chọn</th>
                                        <th>Ảnh</th>
                                        <th>Tên thuốc</th>
                                        <th>Loại</th>
                                        <th>Nhà sản xuất</th>
                                        <th>Tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 d-flex" style="justify-content: space-around;">
                    <ul class="pagination custom-pagination"></ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-success" id="create_note">Thêm ghi chú</button>
            </div>
        </div>
    </div>
</div>

