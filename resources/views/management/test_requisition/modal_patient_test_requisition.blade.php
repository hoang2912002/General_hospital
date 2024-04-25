<div class="modal fade " id="modal-test-requisition"  role="dialog" aria-labelledby="modal-test-requisition" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md mt-8" role="document"
        style="align-items: center !important;flex-direction: column !important">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12 col-lg-4">
                    <h5 class="modal-title" id="exampleModalLabel">Phiếu chỉ định của {{ $userModel->first_name . ' ' . $userModel->last_name }}</h5>
                </div>
                <div class="col-12 col-lg-8 d-flex">
                        <div class="col-12 col-lg-10 d-flex align-items-center justify-content-end">
                            <input class="form-control" type="search" name="service" id="service-search" placeholder="Tìm dịch vụ" style="width: 180px;">
                        </div>
                        <div class="col-12 col-lg-2 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-outline-primary" id="btn-print-test-requisition" style="margin-bottom: 0 !important"><i class="fa ni fa-solid fa-print "></i> In</button>
                        </div>


                </div>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-12 col-lg-12">
                        <div class="row mx-3">
                            <table class="table" id="service-table">
                                <thead>
                                    <tr>
                                        <th>Chọn</th>
                                        <th>Ảnh</th>
                                        <th>Tên dịch vụ</th>
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
                    <ul class="pagination service-pagination"></ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-success" id="create_test_requisition" style="margin-bottom: 0 !important">Thêm phiếu chỉ định</button>
            </div>
        </div>
    </div>
</div>



